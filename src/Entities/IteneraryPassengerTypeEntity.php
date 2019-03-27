<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Description of IteneraryPassengerTypeEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class IteneraryPassengerTypeEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;
    /**
     * @var string
     */
    public $PassengerType;

    /**
     * @var int
     */
    public $Count;

    /**
     * @var bool
     */
    public $PxTypeNonRefundableIndicator;

    /**
     * @var float
     */
    public $PxTypeEquivFareAmount;

    /**
     * @var string
     */
    public $PxTypeEquivFareCurrency;

    /**
     * @var float
     */
    public $PxTypeTotalTaxAmount;

    /**
     * @var string
     */
    public $PxTypeTotalTaxCurrency;

    /**
     * @var float
     */
    public $PxTypeTotalFareAmount;

    /**
     * @var string
     */
    public $PxTypeTotalFareCurrency;
    public $PxTypePenalty;

    /**
     * @var array ignoring calculated fields
     */
    private $CalculatedFields = ['CalculatedFields'];

    public function __construct($data, $locale = 'ar')
    {
        $this->__init($data, $locale);
        $this->removeNull();
    }

    /**
     * Retrieves the value of PassengerType.
     *
     * @return string
     */
    public function getPassengerType()
    {
        return $this->PassengerType;
    }

    /**
     * Sets the value for PassengerType.
     *
     * @param string $value
     *
     * @return self
     */
    public function setPassengerType(string $value): self
    {
        $this->PassengerType = $value;

        return $this;
    }

    /**
     * Retrieves the value of Count.
     *
     * @return int
     */
    public function getCount()
    {
        return $this->Count;
    }

    /**
     * Sets the value for Count.
     *
     * @param int $value
     *
     * @return self
     */
    public function setCount(int $value): self
    {
        $this->Count = $value;

        return $this;
    }

    /**
     * Retrieves the value of PxTypeNonRefundableIndicator.
     *
     * @return bool
     */
    public function getPxTypeNonRefundableIndicator()
    {
        return $this->PxTypeNonRefundableIndicator;
    }

    /**
     * Sets the value for PxTypeNonRefundableIndicator.
     *
     * @param bool $value
     *
     * @return self
     */
    public function setPxTypeNonRefundableIndicator(bool $value): self
    {
        $this->PxTypeNonRefundableIndicator = $value;

        return $this;
    }

    public function getPxTypeEquivFareAmount()
    {
        return $this->PxTypeEquivFareAmount;
    }

    public function getPxTypeEquivFareCurrency()
    {
        return $this->PxTypeEquivFareCurrency;
    }

    public function getPxTypeTotalTaxAmount()
    {
        return $this->PxTypeTotalTaxAmount;
    }

    public function getPxTypeTotalTaxCurrency()
    {
        return $this->PxTypeTotalTaxCurrency;
    }

    public function getPxTypeTotalFareAmount()
    {
        return $this->PxTypeTotalFareAmount;
    }

    public function getPxTypeTotalFareCurrency()
    {
        return $this->PxTypeTotalFareCurrency;
    }

    public function getPxTypePenalty()
    {
        return $this->PxTypePenalty;
    }

    public function setPxTypeEquivFareAmount($PxTypeEquivFareAmount)
    {
        $this->PxTypeEquivFareAmount = $PxTypeEquivFareAmount;

        return $this;
    }

    public function setPxTypeEquivFareCurrency($PxTypeEquivFareCurrency)
    {
        $this->PxTypeEquivFareCurrency = $PxTypeEquivFareCurrency;

        return $this;
    }

    public function setPxTypeTotalTaxAmount($PxTypeTotalTaxAmount)
    {
        $this->PxTypeTotalTaxAmount = $PxTypeTotalTaxAmount;

        return $this;
    }

    public function setPxTypeTotalTaxCurrency($PxTypeTotalTaxCurrency)
    {
        $this->PxTypeTotalTaxCurrency = $PxTypeTotalTaxCurrency;

        return $this;
    }

    public function setPxTypeTotalFareAmount($PxTypeTotalFareAmount)
    {
        $this->PxTypeTotalFareAmount = $PxTypeTotalFareAmount;

        return $this;
    }

    public function setPxTypeTotalFareCurrency($PxTypeTotalFareCurrency)
    {
        $this->PxTypeTotalFareCurrency = $PxTypeTotalFareCurrency;

        return $this;
    }

    public function setPxTypePenalty($PxTypePenalty)
    {
        $this->PxTypePenalty = $PxTypePenalty;

        return $this;
    }

    /**
     * Retrieve the entity class members where their name match ones that comes in the data
     * sent in the class constructor.
     *
     * @return array
     */
    public function getFillableFieldsWithSameReceivedName(): array
    {
        return array_diff(array_keys(get_object_vars($this)), $this->getCalculatedFields());
    }

    protected function getCalculatedFields(): array
    {
        return $this->CalculatedFields;
    }

    protected function getTranslatedFields(): array
    {
        return [];
    }
}
