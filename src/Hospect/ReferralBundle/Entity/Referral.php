<?php

namespace Hospect\ReferralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="hospect_referral")
 * @ORM\Entity
 */
class Referral implements RefererAwareInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var ReferableInterface
     *
     * @ORM\ManyToOne(targetEntity="ReferableInterface", inversedBy="referrals")
     * @ORM\JoinColumn(name="referer_id", referencedColumnName="id")
     */
    private $referer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $ip
     * @return Referral
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param ReferableInterface $referer
     * @return Referral
     */
    public function setReferer(ReferableInterface $referer)
    {
        $this->referer = $referer;

        return $this;
    }

    /**
     * @return ReferableInterface
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * @param \DateTime $createdAt
     * @return Referral
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
