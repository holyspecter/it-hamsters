<?php

namespace Hospect\ReferralBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Hospect\ReferralBundle\Entity\ReferableInterface;
use Hospect\ReferralBundle\Entity\Referral;
use Hospect\ReferralBundle\Referral\CodeGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;

class ReferableEventSubscriber implements EventSubscriber
{
    /** @var  CodeGeneratorInterface */
    private $codeGenerator;

    /** @var  Request */
    private $request;

    /**
     * @param CodeGeneratorInterface $codeGenerator
     */
    public function __construct(CodeGeneratorInterface $codeGenerator)
    {
        $this->codeGenerator = $codeGenerator;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request = null)
    {
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof ReferableInterface) {
            $object->setRefererCode($this->codeGenerator->generateCode());

            if ($this->request && $this->request->cookies->has('hospect_ref')) {
                $refererCode = $this->request->cookies->get('hospect_ref');

                $referable = $args
                    ->getObjectManager()
                    ->getRepository(get_class($object))
                    ->findOneBy(['refererCode' => $refererCode]) // todo rethink, this really sucks
                ;

                if ($referable instanceof ReferableInterface) {
                    $referral = (new Referral())
                        ->setReferer($referable)
                        ->setIp($this->request->getClientIp())
                        ->setCreatedAt(new \DateTime())
                    ;

                    $args->getObjectManager()->persist($referral);
                }
            }
        }
    }
}
