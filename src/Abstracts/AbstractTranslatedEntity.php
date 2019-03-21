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
            if (method_exists($this, $method = 'set'.$field)) {
                $this->$method($data[$translatedField], $locale);
            }
        }

        return $prefix;
    }

    /**
     * @return array The Fields that will be translated for this entity
     */
    abstract protected function getTranslatedFields(): array;
    /**
     * @return array The Fields that will be filled without data mapping
     */
    abstract public function getFillableFieldsWithSameReceivedName(): array;

    /**
     * @param string|array $date
     */
    protected function getDateString($date): string
    {
        if (is_string($date)) {
            return $date;
        }
        if (is_array($date)) {
            return (new \DateTime())
                    ->setTimestamp($date['sec'] ?? 0)
                    ->setTimezone(new \DateTimeZone('UTC'))
                    ->format('Y-m-d\TH:i:s');
        }
    }
}
