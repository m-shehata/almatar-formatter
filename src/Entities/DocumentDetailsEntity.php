<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Mar 21, 2019
 * Description of DocumentDetailsEntity
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class DocumentDetailsEntity extends AbstractTranslatedEntity
{

    use RemoveNullPropertiesTrait;

    /**
     * @var string
     */
    public $number;

    /**
     * @var string
     */
    public $issuing_country;

    /**
     * @var string
     */
    public $expiry_date;

    /**
     * @var string
     */
    public $nationality;
    private $CalculatedFields = ['CalculatedFields', 'issuing_country', 'expiry_date'];

    public function __construct($data, $locale = 'ar')
    {
        $this->__init($data, $locale);
        $this->setissuing_country($data['issueCountry']);
        $this->setexpiry_date($data['expirationDate']);
    }

    /**
     * Retrieves the value of number
     * @return string
     */
    public function getnumber()
    {
        return $this->number;
    }

    /**
     * Sets the value for number
     * @param string $number
     * @return self
     */
    public function setnumber(string $number): self
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Retrieves the value of issuing_country
     * @return string
     */
    public function getissuing_country()
    {
        return $this->issuing_country;
    }

    /**
     * Sets the value for issuing_country
     * @param string $issuing_country
     * @return self
     */
    public function setissuing_country(string $issuing_country): self
    {
        $this->issuing_country = $issuing_country;
        return $this;
    }

    /**
     * Retrieves the value of expiry_date
     * @return string
     */
    public function getexpiry_date()
    {
        return $this->expiry_date;
    }

    /**
     * Sets the value for expiry_date
     * @param string $expiry_date
     * @return self
     */
    public function setexpiry_date(string $expiry_date): self
    {
        $this->expiry_date = $expiry_date;
        return $this;
    }

    /**
     * Retrieves the value of nationality
     * @return string
     */
    public function getnationality()
    {
        return $this->nationality;
    }

    /**
     * Sets the value for nationality
     * @param string $nationality
     * @return self
     */
    public function setnationality(string $nationality): self
    {
        $this->nationality = $nationality;
        return $this;
    }

    protected function getTranslatedFields(): array
    {
        return [];
    }

    public function getFillableFieldsWithSameReceivedName(): array
    {
        return array_diff(array_keys(get_object_vars($this)), $this->getCalculatedFields());
    }

    public function getCalculatedFields()
    {
        return $this->CalculatedFields;
    }
}
