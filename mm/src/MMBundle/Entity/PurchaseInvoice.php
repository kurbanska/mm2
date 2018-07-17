<?php

namespace MMBundle\Entity;

/**
 * PurchaseInvoice
 */
class PurchaseInvoice
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $contractorId;

    /**
     * @var int
     */
    private $taxId;

    /**
     * @var string
     */
    private $number;

    /**
     * @var float
     */
    private $amountNetto;

    /**
     * @var float
     */
    private $amountNettoCurrency;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var float
     */
    private $amountBrutto;

    /**
     * @var \DateTime
     */
    private $data;


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
     * Set contractorId
     *
     * @param integer $contractorId
     *
     * @return PurchaseInvoice
     */
    public function setContractorId($contractorId)
    {
        $this->contractorId = $contractorId;

        return $this;
    }

    /**
     * Get contractorId
     *
     * @return int
     */
    public function getContractorId()
    {
        return $this->contractorId;
    }

    /**
     * Set taxId
     *
     * @param integer $taxId
     *
     * @return PurchaseInvoice
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;

        return $this;
    }

    /**
     * Get taxId
     *
     * @return int
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return PurchaseInvoice
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
     * Set amountNetto
     *
     * @param float $amountNetto
     *
     * @return PurchaseInvoice
     */
    public function setAmountNetto($amountNetto)
    {
        $this->amountNetto = $amountNetto;

        return $this;
    }

    /**
     * Get amountNetto
     *
     * @return float
     */
    public function getAmountNetto()
    {
        return $this->amountNetto;
    }

    /**
     * Set amountNettoCurrency
     *
     * @param float $amountNettoCurrency
     *
     * @return PurchaseInvoice
     */
    public function setAmountNettoCurrency($amountNettoCurrency)
    {
        $this->amountNettoCurrency = $amountNettoCurrency;

        return $this;
    }

    /**
     * Get amountNettoCurrency
     *
     * @return float
     */
    public function getAmountNettoCurrency()
    {
        return $this->amountNettoCurrency;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return PurchaseInvoice
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set amountBrutto
     *
     * @param float $amountBrutto
     *
     * @return PurchaseInvoice
     */
    public function setAmountBrutto($amountBrutto)
    {
        $this->amountBrutto = $amountBrutto;

        return $this;
    }

    /**
     * Get amountBrutto
     *
     * @return float
     */
    public function getAmountBrutto()
    {
        return $this->amountBrutto;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return PurchaseInvoice
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
}

