<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Description of SegmentPassengerTypeEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class SegmentPassengerTypeEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;
    /**
     * @var string
     */
    public $PassengerType;

    /**
     * @var int
     */
    public $SegmentPxTypeSeatsRemaining;

    /**
     * @var CabinEntity
     */
    public $SegmentPxTypeCabin;

    /**
     * @var string
     */
    public $SegmentPxTypeMealCode;

    /**
     * @var string
     */
    public $SegmentPxTypeFareBasisCode;

    /**
     * @var string
     */
    public $SegmentPxTypeBookingCode;

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
     * Retrieves the value of SegmentPxTypeSeatsRemaining.
     *
     * @return int
     */
    public function getSegmentPxTypeSeatsRemaining()
    {
        return $this->SegmentPxTypeSeatsRemaining;
    }

    /**
     * Sets the value for SegmentPxTypeSeatsRemaining.
     *
     * @param int $value
     *
     * @return self
     */
    public function setSegmentPxTypeSeatsRemaining(int $value): self
    {
        $this->SegmentPxTypeSeatsRemaining = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentPxTypeCabin.
     *
     * @return string
     */
    public function getSegmentPxTypeCabin()
    {
        return $this->SegmentPxTypeCabin;
    }

    /**
     * Sets the value for SegmentPxTypeCabin.
     *
     * @param array  $value
     * @param string $locale
     *
     * @return self
     */
    public function setSegmentPxTypeCabin(array $value, string $locale = 'ar'): self
    {
        $this->SegmentPxTypeCabin = new CabinEntity($value, $locale);

        return $this;
    }

    /**
     * Retrieves the value of SegmentPxTypeMealCode.
     *
     * @return string
     */
    public function getSegmentPxTypeMealCode()
    {
        return $this->SegmentPxTypeMealCode;
    }

    /**
     * Sets the value for SegmentPxTypeMealCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setSegmentPxTypeMealCode(string $value): self
    {
        $this->SegmentPxTypeMealCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentPxTypeFareBasisCode.
     *
     * @return string
     */
    public function getSegmentPxTypeFareBasisCode()
    {
        return $this->SegmentPxTypeFareBasisCode;
    }

    /**
     * Sets the value for SegmentPxTypeFareBasisCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setSegmentPxTypeFareBasisCode(string $value): self
    {
        $this->SegmentPxTypeFareBasisCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentPxTypeBookingCode.
     *
     * @return string
     */
    public function getSegmentPxTypeBookingCode()
    {
        return $this->SegmentPxTypeBookingCode;
    }

    /**
     * Sets the value for SegmentPxTypeBookingCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setSegmentPxTypeBookingCode(string $value): self
    {
        $this->SegmentPxTypeBookingCode = $value;

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
