<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Oct 10, 2018
 * Description of LegPxTypeMessageEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class LegPxTypeMessageEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;

    /**
     * @var string
     */
    public $AirlineCode;

    /**
     * @var string
     */
    public $Type;

    /**
     * @var int
     */
    public $FailCode;

    /**
     * @var string
     */
    public $Info;

    /**
     * @var array ignoring calculated fields
     */
    private $CalculatedFields = ['CalculatedFields'];

    public function __construct($data, $locale)
    {
        $this->__init($data, $locale);
        $this->removeNull();
    }

    /**
     * @param array  $data
     * @param string $locale
     */
    protected function __init($data, $locale)
    {
        $fields = $this->getFillableFieldsWithSameReceivedName();

        foreach ($fields as $field) {
            $this->{'set'.$field}($data[$field] ?? 'N/A');
        }
    }

    public function getAirlineCode()
    {
        return $this->AirlineCode;
    }

    public function getType()
    {
        return $this->Type;
    }

    public function getFailCode()
    {
        return $this->FailCode;
    }

    public function getInfo()
    {
        return $this->Info;
    }

    public function setAirlineCode($AirlineCode)
    {
        $this->AirlineCode = $AirlineCode;

        return $this;
    }

    public function setType($Type)
    {
        $this->Type = $Type;

        return $this;
    }

    public function setFailCode($FailCode)
    {
        $this->FailCode = $FailCode;

        return $this;
    }

    public function setInfo($Info)
    {
        $this->Info = $Info;

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
    }
}
