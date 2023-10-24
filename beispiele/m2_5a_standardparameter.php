<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

/**
 * Addiert zwei Zahlen
 * @param float|int $a Die erste Zahl
 * @param float|int $b Die zweite Zahl (optional)
 * @return float|int Die Summe der beiden Zahlen
 */
function addieren(float|int $a, float|int $b = 0): float|int
{
    return $a + $b;
}