<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Enums\PassengerTypesEnum;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;
use Tightenco\Collect\Support\Arr;

/**
 * Description of IteneraryEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class IteneraryEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;

    /**
     * @var string
     */
    public $IteneraryID;

    /**
     * @var string
     */
    public $IteneraryTagID;

    /**
     * @var int
     */
    public $ItenerarySequenceNumber;

    /**
     * @var float
     */
    public $IteneraryEquivFareAmount;

    /**
     * @var string
     */
    public $IteneraryEquivFareCurrency;

    /**
     * @var float
     */
    public $IteneraryTotalTaxesAmount;

    /**
     * @var string
     */
    public $IteneraryTotalTaxesCurrency;

    /**
     * @var float
     */
    public $IteneraryTotalFareAmount;

    /**
     * @var string
     */
    public $IteneraryTotalFareCurrency;

    /**
     * @var array
     */
    public $PassengerTypes;

    /**
     * @var string
     */
    public $IteneraryTripType;

    /**
     * @var array
     */
    public $Legs;

    /**
     * @var float
     */
    public $PerPersonEquivFareAmount;

    /**
     * @var string
     */
    public $PerPersonEquivFareCurrency;

    /**
     * @var float
     */
    public $PerPersonTotalTaxAmount;

    /**
     * @var string
     */
    public $PerPersonTotalTaxCurrency;

    /**
     * @var float
     */
    public $PerPersonTotalFareAmount;

    /**
     * @var string
     */
    public $PerPersonTotalFareCurrency;

    /**
     * @var bool
     */
    public $IteneraryNonRefundableIndicator;

    /**
     * @var bool
     */
    public $Finished;

    /**
     * @var float
     */
    public $TotalFareAmountAfterAllCustDiscounts;

    /**
     * @var bool
     */
    public $canBookNowPayLater = false;

    /**
     * @var date
     */
    public $bookNowPayLaterCancellationTime;

    /**
     * @var array ignoring calculated fields
     */
    private $CalculatedFields = ['IteneraryTripType', 'PerPersonEquivFareAmount', 'PerPersonEquivFareCurrency', 'PerPersonTotalTaxAmount', 'PerPersonTotalTaxCurrency', 'PerPersonTotalFareAmount', 'PerPersonTotalFareCurrency', 'IteneraryNonRefundableIndicator',
        'TotalFareAmountAfterAllCustDiscounts', 'Finished', 'CalculatedFields', 'canBookNowPayLater', 'bookNowPayLaterCancellationTime', ];

    public function __construct($data, $locale = 'ar')
    {
        $this->__init($data, $locale);
        $this->removeNull();
    }

    /**
     * @param array $data
     * @param mixed $locale
     */
    protected function __init($data, $locale)
    {
        $this->setFinished($data['Finished'] ?? false);
        if (isset($data['TotalFareAmountAfterAllCustDiscounts']) || isset($data['IteneraryTotalFareAmount'])) {
            $this->setTotalFareAmountAfterAllCustDiscounts($data['TotalFareAmountAfterAllCustDiscounts'] ?? $data['IteneraryTotalFareAmount']);
        }
        if (isset($data['IteneraryDirectionInd'])) {
            $this->setIteneraryTripType($data['IteneraryDirectionInd']);
        }

        //booking Agg fare change
        if (isset($data['fareInfo'])) {
            $fare = Arr::only($data['fareInfo'], ['IteneraryEquivFareAmount', 'IteneraryEquivFareCurrency', 'IteneraryTotalFareAmount', 'IteneraryTotalFareCurrency', 'IteneraryTotalTaxesAmount', 'IteneraryTotalTaxesCurrency']);
            foreach ($fare as $key => $value) {
                $this->{'set'.$key}($value);
            }
            $this->setTotalFareAmountAfterAllCustDiscounts($data['customerPrice']['amountWithMarkeup']);
        }

        $lastTicketDate = $data['IteneraryLastTicketDate'];

        if ('N/A' != $lastTicketDate) {
            $lastTicketDate = new \DateTime($lastTicketDate, new \DateTimeZone('GMT'));
            if ($lastTicketDate > (new \DateTime('today', new \DateTimeZone('GMT')))) {
                $this->setbookNowPayLaterCancellationTime($lastTicketDate->getTimestamp());
                $this->setcanBookNowPayLater(true);
            }
        }

        $adultPassengerType = collect($data['PassengerTypes'])
            ->where('PassengerType', '=', PassengerTypesEnum::ADULT)
            ->first();

        if (isset($adultPassengerType['FareInfo'])) {
            $data['PassengerTypes'] = collect($data['PassengerTypes'])
                ->map(function ($passengerType) {
                    return array_merge($passengerType, $passengerType['FareInfo']);
                })
                ->all();
        }
        
        if (isset($adultPassengerType['PxTypeEquivFareAmount'])) {
            $this->setPerPersonEquivFareAmount($adultPassengerType['PxTypeEquivFareAmount']);
        }
        if (isset($adultPassengerType['PxTypeEquivFareCurrency'])) {
            $this->setPerPersonEquivFareCurrency($adultPassengerType['PxTypeEquivFareCurrency']);
        }
        if (isset($adultPassengerType['PxTypeTotalTaxAmount'])) {
            $this->setPerPersonTotalTaxAmount($adultPassengerType['PxTypeTotalTaxAmount']);
        }
        if (isset($adultPassengerType['PxTypeTotalTaxCurrency'])) {
            $this->setPerPersonTotalTaxCurrency($adultPassengerType['PxTypeTotalTaxCurrency']);
        }
        if (isset($adultPassengerType['PxTypeTotalFareAmount'])) {
            $this->setPerPersonTotalFareAmount($adultPassengerType['PxTypeTotalFareAmount']);
        }
        if (isset($adultPassengerType['PxTypeTotalFareCurrency'])) {
            $this->setPerPersonTotalFareCurrency($adultPassengerType['PxTypeTotalFareCurrency']);
        }
        if (isset($adultPassengerType['PxTypeNonRefundableIndicator'])) {
            $this->setIteneraryNonRefundableIndicator($adultPassengerType['PxTypeNonRefundableIndicator']);
        }

        parent::__init($data, $locale);
    }

    /**
     * Retrieves the value of IteneraryID.
     *
     * @return string
     */
    public function getIteneraryID()
    {
        return $this->IteneraryID;
    }

    /**
     * Sets the value for IteneraryID.
     *
     * @param string $value
     *
     * @return self
     */
    public function setIteneraryID(string $value): self
    {
        $this->IteneraryID = $value;

        return $this;
    }

    /**
     * Retrieves the value of IteneraryTagID.
     *
     * @return string
     */
    public function getIteneraryTagID()
    {
        return $this->IteneraryTagID;
    }

    /**
     * Sets the value for IteneraryTagID.
     *
     * @param string $value
     *
     * @return self
     */
    public function setIteneraryTagID(string $value): self
    {
        $this->IteneraryTagID = $value;

        return $this;
    }

    /**
     * Retrieves the value of ItenerarySequenceNumber.
     *
     * @return int
     */
    public function getItenerarySequenceNumber()
    {
        return $this->ItenerarySequenceNumber;
    }

    /**
     * Sets the value for ItenerarySequenceNumber.
     *
     * @param int $value
     *
     * @return self
     */
    public function setItenerarySequenceNumber(int $value): self
    {
        $this->ItenerarySequenceNumber = $value;

        return $this;
    }

    /**
     * Retrieves the value of IteneraryEquivFareAmount.
     *
     * @return float
     */
    public function getIteneraryEquivFareAmount()
    {
        return $this->IteneraryEquivFareAmount;
    }

    /**
     * Sets the value for IteneraryEquivFareAmount.
     *
     * @param float $value
     *
     * @return self
     */
    public function setIteneraryEquivFareAmount(float $value): self
    {
        $this->IteneraryEquivFareAmount = ceil($value);

        return $this;
    }

    /**
     * Retrieves the value of IteneraryEquivFareCurrency.
     *
     * @return string
     */
    public function getIteneraryEquivFareCurrency()
    {
        return $this->IteneraryEquivFareCurrency;
    }

    /**
     * Sets the value for IteneraryEquivFareCurrency.
     *
     * @param string $value
     *
     * @return self
     */
    public function setIteneraryEquivFareCurrency(string $value): self
    {
        $this->IteneraryEquivFareCurrency = $value;

        return $this;
    }

    /**
     * Retrieves the value of IteneraryTotalTaxesAmount.
     *
     * @return float
     */
    public function getIteneraryTotalTaxesAmount()
    {
        return $this->IteneraryTotalTaxesAmount;
    }

    /**
     * Sets the value for IteneraryTotalTaxesAmount.
     *
     * @param float $value
     *
     * @return self
     */
    public function setIteneraryTotalTaxesAmount(float $value): self
    {
        $this->IteneraryTotalTaxesAmount = ceil($value);

        return $this;
    }

    /**
     * Retrieves the value of IteneraryTotalTaxesCurrency.
     *
     * @return string
     */
    public function getIteneraryTotalTaxesCurrency()
    {
        return $this->IteneraryTotalTaxesCurrency;
    }

    /**
     * Sets the value for IteneraryTotalTaxesCurrency.
     *
     * @param string $value
     *
     * @return self
     */
    public function setIteneraryTotalTaxesCurrency(string $value): self
    {
        $this->IteneraryTotalTaxesCurrency = $value;

        return $this;
    }

    /**
     * Retrieves the value of IteneraryTotalFareAmount.
     *
     * @return float
     */
    public function getIteneraryTotalFareAmount()
    {
        return $this->IteneraryTotalFareAmount;
    }

    /**
     * Sets the value for IteneraryTotalFareAmount.
     *
     * @param float $value
     *
     * @return self
     */
    public function setIteneraryTotalFareAmount(float $value): self
    {
        $this->IteneraryTotalFareAmount = ceil($value);

        return $this;
    }

    /**
     * Retrieves the value of IteneraryTotalFareCurrency.
     *
     * @return string
     */
    public function getIteneraryTotalFareCurrency()
    {
        return $this->IteneraryTotalFareCurrency;
    }

    /**
     * Sets the value for IteneraryTotalFareCurrency.
     *
     * @param string $value
     *
     * @return self
     */
    public function setIteneraryTotalFareCurrency(string $value): self
    {
        $this->IteneraryTotalFareCurrency = $value;

        return $this;
    }

    /**
     * Retrieves the value of PassengerTypes.
     *
     * @return array
     */
    public function getPassengerTypes()
    {
        return $this->PassengerTypes;
    }

    /**
     * Sets the value for PassengerTypes.
     *
     * @param array $value
     *
     * @return self
     */
    public function setPassengerTypes(array $value): self
    {
        foreach ($value as $passengerType) {
            $this->PassengerTypes[] = new IteneraryPassengerTypeEntity($passengerType);
        }

        return $this;
    }

    /**
     * Retrieves the value of legs.
     *
     * @return array
     */
    public function getLegs()
    {
        return $this->Legs;
    }

    /**
     * Sets the value for legs.
     *
     * @param array  $value
     * @param string $locale
     *
     * @return self
     */
    public function setLegs(array $value, $locale): self
    {
        for ($i = 0; $i < count($value); ++$i) {
            $this->Legs[] = new LegEntity($value[$i], ($i + 1), $this->getIteneraryTripType(), $locale);
        }

        return $this;
    }

    /**
     * Retrieves the value of IteneraryTripType.
     *
     * @return string
     */
    public function getIteneraryTripType()
    {
        return $this->IteneraryTripType;
    }

    /**
     * Sets the value for IteneraryTripType.
     *
     * @param string $value
     *
     * @return self
     */
    public function setIteneraryTripType(string $value): self
    {
        $this->IteneraryTripType = $value;

        return $this;
    }

    /**
     * Retrieves the value of PerPersonEquivFareAmount.
     *
     * @return float
     */
    public function getPerPersonEquivFareAmount()
    {
        return $this->PerPersonEquivFareAmount;
    }

    /**
     * Sets the value for PerPersonEquivFareAmount.
     *
     * @param float $value
     *
     * @return self
     */
    public function setPerPersonEquivFareAmount(float $value): self
    {
        $this->PerPersonEquivFareAmount = ceil($value);

        return $this;
    }

    /**
     * Retrieves the value of PerPersonEquivFareCurrency.
     *
     * @return string
     */
    public function getPerPersonEquivFareCurrency()
    {
        return $this->PerPersonEquivFareCurrency;
    }

    /**
     * Sets the value for PerPersonEquivFareCurrency.
     *
     * @param string $value
     *
     * @return self
     */
    public function setPerPersonEquivFareCurrency(string $value): self
    {
        $this->PerPersonEquivFareCurrency = $value;

        return $this;
    }

    /**
     * Retrieves the value of PerPersonTotalTaxAmount.
     *
     * @return float
     */
    public function getPerPersonTotalTaxAmount()
    {
        return $this->PerPersonTotalTaxAmount;
    }

    /**
     * Sets the value for PerPersonTotalTaxAmount.
     *
     * @param float $value
     *
     * @return self
     */
    public function setPerPersonTotalTaxAmount(float $value): self
    {
        $this->PerPersonTotalTaxAmount = ceil($value);

        return $this;
    }

    /**
     * Retrieves the value of PerPersonTotalTaxCurrency.
     *
     * @return string
     */
    public function getPerPersonTotalTaxCurrency()
    {
        return $this->PerPersonTotalTaxCurrency;
    }

    /**
     * Sets the value for PerPersonTotalTaxCurrency.
     *
     * @param string $value
     *
     * @return self
     */
    public function setPerPersonTotalTaxCurrency(string $value): self
    {
        $this->PerPersonTotalTaxCurrency = $value;

        return $this;
    }

    /**
     * Retrieves the value of PerPersonTotalFareAmount.
     *
     * @return float
     */
    public function getPerPersonTotalFareAmount()
    {
        return $this->PerPersonTotalFareAmount;
    }

    /**
     * Sets the value for PerPersonTotalFareAmount.
     *
     * @param float $value
     *
     * @return self
     */
    public function setPerPersonTotalFareAmount(float $value): self
    {
        $this->PerPersonTotalFareAmount = ceil($value);

        return $this;
    }

    /**
     * Retrieves the value of PerPersonTotalFareCurrency.
     *
     * @return string
     */
    public function getPerPersonTotalFareCurrency()
    {
        return $this->PerPersonTotalFareCurrency;
    }

    /**
     * Sets the value for PerPersonTotalFareCurrency.
     *
     * @param string $value
     *
     * @return self
     */
    public function setPerPersonTotalFareCurrency(string $value): self
    {
        $this->PerPersonTotalFareCurrency = $value;

        return $this;
    }

    /**
     * Retrieves the value of IteneraryNonRefundableIndicator.
     *
     * @return bool
     */
    public function getIteneraryNonRefundableIndicator()
    {
        return $this->IteneraryNonRefundableIndicator;
    }

    /**
     * Sets the value for IteneraryNonRefundableIndicator.
     *
     * @param bool $value
     *
     * @return self
     */
    public function setIteneraryNonRefundableIndicator(bool $value): self
    {
        $this->IteneraryNonRefundableIndicator = $value;

        return $this;
    }

    /**
     * Retrieves the value of Finished for itinerary batch.
     *
     * @return bool
     */
    public function getFinished()
    {
        return $this->Finished;
    }

    /**
     * Sets the value for Finished.
     *
     * @param bool $Finished
     *
     * @return self
     */
    public function setFinished($Finished)
    {
        $this->Finished = $Finished;

        return $this;
    }

    public function getTotalFareAmountAfterAllCustDiscounts()
    {
        return $this->TotalFareAmountAfterAllCustDiscounts;
    }

    public function setTotalFareAmountAfterAllCustDiscounts($TotalFareAmountAfterAllCustDiscounts)
    {
        $this->TotalFareAmountAfterAllCustDiscounts = $TotalFareAmountAfterAllCustDiscounts;

        return $this;
    }

    public function getcanBookNowPayLater()
    {
        return $this->canBookNowPayLater;
    }

    public function getbookNowPayLaterCancellationTime()
    {
        return $this->bookNowPayLaterCancellationTime;
    }

    public function setcanBookNowPayLater($canBookNowPayLater)
    {
        $this->canBookNowPayLater = $canBookNowPayLater;

        return $this;
    }

    /**
     * @param int $bookNowPayLaterCancellationTime max cancellation time timestamp
     *
     * @return self
     */
    public function setbookNowPayLaterCancellationTime(int $bookNowPayLaterCancellationTime): self
    {
        $this->bookNowPayLaterCancellationTime = $bookNowPayLaterCancellationTime;

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
