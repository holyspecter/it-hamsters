<?php

namespace ITHamsters\AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Hospect\ReferralBundle\Entity\Referral;
use Hospect\ReferralBundle\Entity\ReferableInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ith_user")
 */
class User extends BaseUser implements ReferableInterface
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Hospect\ReferralBundle\Entity\RefererAwareInterface", mappedBy="referer")
     */
    protected $referrals;

    /**
     * @var string
     *
     * @ORM\Column(name="referer_code", type="string")
     */
    protected $refererCode;

    /**
     * @return Collection|Referral[]
     */
    public function getReferrals()
    {
        return $this->referrals;
    }

    /**
     * {@inheritdoc}
     */
    public function getRefererCode()
    {
        return $this->refererCode;
    }

    /**
     * {@inheritdoc}
     */
    public function setRefererCode($code)
    {
        $this->refererCode = $code;

        return $this;
    }
}
