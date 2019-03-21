<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Mar 21, 2019
 * Description of PhoneEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class PhoneEntity extends AbstractTranslatedEntity
{

    use RemoveNullPropertiesTrait;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $number;
    private $CalculatedFields = ['CalculatedFields', 'code', 'number'];

    public function __construct($data, $locale = 'ar')
    {
        if (!(bool) $data) {
            return;
        }
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        try {
            $number = $phoneUtil->parse($data);
            $this->setcode('+' . $number->getCountryCode());
            $this->setnumber($number->getNationalNumber());
        } catch (\libphonenumber\NumberParseException $e) {
            
        }
    }

    /**
     * Retrieves the value of code.
     *
     * @return string
     */
    public function getcode()
    {
        return $this->code;
    }

    /**
     * Sets the value for code.
     *
     * @param string $code
     *
     * @return self
     */
    public function setcode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Retrieves the value of number.
     *
     * @return string
     */
    public function getnumber()
    {
        return $this->number;
    }

    /**
     * Sets the value for number.
     *
     * @param string $number
     *
     * @return self
     */
    public function setnumber(string $number): self
    {
        $this->number = $number;

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
