<?php

namespace MMBundle\Entity;

/**
 * License
 */
class License
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $serialkey;

    /**
     * @var \DateTime
     */
    private $datepurchase;

    /**
     * @var \DateTime
     */
    private $datesupport;

    /**
     * @var \DateTime
     */
    private $validity;

    /**
     * @var string
     */
    private $technicalcondition;

    /**
     * @var string
     */
    private $comments;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return License
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return License
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set serialkey
     *
     * @param string $serialkey
     *
     * @return License
     */
    public function setSerialkey($serialkey)
    {
        $this->serialkey = $serialkey;

        return $this;
    }

    /**
     * Get serialkey
     *
     * @return string
     */
    public function getSerialkey()
    {
        return $this->serialkey;
    }

    /**
     * Set datepurchase
     *
     * @param \DateTime $datepurchase
     *
     * @return License
     */
    public function setDatepurchase($datepurchase)
    {
        $this->datepurchase = $datepurchase;

        return $this;
    }

    /**
     * Get datepurchase
     *
     * @return \DateTime
     */
    public function getDatepurchase()
    {
        return $this->datepurchase;
    }

    /**
     * Set datesupport
     *
     * @param \DateTime $datesupport
     *
     * @return License
     */
    public function setDatesupport($datesupport)
    {
        $this->datesupport = $datesupport;

        return $this;
    }

    /**
     * Get datesupport
     *
     * @return \DateTime
     */
    public function getDatesupport()
    {
        return $this->datesupport;
    }

    /**
     * Set validity
     *
     * @param \DateTime $validity
     *
     * @return License
     */
    public function setValidity($validity)
    {
        $this->validity = $validity;

        return $this;
    }

    /**
     * Get validity
     *
     * @return \DateTime
     */
    public function getValidity()
    {
        return $this->validity;
    }

    /**
     * Set technicalcondition
     *
     * @param string $technicalcondition
     *
     * @return License
     */
    public function setTechnicalcondition($technicalcondition)
    {
        $this->technicalcondition = $technicalcondition;

        return $this;
    }

    /**
     * Get technicalcondition
     *
     * @return string
     */
    public function getTechnicalcondition()
    {
        return $this->technicalcondition;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return License
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }
}

