<?php

namespace Hospect\ReferralBundle\Entity;

use Doctrine\Common\Collections\Collection;

interface ReferableInterface
{
    /**
     * @return Collection|Referral[]
     */
    public function getReferrals();

    /**
     * @return string
     */
    public function getRefererCode();

    /**
     * @param string $code
     *
     * @return mixed
     */
    public function setRefererCode($code);
} 
