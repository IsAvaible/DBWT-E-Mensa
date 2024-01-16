<?php


namespace emensa\models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class BewertungAR extends Model
{
    use HasCompositeKey;

    protected $table = 'bewertung';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = ['benutzer_id', 'gericht_id'];
    protected $fillable = ['bemerkung', 'sterne', 'zeitpunkt', 'hervorgehoben', 'benutzer_id', 'gericht_id'];
}