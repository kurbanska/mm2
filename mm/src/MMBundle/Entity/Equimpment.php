<?php

namespace MMBundle\Entity;

/**
 * Equimpment
 */
class Equimpment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $number;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $serialnumber;

    /**
     * @var \DateTime
     */
    private $datepurchase;

    /**
     * @var \DateTime
     */
    private $warranty;

    /**
     * @var float
     */
    private $amountnetto;

    /**
     * @var string
     */
    private $who;

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
     * @param integer $number
     *
     * @return Equimpment
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
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
     * @return Equimpment
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
     * Set serialnumber
     *
     * @param string $serialnumber
     *
     * @return Equimpment
     */
    public function setSerialnumber($serialnumber)
    {
        $this->serialnumber = $serialnumber;

        return $this;
    }

    /**
     * Get serialnumber
     *
     * @return string
     */
    public function getSerialnumber()
    {
        return $this->serialnumber;
    }

    /**
     * Set datepurchase
     *
     * @param \DateTime $datepurchase
     *
     * @return Equimpment
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
     * Set warranty
     *
     * @param \DateTime $warranty
     *
     * @return Equimpment
     */
    public function setWarranty($warranty)
    {
        $this->warranty = $warranty;

        return $this;
    }

    /**
     * Get warranty
     *
     * @return \DateTime
     */
    public function getWarranty()
    {
        return $this->warranty;
    }

    /**
     * Set amountnetto
     *
     * @param float $amountnetto
     *
     * @return Equimpment
     */
    public function setAmountnetto($amountnetto)
    {
        $this->amountnetto = $amountnetto;

        return $this;
    }

    /**
     * Get amountnetto
     *
     * @return float
     */
    public function getAmountnetto()
    {
        return $this->amountnetto;
    }

    /**
     * Set who
     *
     * @param string $who
     *
     * @return Equimpment
     */
    public function setWho($who)
    {
        $this->who = $who;

        return $this;
    }

    /**
     * Get who
     *
     * @return string
     */
    public function getWho()
    {
        return $this->who;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Equimpment
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

