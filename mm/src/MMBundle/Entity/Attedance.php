<?php

namespace MMBundle\Entity;

/**
 * Attedance
 */
class Attedance
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $data;

    /**
     * @var \DateTime
     */
    private $hourentry;

    /**
     * @var \DateTime
     */
    private $hourexit;

    /**
     * @var float
     */
    private $worktime;

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
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Attedance
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set hourentry
     *
     * @param \DateTime $hourentry
     *
     * @return Attedance
     */
    public function setHourentry($hourentry)
    {
        $this->hourentry = $hourentry;

        return $this;
    }

    /**
     * Get hourentry
     *
     * @return \DateTime
     */
    public function getHourentry()
    {
        return $this->hourentry;
    }

    /**
     * Set hourexit
     *
     * @param \DateTime $hourexit
     *
     * @return Attedance
     */
    public function setHourexit($hourexit)
    {
        $this->hourexit = $hourexit;

        return $this;
    }

    /**
     * Get hourexit
     *
     * @return \DateTime
     */
    public function getHourexit()
    {
        return $this->hourexit;
    }

    /**
     * Set worktime
     *
     * @param float $worktime
     *
     * @return Attedance
     */
    public function setWorktime($worktime)
    {
        $this->worktime = $worktime;

        return $this;
    }

    /**
     * Get worktime
     *
     * @return float
     */
    public function getWorktime()
    {
        return $this->worktime;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Attedance
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

