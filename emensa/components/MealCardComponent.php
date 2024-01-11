<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

namespace emensa\components;

use emensa\models\Meal;

class MealCardComponent
{
    /**
     * Create the component instance.
     */
    public function __construct(
        public Meal $meal,
        public bool $ratingForm = false,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): string
    {
        return "<div class='meal-card'>
                <img src='img/meals/" . ($this->meal->imageName ?? '00_image_missing.jpeg') . "' alt='{$this->meal->description}'>
                <div>
                    <div class='header-row''>
                            <h3>{$this->meal->name}</h3>" .
            ($this->meal->vegan ? '<img src="icons/vegan.svg" alt="Vegan" title="Vegan"/>'
                : ($this->meal->vegetarian ? '<img src="icons/vegetarian.svg" alt="Vegetarisch" title="Vegetarisch"/>' : "")) . "
                        </div>
                            <p>{$this->meal->description}</p>
                            <div class='food-properties'>
                                <p><strong>Preis</strong>: " . number_format($this->meal->priceIntern, 2) . "€ (intern) / " . number_format($this->meal->priceExtern, 2) . "€ (extern)</p>
                                <p><strong>Allergene</strong>: " . (implode(', ', $this->meal->allergens) ?: "Keine") . "</p>" . "
                            </div>
                            <div class='rating'>
                                    " . implode(array_map(function ($i) {
                return ("<a href='bewertung?meal_id={$this->meal->id}&rating={$i}'><img src='icons/star_" . ($this->meal->rating != null ? ($i <= $this->meal->rating ? 'filled' : 'outline') : 'dashed') . ".svg' alt='Bewertung'/></a>");
            }, range(1, 4))) . "
                                </div>
                        </div>
                    </div>";
    }
}