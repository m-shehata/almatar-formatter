<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Description of SegmentAirlineEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class SegmentAirlineEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;
    /**
     * @var string
     */
    public $AirlineCode;

    /**
     * @var string
     */
    public $AllianceCode;

    /**
     * @var string
     */
    public $LogoUrl;

    /**
     * @var string
     */
    public $AllianceLogoUrl;

    /**
     * @var string
     */
    public $AirlineName;

    /**
     * @var string
     */
    public $AllianceName;

    /**
     * @var string
     */
    public $FlightNumber;

    /**
     * @var array ignoring calculated fields
     */
    private $CalculatedFields = ['CalculatedFields', 'TranslatedFields'];

    /**
     * @var array Fields that have a translation in the search response
     */
    private $TranslatedFields = ['AirlineName', 'AllianceName'];

    public function __construct($data, $locale = 'ar')
    {
        $this->__init($data, $locale);
        $this->removeNull();
    }

    /**
     * Retrieves the value of AirlineCode.
     *
     * @return string
     */
    public function getAirlineCode()
    {
        return $this->AirlineCode;
    }

    /**
     * Sets the value for AirlineCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setAirlineCode(string $value): self
    {
        $this->AirlineCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of AllianceCode.
     *
     * @return string
     */
    public function getAllianceCode()
    {
        return $this->AllianceCode;
    }

    /**
     * Sets the value for AllianceCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setAllianceCode(string $value): self
    {
        $this->AllianceCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of Airline LogoUrl.
     *
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->LogoUrl;
    }

    /**
     * Sets the value for Airline LogoUrl.
     *
     * @param string $value
     *
     * @return self
     */
    public function setLogoUrl(string $value): self
    {
        $this->LogoUrl = $value;

        return $this;
    }

    /**
     * Retrieves the value of Alliance LogoUrl.
     *
     * @return string
     */
    public function getAllianceLogoUrl()
    {
        return $this->AllianceLogoUrl;
    }

    /**
     * Sets the value for Alliance LogoUrl.
     *
     * @param string $value
     *
     * @return self
     */
    public function setAllianceLogoUrl($value)
    {
        $this->AllianceLogoUrl = $value;

        return $this;
    }

    /**
     * Retrieves the value of AirlineName.
     *
     * @return string
     */
    public function getAirlineName()
    {
        return $this->AirlineName;
    }

    /**
     * Sets the value for AirlineName.
     *
     * @param string $value
     *
     * @return self
     */
    public function setAirlineName(string $value): self
    {
        $this->AirlineName = $value;

        return $this;
    }

    /**
     * Retrieves the value of AllianceName.
     *
     * @return string
     */
    public function getAllianceName()
    {
        return $this->AllianceName;
    }

    /**
     * Sets the value for AllianceName.
     *
     * @param string $value
     *
     * @return self
     */
    public function setAllianceName(string $value): self
    {
        $this->AllianceName = $value;

        return $this;
    }

    /**
     * Retrieves the value of FlightNumber.
     *
     * @return string
     */
    public function getFlightNumber()
    {
        return $this->FlightNumber;
    }

    /**
     * Sets the value for FlightNumber.
     *
     * @param string $value
     *
     * @return self
     */
    public function setFlightNumber(string $value): self
    {
        $this->FlightNumber = $value;

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

    /**
     * {@inheritdoc}
     */
    protected function getTranslatedFields(): array
    {
        return $this->TranslatedFields;
    }

    protected function getCalculatedFields(): array
    {
        return $this->CalculatedFields;
    }
}
