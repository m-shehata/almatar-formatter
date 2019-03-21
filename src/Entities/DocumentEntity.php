<?php

namespace AlmatarFormatter\Entities;

use AlmatarFormatter\Abstracts\AbstractTranslatedEntity;
use AlmatarFormatter\Traits\RemoveNullPropertiesTrait;
use Tightenco\Collect\Support\Arr;

/**
 * Mar 21, 2019
 * Description of DocumentEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
class DocumentEntity extends AbstractTranslatedEntity
{
    use RemoveNullPropertiesTrait;

    /**
     * @var string
     */
    public $type;

    /**
     * @var array
     */
    public $details;
    private $CalculatedFields = ['CalculatedFields', 'details'];

    public function __construct($data, $locale = 'ar')
    {
        $this->__init($data, $locale);
        $this->setdetails(Arr::except($data, 'type'),$locale);
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
     * Retrieves the value of details.
     *
     * @return array
     */
    public function getdetails()
    {
        return $this->details;
    }

    /**
     * Sets the value for details.
     *
     * @param array $details
     *
     * @return self
     */
    public function setdetails(array $details,$locale): self
    {
        $this->details = new DocumentDetailsEntity($details,$locale);

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
