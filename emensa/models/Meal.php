<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

namespace emensa\models;

class Meal
{
    public string $name;
    public string $description;
    public string|null $imageName;
    public int $id;
    public bool $vegetarian;
    public bool $vegan;
    public float $priceIntern;
    public float $priceExtern;
    public array $allergens;
    public float|null $rating;

    public function __construct(array $mealData)
    {
        foreach ($mealData as $key => $value) {
            if (property_exists($this, $key))
                $this->$key = $value;
        }
    }

    public static function from_db(false|array|null $fetch_assoc): ?Meal
    {
        if ($fetch_assoc === false || $fetch_assoc === null)
            return null;
        return new Meal([
            'name' => $fetch_assoc['name'],
            'description' => $fetch_assoc['beschreibung'],
            'imageName' => $fetch_assoc['bildname'],
            'id' => $fetch_assoc['id'],
            'vegetarian' => $fetch_assoc['vegetarisch'],
            'vegan' => $fetch_assoc['vegan'],
            'priceIntern' => $fetch_assoc['preisintern'],
            'priceExtern' => $fetch_assoc['preisextern'],
            'allergens' => $fetch_assoc['allergene'],
            'rating' => $fetch_assoc['bewertung'],
        ]);
    }
}