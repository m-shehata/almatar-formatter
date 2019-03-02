<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;

/**
 * Description of CabinEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class CabinEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;

    public function __construct($data, $locale = 'ar')
    {
        $this->__init($data, $locale);
        $this->removeNull();
    }

    /**
     * @var string
     */
    public $Code;

    /**
     * @var string
     */
    public $Name;

    /**
     * @var array ignoring calculated fields
     */
    private $CalculatedFields = ['CalculatedFields', 'TranslatedFields'];

    /**
     * @var array Fields that have a translation in the data
     */
    private $TranslatedFields = ['Name'];

    /**
     * Retrieves the value of Code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->Code;
    }

    /**
     * Sets the value for Code.
     *
     * @param string $code
     *
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->Code = $code;

        return $this;
    }

    /**
     * Retrieves the value of Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Sets the value for Name.
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->Name = $name;

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
