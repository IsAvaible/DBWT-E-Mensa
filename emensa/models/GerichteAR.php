<?php

namespace emensa\models;

use Illuminate\Database\Eloquent\Model;

class GerichteAR extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'gericht';
    public $timestamps = false;

    public function getPriceInternalAttribute($value): string
    {
        return number_format((float)$value, 2, '.', '');
    }

    public function getPriceExternalAttribute($value): string
    {
        return number_format((float)$value, 2, '.', '');
    }

    public function setVegetarianAttribute($value): void
    {
        $this->attributes['vegetarian'] = strtolower(trim($value)) === 'yes' ? 1 : 0;
    }

    public function setVeganAttribute($value): void
    {
        $this->attributes['vegan'] = strtolower(trim($value)) === 'yes' ? 1 : 0;
    }


}