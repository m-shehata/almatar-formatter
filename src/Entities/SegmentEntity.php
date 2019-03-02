<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Description of SegmentEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class SegmentEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;
    /**
     * @var string
     */
    public $SegmentID;

    /**
     * @var string
     */
    public $SegmentDepartureDateTime;

    /**
     * @var string
     */
    public $SegmentArrivalDateTime;

    /**
     * @var string
     */
    public $SegmentResBookDesigCode;

    /**
     * @var string
     */
    public $SegmentFlightNumber;

    /**
     * @var int
     */
    public $SegmentElapsedTime;

    /**
     * @var string
     */
    public $SegmentDepartureAirportCode;

    /**
     * @var string
     */
    public $SegmentDepartureAirportName;

    /**
     * @var string
     */
    public $SegmentDepartureCountryName;

    /**
     * @var string
     */
    public $SegmentDepartureCountryCode;

    /**
     * @var string
     */
    public $SegmentDepartureCityName;

    /**
     * @var string
     */
    public $SegmentDepartureAirportTerminalID;

    /**
     * @var string
     */
    public $SegmentArrivalAirportCode;

    /**
     * @var string
     */
    public $SegmentArrivalAirportName;

    /**
     * @var string
     */
    public $SegmentArrivalCountryName;

    /** @var string
     */
    public $SegmentArrivalCountryCode;

    /**
     * @var string
     */
    public $SegmentArrivalCityName;

    /**
     * @var string
     */
    public $SegmentArrivalAirportTerminalID;

    /**
     * @var float
     */
    public $SegmentDepartureTimeZoneGMTOffset;

    /**
     * @var float
     */
    public $SegmentArrivalTimeZoneGMTOffset;

    /**
     * @var SegmentAirlineEntity
     */
    public $SegmentOperatingAirline;
    /**
     * @var SegmentAirlineEntity
     */
    public $SegmentMarketingAirline;

    /**
     * @var string
     */
    public $SegmentAircraftTypeCode;

    /**
     * @var string
     */
    public $SegmentAircraftTypeName;

    /**
     * @var string
     */
    public $SegmentFareReference;

    /**
     * @var int
     */
    public $SegmentSeatsRemaining;

    /**
     * @var CabinEntity
     */
    public $SegmentCabin;

    /**
     * @var string
     */
    public $SegmentMealCode;

    /**
     * @var SegmentPassengerTypeEntity
     */
    public $SegmentPassengerType;

    /**
     * @var array ignoring calculated fields
     */
    private $CalculatedFields = ['CalculatedFields', 'TranslatedFields'];

    /**
     * @var array Fields that have a translation in the search response
     */
    private $TranslatedFields = ['SegmentArrivalAirportName', 'SegmentArrivalCountryName', 'SegmentArrivalCityName', 'SegmentDepartureAirportName', 'SegmentDepartureCountryName', 'SegmentDepartureCityName'];

    public function __construct($data, $locale = 'ar')
    {
        $this->__init($data, $locale);
        $this->removeNull();
    }

    /**
     * Retrieves the value of SegmentID.
     *
     * @return string
     */
    public function getSegmentID()
    {
        return $this->SegmentID;
    }

    /**
     * Sets the value for SegmentID.
     *
     * @param string $value
     *
     * @return self
     */
    public function setSegmentID(string $value): self
    {
        $this->SegmentID = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentDepartureDateTime.
     *
     * @return string
     */
    public function getSegmentDepartureDateTime()
    {
        return $this->SegmentDepartureDateTime;
    }

    /**
     * Sets the value for SegmentDepartureDateTime.
     *
     * @param string $value
     *
     * @return self
     */
    public function setSegmentDepartureDateTime(string $value): self
    {
        $this->SegmentDepartureDateTime = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentArrivalDateTime.
     *
     * @return string
     */
    public function getSegmentArrivalDateTime()
    {
        return $this->SegmentArrivalDateTime;
    }

    /**
     * Sets the value for SegmentArrivalDateTime.
     *
     * @param string $value
     *
     * @return self
     */
    public function setSegmentArrivalDateTime(string $value): self
    {
        $this->SegmentArrivalDateTime = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentResBookDesigCode.
     *
     * @return string
     */
    public function getSegmentResBookDesigCode()
    {
        return $this->SegmentResBookDesigCode;
    }

    /**
     * Sets the value for SegmentResBookDesigCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setSegmentResBookDesigCode(string $value): self
    {
        $this->SegmentResBookDesigCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentFlightNumber.
     *
     * @return string
     */
    public function getSegmentFlightNumber()
    {
        return $this->SegmentFlightNumber;
    }

    /**
     * Sets the value for SegmentFlightNumber.
     *
     * @param string $value
     *
     * @return self
     */
    public function setSegmentFlightNumber(string $value): self
    {
        $this->SegmentFlightNumber = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentElapsedTime.
     *
     * @return int
     */
    public function getSegmentElapsedTime()
    {
        return $this->SegmentElapsedTime;
    }

    /**
     * Sets the value for SegmentElapsedTime.
     *
     * @param int $value
     *
     * @return self
     */
    public function setSegmentElapsedTime(int $value): self
    {
        $this->SegmentElapsedTime = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentDepartureAirportCode.
     *
     * @return string
     */
    public function getSegmentDepartureAirportCode()
    {
        return $this->SegmentDepartureAirportCode;
    }

    /**
     * Sets the value for SegmentDepartureAirportCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setSegmentDepartureAirportCode(string $value): self
    {
        $this->SegmentDepartureAirportCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentDepartureAirportName.
     *
     * @return string
     */
    public function getSegmentDepartureAirportName()
    {
        return $this->SegmentDepartureAirportName;
    }

    /**
     * Sets the value for SegmentDepartureAirportName.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setSegmentDepartureAirportName($value): self
    {
        $this->SegmentDepartureAirportName = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentDepartureCountryName.
     *
     * @return string
     */
    public function getSegmentDepartureCountryName()
    {
        return $this->SegmentDepartureCountryName;
    }

    /**
     * Sets the value for SegmentDepartureCountryName.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setSegmentDepartureCountryName($value): self
    {
        $this->SegmentDepartureCountryName = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentDepartureCountryCode.
     *
     * @return string
     */
    public function getSegmentDepartureCountryCode()
    {
        return $this->SegmentDepartureCountryCode;
    }

    /**
     * Sets the value for SegmentDepartureCountryCode.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setSegmentDepartureCountryCode($value): self
    {
        $this->SegmentDepartureCountryCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentDepartureCityName.
     *
     * @return string
     */
    public function getSegmentDepartureCityName()
    {
        return $this->SegmentDepartureCityName;
    }

    /**
     * Sets the value for SegmentDepartureCityName.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setSegmentDepartureCityName($value): self
    {
        $this->SegmentDepartureCityName = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentDepartureAirportTerminalID.
     *
     * @return string
     */
    public function getSegmentDepartureAirportTerminalID()
    {
        return $this->SegmentDepartureAirportTerminalID;
    }

    /**
     * Sets the value for SegmentDepartureAirportTerminalID.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setSegmentDepartureAirportTerminalID($value): self
    {
        $this->SegmentDepartureAirportTerminalID = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentArrivalAirportCode.
     *
     * @return string
     */
    public function getSegmentArrivalAirportCode()
    {
        return $this->SegmentArrivalAirportCode;
    }

    /**
     * Sets the value for SegmentArrivalAirportCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setSegmentArrivalAirportCode(string $value): self
    {
        $this->SegmentArrivalAirportCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentArrivalAirportName.
     *
     * @return mixed
     */
    public function getSegmentArrivalAirportName()
    {
        return $this->SegmentArrivalAirportName;
    }

    /**
     * Sets the value for SegmentArrivalAirportName.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setSegmentArrivalAirportName($value): self
    {
        $this->SegmentArrivalAirportName = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentArrivalCountryName.
     *
     * @return mixed
     */
    public function getSegmentArrivalCountryName()
    {
        return $this->SegmentArrivalCountryName;
    }

    /**
     * Sets the value for SegmentArrivalCountryName.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setSegmentArrivalCountryName($value): self
    {
        $this->SegmentArrivalCountryName = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentArrivalCountryCode.
     *
     * @return mixed
     */
    public function getSegmentArrivalCountryCode()
    {
        return $this->SegmentArrivalCountryCode;
    }

    /**
     * Sets the value for SegmentArrivalCountryCode.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setSegmentArrivalCountryCode($value): self
    {
        $this->SegmentArrivalCountryCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentArrivalCityName.
     *
     * @return mixed
     */
    public function getSegmentArrivalCityName()
    {
        return $this->SegmentArrivalCityName;
    }

    /**
     * Sets the value for SegmentArrivalCityName.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setSegmentArrivalCityName($value): self
    {
        $this->SegmentArrivalCityName = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentArrivalAirportTerminalID.
     *
     * @return mixed
     */
    public function getSegmentArrivalAirportTerminalID()
    {
        return $this->SegmentArrivalAirportTerminalID;
    }

    /**
     * Sets the value for SegmentArrivalAirportTerminalID.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setSegmentArrivalAirportTerminalID($value): self
    {
        $this->SegmentArrivalAirportTerminalID = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentDepartureTimeZoneGMTOffset.
     *
     * @return float
     */
    public function getSegmentDepartureTimeZoneGMTOffset()
    {
        return $this->SegmentDepartureTimeZoneGMTOffset;
    }

    /**
     * Sets the value for SegmentDepartureTimeZoneGMTOffset.
     *
     * @param float $value
     *
     * @return self
     */
    public function setSegmentDepartureTimeZoneGMTOffset(float $value): self
    {
        $this->SegmentDepartureTimeZoneGMTOffset = $value;

        return $this;
    }

    /**
     * Retrieves the value of SegmentArrivalTimeZoneGMTOffset.
     *
     * @return float
     */
    public function getSegmentArrivalTimeZoneGMTOffset()
    {
        return $this->SegmentArrivalTimeZoneGMTOffset;
    }

    /**
     * Sets the value for SegmentArrivalTimeZoneGMTOffset.
     *
     * @param float $value
     *
     * @return self
     */
    public function setSegmentArrivalTimeZoneGMTOffset(float $value): self
    {
        $this->SegmentArrivalTimeZoneGMTOffset = $value;

        return $this;
    }

    public function getSegmentOperatingAirline(): SegmentAirlineEntity
    {
        return $this->SegmentOperatingAirline;
    }

    public function getSegmentMarketingAirline(): SegmentAirlineEntity
    {
        return $this->SegmentMarketingAirline;
    }

    public function getSegmentAircraftTypeCode()
    {
        return $this->SegmentAircraftTypeCode;
    }

    public function getSegmentAircraftTypeName()
    {
        return $this->SegmentAircraftTypeName;
    }

    public function getSegmentFareReference()
    {
        return $this->SegmentFareReference;
    }

    public function getSegmentSeatsRemaining()
    {
        return $this->SegmentSeatsRemaining;
    }

    public function getSegmentCabin()
    {
        return $this->SegmentCabin;
    }

    public function getSegmentMealCode()
    {
        return $this->SegmentMealCode;
    }

    public function getSegmentPassengerType(): SegmentPassengerTypeEntity
    {
        return $this->SegmentPassengerType;
    }

    public function setSegmentOperatingAirline($value, $locale)
    {
        $this->SegmentOperatingAirline = new SegmentAirlineEntity($value, $locale);

        return $this;
    }

    public function setSegmentMarketingAirline($value, $locale)
    {
        $this->SegmentMarketingAirline = new SegmentAirlineEntity($value, $locale);

        return $this;
    }

    public function setSegmentAircraftTypeCode($SegmentAircraftTypeCode)
    {
        $this->SegmentAircraftTypeCode = $SegmentAircraftTypeCode;

        return $this;
    }

    public function setSegmentAircraftTypeName($SegmentAircraftTypeName)
    {
        $this->SegmentAircraftTypeName = $SegmentAircraftTypeName;

        return $this;
    }

    public function setSegmentFareReference($SegmentFareReference)
    {
        $this->SegmentFareReference = $SegmentFareReference;

        return $this;
    }

    public function setSegmentSeatsRemaining($SegmentSeatsRemaining)
    {
        $this->SegmentSeatsRemaining = $SegmentSeatsRemaining;

        return $this;
    }

    public function setSegmentCabin($SegmentCabin, $locale)
    {
        $this->SegmentCabin = new CabinEntity($SegmentCabin, $locale);

        return $this;
    }

    public function setSegmentMealCode($SegmentMealCode)
    {
        $this->SegmentMealCode = $SegmentMealCode;

        return $this;
    }

    public function setSegmentPassengerType($value, $locale)
    {
        foreach ($value as $segmentPassengerType) {
            $this->SegmentPassengerType[] = new SegmentPassengerTypeEntity($segmentPassengerType, $locale);
        }

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
