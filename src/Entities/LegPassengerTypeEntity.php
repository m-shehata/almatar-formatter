<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Description of LegPassengerTypeEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class LegPassengerTypeEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;

    /**
     * @var string
     */
    public $PassengerType;

    /**
     * @var string
     */
    public $LegPxTypeBaggageInfoProvisionType;

    /**
     * @var string
     */
    public $LegPxTypeBaggageInfoAirlineCode;

    /**
     * @var LegPxTypeBaggageInfoAllowanceEntity
     */
    public $LegPxTypeBaggageInfoAllowance;

    /**
     * @var LegPxTypeMessageEntity
     */
    public $LegPxTypeMessages;

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
     * Retrieves the value of LegPxTypeBaggageInfoProvisionType.
     *
     * @return string
     */
    public function getLegPxTypeBaggageInfoProvisionType()
    {
        return $this->LegPxTypeBaggageInfoProvisionType;
    }

    /**
     * Sets the value for LegPxTypeBaggageInfoProvisionType.
     *
     * @param string $value
     *
     * @return self
     */
    public function setLegPxTypeBaggageInfoProvisionType(string $value): self
    {
        $this->LegPxTypeBaggageInfoProvisionType = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegPxTypeBaggageInfoAirlineCode.
     *
     * @return string
     */
    public function getLegPxTypeBaggageInfoAirlineCode()
    {
        return $this->LegPxTypeBaggageInfoAirlineCode;
    }

    /**
     * Sets the value for LegPxTypeBaggageInfoAirlineCode.
     *
     * @param string $value
     *
     * @return self
     */
    public function setLegPxTypeBaggageInfoAirlineCode(string $value): self
    {
        $this->LegPxTypeBaggageInfoAirlineCode = $value;

        return $this;
    }

    /**
     * Retrieves the value of LegPxTypeBaggageInfoAllowance.
     *
     * @return LegPxTypeBaggageInfoAllowance
     */
    public function getLegPxTypeBaggageInfoAllowance()
    {
        return $this->LegPxTypeBaggageInfoAllowance;
    }

    /**
     * Sets the value for LegPxTypeBaggageInfoAllowance.
     *
     * @param array  $value
     * @param string $locale
     *
     * @return self
     */
    public function setLegPxTypeBaggageInfoAllowance($value, $locale): self
    {
        $this->LegPxTypeBaggageInfoAllowance = new LegPxTypeBaggageInfoAllowanceEntity($value, $locale);

        return $this;
    }

    /**
     * Retrieves the value of LegPxTypeMessages.
     *
     * @return LegPxTypeMessages
     */
    public function getLegPxTypeMessages()
    {
        return $this->LegPxTypeMessages;
    }

    /**
     * Sets the value for LegPxTypeMessages.
     *
     * @param array  $value
     * @param string $locale
     *
     * @return self
     */
    public function setLegPxTypeMessages(array $value, $locale): self
    {
        foreach ($value as $message) {
            $this->LegPxTypeMessages[] = new LegPxTypeMessageEntity($message, $locale);
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

    protected function getCalculatedFields(): array
    {
        return $this->CalculatedFields;
    }

    protected function getTranslatedFields(): array
    {
        return [];
    }
}
