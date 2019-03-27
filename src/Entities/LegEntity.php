<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Enums\FlightConnectionTypeEnum;
use AlmatarFormatter\Enums\LegDirectionalityEnum;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Description of LegEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class LegEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;

    /**
     * @var string
     */
    public $LegID;

    /**
     * @var array
     */
    public $Segments;

    /**
     * @var array
     */
    public $LegPassengerTypes;

    /**
     * @var array
     */
    public $Stops;

    /**
     * @var string
     */
    public $LegDirectionality = LegDirectionalityEnum::LEG_DEPARTURE;

    /**
     * @var int
     */
    public $LegElapsedTimeIncludingLayoverDurationInMinutes;

    /**
     * @var string
     */
    public $LegDepartureDateTime;

    /**
     * @var string
     */
    public $LegArrivalDateTime;

    /**
     * @var array
     */
    public $LegAirlinesNames;

    /**
     * @var array
     */
    public $LegAirlineLogos;

    /**
     * @var array
     */
    public $LegOperatingAirlinesNames;

    /**
     * @var array
     */
    public $LegOperatingAirlineLogos;

    /**
     * @var array
     */
    public $LegCabins;

    /**
     * @var int
     */
    public $LegSeatsRemaining;

    /**
     * @var string
     */
    public $LegDepartureAirportCode;

    /**
     * @var string
     */
    public $LegDepartureAirportName;

    /**
     * @var string
     */
    public $LegDepartureCountryName;

    /**
     * @var string
     */
    public $LegDepartureCountryCode;

    /**
     * @var string
     */
    public $LegDepartureCityName;

    /**
     * @var string
     */
    public $LegArrivalAirportCode;

    /**
     * @var string
     */
    public $LegArrivalAirportName;

    /**
     * @var string
     */
    public $LegArrivalCountryName;

    /**
     * @var string
     */
    public $LegArrivalCountryCode;

    /**
     * @var string
     */
    public $LegArrivalCityName;

    /**
     * @var int
     */
    public $LegTotalNoOfStops;

    /**
     * @var string
     */
    public $LegTotalLayoverDurationInMinutes;

    /**
     * @var array ignoring calculated fields
     */
    private $CalculatedFields = ['LegDirectionality', 'LegElapsedTimeIncludingLayoverDurationInMinutes', 'LegDepartureDateTime', 'LegArrivalDateTime', 'LegAirlinesNames', 'LegAirlineLogos', 'LegOperatingAirlinesNames', 'LegOperatingAirlineLogos', 'LegCabins', 'LegSeatsRemaining', 'LegDepartureAirportCode', 'LegDepartureAirportName', 'LegDepartureCountryName', 'LegDepartureCountryCode', 'LegDepartureCityName', 'LegArrivalAirportCode', 'LegArrivalAirportName', 'LegArrivalCountryName', 'LegArrivalCountryCode', 'LegArrivalCityName', 'LegTotalNoOfStops', 'LegTotalLayoverDurationInMinutes', 'CalculatedFields'];

    public function __construct($data, $legNo, $itenerarytype, $locale = 'ar')
    {
        $locale = $this->__init($data, $locale);
        $this->fillRequired($data, $legNo, $itenerarytype, $locale);
        $this->removeNull();
    }

    /**
     * @param array  $data
     * @param int    $legNo
     * @param string $itenerarytype
     * @param string $locale
     */
    protected function fillRequired($data, $legNo, $itenerarytype, $locale)
    {
        $firstSegment = collect($data['Segments'])->first();
        $lastSegment = collect($data['Segments'])->last();

        // if RoundTrip the second leg will be the return
        if (2 == $legNo && FlightConnectionTypeEnum::ROUND_TRIP == $itenerarytype) {
            $this->setLegDirectionality(LegDirectionalityEnum::LEG_RETURN);
        }

        $this->setLegElapsedTimeIncludingLayoverDurationInMinutes($data['LegElapsedTimeIncludingLayoverDuration']);
        $this->setLegDepartureDateTime($this->getDateString($firstSegment['SegmentDepartureDateTime']));
        $this->setLegDepartureAirportCode($firstSegment['SegmentDepartureAirportCode']);
        $this->setLegDepartureAirportName($firstSegment[$locale.'SegmentDepartureAirportName']);
        $this->setLegDepartureCountryName($firstSegment[$locale.'SegmentDepartureCountryName']);
        if (isset($firstSegment['SegmentDepartureCountryCode'])) {
            $this->setLegDepartureCountryCode($firstSegment['SegmentDepartureCountryCode']);
        }
        $this->setLegDepartureCityName($firstSegment[$locale.'SegmentDepartureCityName']);
        $this->setLegArrivalDateTime($this->getDateString($lastSegment['SegmentArrivalDateTime']));
        $this->setLegArrivalAirportCode($lastSegment['SegmentArrivalAirportCode']);
        $this->setLegArrivalAirportName($lastSegment[$locale.'SegmentArrivalAirportName']);
        $this->setLegArrivalCountryName($lastSegment[$locale.'SegmentArrivalCountryName']);
        if (isset($lastSegment['SegmentArrivalCountryCode'])) {
            $this->setLegArrivalCountryCode($lastSegment['SegmentArrivalCountryCode']);
        }
        $this->setLegArrivalCityName($lastSegment[$locale.'SegmentArrivalCityName']);
        $this->setLegCabins(collect($data['Segments'])->pluck('SegmentCabin')->unique('Code')->values()->all(), '' == $locale ? 'en' : $locale);
        if ($seatsRemaining = collect($data['Segments'])->pluck('SegmentSeatsRemaining')->min()) {
            $this->setLegSeatsRemaining($seatsRemaining);
        }
        $this->setLegAirlinesNames(collect($data['Segments'])->pluck('SegmentMarketingAirline.'.$locale.'AirlineName')->unique()->values()->all());
        $this->setLegAirlineLogos(collect($data['Segments'])->pluck('SegmentMarketingAirline.LogoUrl')->unique()->values()->all());

        // Set Operating airline
        $this->setLegOperatingAirlinesNames(collect($data['Segments'])->pluck('SegmentOperatingAirline.'.$locale.'AirlineName')->unique()->values()->all());
        $this->setLegOperatingAirlineLogos(collect($data['Segments'])->pluck('SegmentOperatingAirline.LogoUrl')->unique()->values()->all());

        $this->setLegTotalNoOfStops(collect($data['Stops'])->count());
        $this->setLegTotalLayoverDurationInMinutes(collect($data['Stops'])->sum('LayoverDuration'));
    }

    /**
     * Retrieves the value of LegID.
     *
     * @return string
     */
    public function getLegID()
    {
        return $this->LegID;
    }

    /**
     * Sets the value for LegID.
     *
     * @param string $value
     *
     * @return self
     */
    public function setLegID(string $value): self
    {
        $this->LegID = $value;

        return $this;
    }

    /**
     * Retrieves the value of Segments.
     *
     * @return array
     */
    public function getSegments()
    {
        return $this->Segments;
    }

    /**
     * Sets the value for Segments.
     *
     * @param array $value
     * @param mixed $locale
     *
     * @return self
     */
    public function setSegments(array $value, $locale): self
    {
        foreach ($value as $segment) {
            $this->Segments[] = new SegmentEntity($segment, $locale);
        }

        return $this;
    }

    /**
     * Retrieves the value of LegPassengerTypes.
     *
     * @return array
     */
    public function getLegPassengerTypes()
    {
        return $this->LegPassengerTypes;
    }

    /**
     * Sets the value for LegPassengerTypes.
     *
     * @param array  $value
     * @param string $locale
     *
     * @return self
     */
    public function setLegPassengerTypes(array $value, string $locale): self
    {
        foreach ($value as $passengerType) {
            $this->LegPassengerTypes[] = new LegPassengerTypeEntity($passengerType, $locale);
        }

        return $this;
    }

    /**
     * Retrieves the value of stops.
     *
     * @return array
     */
    public function getStops()
    {
        return $this->Stops;
    }

    /**
     * Sets the value for stops.
     *
     * @param array  $value
     * @param string $locale
     *
     * @return self
     */
    public function setStops(array $value, string $locale): self
    {
        foreach ($value as $stop) {
            $this->Stops[] = new StopEntity($stop, $locale);
        }

        return $this;
    }

    /**
     * Retrieves the value of LegDirectionality.
     *
     * @return string
     */
    public function getLegDirectionality()
    {
        return $this->LegDirectionality;
    }

    /**
     * Sets the value for LegDirectionality.
     *
     * @param string $value
     *
     * @return self
     */
    public function setLegDirectionality(string $value): self
    {
        $this->LegDirectionality = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegElapsedTimeIncludingLayoverDurationInMinutes.
     *
     * @return int
     */
    public function getLegElapsedTimeIncludingLayoverDurationInMinutes()
    {
        return $this->LegElapsedTimeIncludingLayoverDurationInMinutes;
    }

    /**
     * Sets the value for LegElapsedTimeIncludingLayoverDurationInMinutes.
     *
     * @param int $value
     *
     * @return self
     */
    public function setLegElapsedTimeIncludingLayoverDurationInMinutes(int $value): self
    {
        $this->LegElapsedTimeIncludingLayoverDurationInMinutes = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegDepartureDateTime.
     *
     * @return string
     */
    public function getLegDepartureDateTime()
    {
        return $this->LegDepartureDateTime;
    }

    /**
     * Sets the value for LegDepartureDateTime.
     *
     * @param string $value
     *
     * @return self
     */
    public function setLegDepartureDateTime(string $value): self
    {
        $this->LegDepartureDateTime = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegArrivalDateTime.
     *
     * @return string
     */
    public function getLegArrivalDateTime()
    {
        return $this->LegArrivalDateTime;
    }

    /**
     * Sets the value for LegArrivalDateTime.
     *
     * @param string $value
     *
     * @return self
     */
    public function setLegArrivalDateTime(string $value): self
    {
        $this->LegArrivalDateTime = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegAirlinesNames.
     *
     * @return array
     */
    public function getLegAirlinesNames()
    {
        return $this->LegAirlinesNames;
    }

    /**
     * Sets the value for LegAirlinesNames.
     *
     * @param array $value
     *
     * @return self
     */
    public function setLegAirlinesNames(array $value): self
    {
        $this->LegAirlinesNames = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegAirlineLogos.
     *
     * @return array
     */
    public function getLegAirlineLogos()
    {
        return $this->LegAirlineLogos;
    }

    /**
     * Sets the value for LegAirlineLogos.
     *
     * @param array $value
     *
     * @return self
     */
    public function setLegAirlineLogos(array $value): self
    {
        $this->LegAirlineLogos = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegOperatingAirlinesNames.
     *
     * @return array
     */
    public function getLegOperatingAirlinesNames()
    {
        return $this->LegOperatingAirlinesNames;
    }

    /**
     * Sets the value for LegOperatingAirlinesNames.
     *
     * @param array $value
     *
     * @return self
     */
    public function setLegOperatingAirlinesNames(array $value): self
    {
        $this->LegOperatingAirlinesNames = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegOperatingAirlineLogos.
     *
     * @return array
     */
    public function getLegOperatingAirlineLogos()
    {
        return $this->LegOperatingAirlineLogos;
    }

    /**
     * Sets the value for LegOperatingAirlineLogos.
     *
     * @param array $value
     *
     * @return self
     */
    public function setLegOperatingAirlineLogos(array $value): self
    {
        $this->LegOperatingAirlineLogos = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegCabins.
     *
     * @return array
     */
    public function getLegCabins()
    {
        return $this->LegCabins;
    }

    /**
     * Sets the value for LegCabins.
     *
     * @param array $value
     * @param mixed $locale
     *
     * @return self
     */
    public function setLegCabins(array $value, $locale): self
    {
        $cabins = [];
        foreach ($value as $cabinClass) {
            $cabins[] = new CabinEntity($cabinClass, $locale);
        }
        $this->LegCabins = $cabins;

        return $this;
    }

    /**
     * Retrieves the value of LegSeatsRemaining.
     *
     * @return int
     */
    public function getLegSeatsRemaining()
    {
        return $this->LegSeatsRemaining;
    }

    /**
     * Sets the value for LegSeatsRemaining.
     *
     * @param int $value
     *
     * @return self
     */
    public function setLegSeatsRemaining(int $value): self
    {
        $this->LegSeatsRemaining = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegDepartureAirportCode.
     *
     * @return string
     */
    public function getLegDepartureAirportCode()
    {
        return $this->LegDepartureAirportCode;
    }

    /**
     * Sets the value for LegDepartureAirportCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setLegDepartureAirportCode(string $value): self
    {
        $this->LegDepartureAirportCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegDepartureAirportName.
     *
     * @return string
     */
    public function getLegDepartureAirportName()
    {
        return $this->LegDepartureAirportName;
    }

    /**
     * Sets the value for LegDepartureAirportName.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setLegDepartureAirportName($value): self
    {
        $this->LegDepartureAirportName = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegArrivalAirportCode.
     *
     * @return string
     */
    public function getLegArrivalAirportCode()
    {
        return $this->LegArrivalAirportCode;
    }

    /**
     * Sets the value for LegArrivalAirportCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setLegArrivalAirportCode(string $value): self
    {
        $this->LegArrivalAirportCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegArrivalAirportName.
     *
     * @return string
     */
    public function getLegArrivalAirportName()
    {
        return $this->LegArrivalAirportName;
    }

    /**
     * Sets the value for LegArrivalAirportName.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setLegArrivalAirportName($value): self
    {
        $this->LegArrivalAirportName = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegTotalNoOfStops.
     *
     * @return int
     */
    public function getLegTotalNoOfStops()
    {
        return $this->LegTotalNoOfStops;
    }

    /**
     * Sets the value for LegTotalNoOfStops.
     *
     * @param int $value
     *
     * @return self
     */
    public function setLegTotalNoOfStops(int $value): self
    {
        $this->LegTotalNoOfStops = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegTotalLayoverDurationInMinutes.
     *
     * @return int
     */
    public function getLegTotalLayoverDurationInMinutes()
    {
        return $this->LegTotalLayoverDurationInMinutes;
    }

    /**
     * Sets the value for LegTotalLayoverDurationInMinutes.
     *
     * @param int $value
     *
     * @return self
     */
    public function setLegTotalLayoverDurationInMinutes(int $value): self
    {
        $this->LegTotalLayoverDurationInMinutes = $value;

        return $this;
    }

    public function getLegDepartureCountryName()
    {
        return $this->LegDepartureCountryName;
    }

    public function getLegDepartureCountryCode()
    {
        return $this->LegDepartureCountryCode;
    }

    public function getLegDepartureCityName()
    {
        return $this->LegDepartureCityName;
    }

    public function getLegArrivalCountryName()
    {
        return $this->LegArrivalCountryName;
    }

    public function getLegArrivalCountryCode()
    {
        return $this->LegArrivalCountryCode;
    }

    public function getLegArrivalCityName()
    {
        return $this->LegArrivalCityName;
    }

    public function setLegDepartureCountryName($LegDepartureCountryName)
    {
        $this->LegDepartureCountryName = $LegDepartureCountryName;

        return $this;
    }

    public function setLegDepartureCountryCode($LegDepartureCountryCode)
    {
        $this->LegDepartureCountryCode = $LegDepartureCountryCode;

        return $this;
    }

    public function setLegDepartureCityName($LegDepartureCityName)
    {
        $this->LegDepartureCityName = $LegDepartureCityName;

        return $this;
    }

    public function setLegArrivalCountryName($LegArrivalCountryName)
    {
        $this->LegArrivalCountryName = $LegArrivalCountryName;

        return $this;
    }

    public function setLegArrivalCountryCode($LegArrivalCountryCode)
    {
        $this->LegArrivalCountryCode = $LegArrivalCountryCode;

        return $this;
    }

    public function setLegArrivalCityName($LegArrivalCityName)
    {
        $this->LegArrivalCityName = $LegArrivalCityName;

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
        return [];
    }

    protected function getCalculatedFields(): array
    {
        return $this->CalculatedFields;
    }
}
