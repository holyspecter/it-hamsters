<?php

namespace Hospect\ReferralBundle\Referral;

use Hospect\ReferralBundle\Entity\ReferableInterface;
use Symfony\Component\Routing\Router;

class ReferableAwareRouter
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var ReferableInterface|string
     */
    private $referable;

    /**
     * @param ReferableInterface|string $referable
     * @param Router                    $router
     */
    public function __construct($referable, Router $router)
    {
        $this->referable = $referable;
        $this->router    = $router;
    }

    /**
     * @param string $name
     * @param array  $parameters
     * @param bool   $referenceType
     * @return string
     */
    public function generate($name, $parameters = array(), $referenceType = Router::ABSOLUTE_PATH)
    {
        if ($this->referable instanceof ReferableInterface) {
            $parameters = array_merge(['ref' => $this->referable->getRefererCode()], $parameters);
        }

        return $this->router->generate($name, $parameters, $referenceType);
    }
} 
