<?php

namespace Hospect\ReferralBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Hospect\ReferralBundle\Entity\ReferableInterface;
use Hospect\ReferralBundle\Referral\CodeGeneratorInterface;

class ReferableEventSubscriber implements EventSubscriber
{
    /** @var  CodeGeneratorInterface */
    private $codeGenerator;

    /**
     * @param CodeGeneratorInterface $codeGenerator
     */
    public function __construct(CodeGeneratorInterface $codeGenerator)
    {
        $this->codeGenerator = $codeGenerator;
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

    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof ReferableInterface) {
            $object->setRefererCode($this->codeGenerator->generateCode());

            // todo check if user has been referred
        }
    }
} 
