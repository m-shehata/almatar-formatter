<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Mar 20, 2019
 * Description of PassengerEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class PassengerEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;

    /**
     * @var string
     */
    public $type;

    /**
     * @var array
     */
    public $full_name;

    /**
     * @var string
     */
    public $dob;

    /**
     * @var string
     */
    public $gender;

    /**
     * @var string
     */
    public $meal_preference;

    /**
     * @var array
     */
    public $special_requests;

    /**
     * @var array
     */
    public $seat_preference;

    /**
     * @var array
     */
    public $document;

    /**
     * @var array
     */
    public $phone;

    /**
     * @var string
     */
    public $email;
    private $CalculatedFields = ['CalculatedFields','full_name', 'dob', 'meal_preference', 'special_requests', 'seat_preference', 'document'];

    public function __construct($data,$locale='ar')
    {
        $this->__init($data, $locale);
        $this->setfull_name($data['name'],$locale);
        $this->setdob($data['dateOfBirth']);
        $this->setmeal_preference($data['mealPreference']);
        $this->setspecial_requests($data['specialServices']);
        $this->setseat_preference($data['seatsPrefernces']);
        $this->setdocument($data['identity'],$locale);
    }

    /**
     * Retrieves the value of type.
     *
     * @return string
     */
    public function gettype()
    {
        return $this->type;
    }

    /**
     * Sets the value for type.
     *
     * @param string $type
     *
     * @return self
     */
    public function settype(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Retrieves the value of full_name.
     *
     * @return array
     */
    public function getfull_name()
    {
        return $this->full_name;
    }

    /**
     * Sets the value for full_name.
     *
     * @param array $full_name
     *
     * @return self
     */
    public function setfull_name(array $full_name,$locale='ar'): self
    {
        $this->full_name = new PassengerNameEntity($full_name, $locale);

        return $this;
    }

    /**
     * Retrieves the value of dob.
     *
     * @return string
     */
    public function getdob()
    {
        return $this->dob;
    }

    /**
     * Sets the value for dob.
     *
     * @param string $dob
     *
     * @return self
     */
    public function setdob(string $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Retrieves the value of gender.
     *
     * @return string
     */
    public function getgender()
    {
        return $this->gender;
    }

    /**
     * Sets the value for gender.
     *
     * @param string $gender
     *
     * @return self
     */
    public function setgender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Retrieves the value of meal_preference.
     *
     * @return string
     */
    public function getmeal_preference()
    {
        return $this->meal_preference;
    }

    /**
     * Sets the value for meal_preference.
     *
     * @param string $meal_preference
     *
     * @return self
     */
    public function setmeal_preference(string $meal_preference): self
    {
        $this->meal_preference = $meal_preference;

        return $this;
    }

    /**
     * Retrieves the value of special_requests.
     *
     * @return array
     */
    public function getspecial_requests()
    {
        return $this->special_requests;
    }

    /**
     * Sets the value for special_requests.
     *
     * @param array $special_requests
     *
     * @return self
     */
    public function setspecial_requests(array $special_requests): self
    {
        $this->special_requests = $special_requests;

        return $this;
    }

    /**
     * Retrieves the value of seat_preference.
     *
     * @return array
     */
    public function getseat_preference()
    {
        return $this->seat_preference;
    }

    /**
     * Sets the value for seat_preference.
     *
     * @param array $seat_preference
     *
     * @return self
     */
    public function setseat_preference(array $seat_preference): self
    {
        $this->seat_preference = $seat_preference;

        return $this;
    }

    /**
     * Retrieves the value of document.
     *
     * @return array
     */
    public function getdocument()
    {
        return $this->document;
    }

    /**
     * Sets the value for document.
     *
     * @param array $document
     *
     * @return self
     */
    public function setdocument(array $document,$locale): self
    {
        $this->document = new DocumentEntity($document, $locale);

        return $this;
    }

    /**
     * Retrieves the value of phone.
     *
     * @return array
     */
    public function getphone()
    {
        return $this->phone;
    }

    /**
     * Sets the value for phone.
     *
     * @param string $phone
     *
     * @return self
     */
    public function setphone(string $phone,$locale): self
    {
        $this->phone = new PhoneEntity($phone, $locale);

        return $this;
    }

    /**
     * Retrieves the value of email.
     *
     * @return string
     */
    public function getemail()
    {
        return $this->email;
    }

    /**
     * Sets the value for email.
     *
     * @param string $email
     *
     * @return self
     */
    public function setemail(string $email): self
    {
        $this->email = $email;

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
