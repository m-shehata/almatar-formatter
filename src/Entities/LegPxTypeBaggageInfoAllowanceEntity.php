<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Oct 10, 2018
 * Description of LegPxTypeBaggageInfoAllowanceEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class LegPxTypeBaggageInfoAllowanceEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;
    /**
     * @var int
     */
    public $Pieces = 0;

    /**
     * @var float
     */
    public $Weight = 0;

    /**
     * @var string
     */
    public $Unit = 'KG';

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
     * Retrieves the value of Pieces.
     *
     * @return int
     */
    public function getPieces()
    {
        return $this->Pieces;
    }

    /**
     * Sets the value for Pieces.
     *
     * @param int $value
     *
     * @return self
     */
    public function setPieces(int $value): self
    {
        $this->Pieces = $value;

        return $this;
    }

    /**
     * Retrieves the value of Weight.
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->Weight;
    }

    /**
     * Sets the value for Weight.
     *
     * @param float $value
     *
     * @return self
     */
    public function setWeight(float $value): self
    {
        $this->Weight = $value;

        return $this;
    }

    /**
     * Retrieves the value of Unit.
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->Unit;
    }

    /**
     * Sets the value for Unit.
     *
     * @param string $value
     *
     * @return self
     */
    public function setUnit($value): self
    {
        $this->Unit = $value;

        return $this;
    }

    /**
     * Retrieve the entity class members where their name match ones that comes in the data
     * sent in the class constructor.
     *
     * @return array
     */
    public function getFillableFieldsWithSameReceivedName()
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
