<?php

namespace AlmatarFormatter\Abstracts;

/**
 * Description of AbstractTranslatedEntity.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com>
 */
abstract class AbstractTranslatedEntity
{
    /**
     * @param array  $data
     * @param string $locale
     *
     * @return string
     */
    protected function __init($data, string $locale)
    {
        $fields = $this->getFillableFieldsWithSameReceivedName();
        $prefix = 'en' != strtolower($locale) ? ucfirst(strtolower($locale)) : '';
        foreach ($fields as $field) {
            $translatedField = in_array($field, $this->getTranslatedFields()) ? $prefix.$field : $field;
            if (!isset($data[$translatedField])) {
                unset($this->$translatedField);
                continue;
            }
            $this->{'set'.$field}($data[$translatedField], $locale);
        }

        return $prefix;
    }

    /**
     * @return array The Fields that will be translated for this entity
     */
    abstract protected function getTranslatedFields(): array;
}
