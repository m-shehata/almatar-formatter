<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Mar 20, 2019
 * Description of PassengerNameEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class PassengerNameEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $middle_name;

    /**
     * @var string
     */
    public $last_name;
    private $CalculatedFields = ['CalculatedFields', 'title', 'first_name', 'middle_name', 'last_name'];

    public function __construct($data, $locale = 'ar')
    {
        $this->settitle($data['prefix']);
        $this->setfirst_name($data['givenName']);
        $this->setmiddle_name($data['middleName']);
        $this->setlast_name($data['surName']);
    }

    /**
     * Retrieves the value of title.
     *
     * @return string
     */
    public function gettitle()
    {
        return $this->title;
    }

    /**
     * Sets the value for title.
     *
     * @param string $title
     *
     * @return self
     */
    public function settitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Retrieves the value of first_name.
     *
     * @return string
     */
    public function getfirst_name()
    {
        return $this->first_name;
    }

    /**
     * Sets the value for first_name.
     *
     * @param string $first_name
     *
     * @return self
     */
    public function setfirst_name(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Retrieves the value of middle_name.
     *
     * @return string
     */
    public function getmiddle_name()
    {
        return $this->middle_name;
    }

    /**
     * Sets the value for middle_name.
     *
     * @param string $middle_name
     *
     * @return self
     */
    public function setmiddle_name(string $middle_name): self
    {
        $this->middle_name = $middle_name;

        return $this;
    }

    /**
     * Retrieves the value of last_name.
     *
     * @return string
     */
    public function getlast_name()
    {
        return $this->last_name;
    }

    /**
     * Sets the value for last_name.
     *
     * @param string $last_name
     *
     * @return self
     */
    public function setlast_name(string $last_name): self
    {
        $this->last_name = $last_name;

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
