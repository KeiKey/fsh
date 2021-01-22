<?php

namespace App\Models\File;

trait AttributesTrait
{
    public function getSizeInMbAttribute()
    {
        return number_format($this->size / 1024 / 1024, 3) . ' MB';
    }
}
