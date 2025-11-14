<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function title(): Attribute
    {
        return Attribute::get(fn () => $this->getAttribute('name_fa').'-'.$this->getAttribute('name_en').'-'.$this->getAttribute('iso'));
    }
}
