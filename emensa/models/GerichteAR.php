<?php

use Illuminate\Database\Eloquent\Model;

class GerichteAR extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'gericht';
    public $timestamps = false;

    public function getPriceInternalAttribute($value)
    {
        return number_format((float)$value, 2, '.', '');
    }

    public function getPriceExternalAttribute($value)
    {
        return number_format((float)$value, 2, '.', '');
    }

    public function setVegetarianAttribute($value)
    {
        $this->attributes['vegetarian'] = strtolower(trim($value)) === 'yes' ? 1 : 0;
    }

    public function setVeganAttribute($value)
    {
        $this->attributes['vegan'] = strtolower(trim($value)) === 'yes' ? 1 : 0;
    }


}