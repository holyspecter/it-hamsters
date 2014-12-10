<?php

namespace Hospect\ReferralBundle\Entity;

interface RefererAwareInterface
{
    /**
     * @return ReferableInterface
     */
    public function getReferer();
} 
