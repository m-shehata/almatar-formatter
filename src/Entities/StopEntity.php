<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Description of StopEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class StopEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;

    /**
     * @var int
     */
    public $StopNum;

    /**
     * @var string
     */
    public $StopAirport;

    /**
     * @var string
     */
    public $StopAirportName;

    /**
     * @var string
     */
    public $StopAirportCountry;

    /**
     * @var string
     */
    public $StopAirportCity;

    /**
     * @var int
     */
    public $LayoverDurationInMinutes;

    /**
     * @var array ignoring calculated fields
     */
    private $CalculatedFields = ['LayoverDurationInMinutes', 'CalculatedFields', 'TranslatedFields'];

    /**
     * @var array Fields that have a translation in the search response
     */
    private $TranslatedFields = ['StopAirportName', 'StopAirportCountry', 'StopAirportCity'];

    public function __construct($data, $locale = 'ar')
    {
        $this->__init($data, $locale);
        $this->fillRequiredFields($data);
        $this->removeNull();
    }

    /**
     * Retrieves the value of StopNum.
     *
     * @return int
     */
    public function getStopNum()
    {
        return $this->StopNum;
    }

    /**
     * Sets the value for StopNum.
     *
     * @param int $value
     *
     * @return self
     */
    public function setStopNum(int $value): self
    {
        $this->StopNum = $value;

        return $this;
    }

    /**
     * Retrieves the value of StopAirport.
     *
     * @return string
     */
    public function getStopAirport()
    {
        return $this->StopAirport;
    }

    /**
     * Sets the value for StopAirport.
     *
     * @param string $value
     *
     * @return self
     */
    public function setStopAirport(string $value): self
    {
        $this->StopAirport = $value;

        return $this;
    }

    /**
     * Retrieves the value of StopAirportName.
     *
     * @return string
     */
    public function getStopAirportName()
    {
        return $this->StopAirportName;
    }

    /**
     * Sets the value for StopAirportName.
     *
     * @param string $value
     *
     * @return self
     */
    public function setStopAirportName(string $value): self
    {
        $this->StopAirportName = $value;

        return $this;
    }

    /**
     * Retrieves the value of StopAirportCountry.
     *
     * @return string
     */
    public function getStopAirportCountry()
    {
        return $this->StopAirportCountry;
    }

    /**
     * Sets the value for StopAirportCountry.
     *
     * @param string $value
     *
     * @return self
     */
    public function setStopAirportCountry(string $value): self
    {
        $this->StopAirportCountry = $value;

        return $this;
    }

    /**
     * Retrieves the value of StopAirportCity.
     *
     * @return string
     */
    public function getStopAirportCity()
    {
        return $this->StopAirportCity;
    }

    /**
     * Sets the value for StopAirportCity.
     *
     * @param string $value
     *
     * @return self
     */
    public function setStopAirportCity(string $value): self
    {
        $this->StopAirportCity = $value;

        return $this;
    }

    /**
     * Retrieves the value of LayoverDurationInMinutes.
     *
     * @return int
     */
    public function getLayoverDurationInMinutes()
    {
        return $this->LayoverDurationInMinutes;
    }

    /**
     * Sets the value for LayoverDurationInMinutes.
     *
     * @param int $value
     *
     * @return self
     */
    public function setLayoverDurationInMinutes(int $value): self
    {
        $this->LayoverDurationInMinutes = $value;

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

    protected function fillRequiredFields($data)
    {
        $this->setLayoverDurationInMinutes($data['LayoverDuration']);
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
