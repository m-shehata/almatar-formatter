<?php

namespace AlmatarFormatter\Traits;

/**
 * Description of RemoveNullPropertiesTrait.
 *
 * @author Mohamed Shehata <mohamed.shehata@almtar.com> */
trait RemoveNullPropertiesTrait
{
    protected function removeNull()
    {
        foreach ($this->getCalculatedFields() as $calculatedField) {
            if (null === $this->{'get'.$calculatedField}()) {
                unset($this->$calculatedField);
            }
        }
    }
}
