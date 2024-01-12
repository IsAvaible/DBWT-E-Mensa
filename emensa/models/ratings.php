<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

function displayRating(float|null $stars, string|null $redirectTo = null): string
{
    if ($stars < 0 || $stars > 4) {
        return "<div class='alert alert-danger'>Fehler: Ungültige Bewertung: {$stars}</div>";
    }
    return "<div class='star-rating' title='" . ($stars != null ? "{$stars} von 4 Sternen" : "Noch keine Bewertungen") . "'>
    " . implode(array_map(function ($i) use ($stars, $redirectTo) {
            return (($redirectTo ? "<a href='{$redirectTo}{$i}'>" : "") . "<img src='icons/star_" . ($stars != null ? ($i <= round($stars) ? 'filled' : 'outline') : 'dashed') . ".svg' alt='Bewertung'/>" . ($redirectTo ? "</a>" : ""));
        }, range(1, 4))) . "
                                </div>";
}

function displayHomepageRatings(): string
{
    $link = connectdb();

    $result = mysqli_query($link, "SELECT bemerkung, sterne+0 as sterne, bildname, gericht.name as gericht_name, benutzer.name as benutzer_name FROM bewertung
    INNER JOIN gericht ON bewertung.gericht_id = gericht.id
    INNER JOIN benutzer ON bewertung.benutzer_id = benutzer.id
        WHERE hervorgehoben = 1 ORDER BY RAND() LIMIT 2");

    if (!$result) {
        return "<div class='alert alert-danger'>Fehler beim Ausführen der Abfrage: " . mysqli_error($link) . "</div>";
    } else if (mysqli_num_rows($result) == 0) {
        return "<div class='alert alert-info'>Es wurden keine hervorgehobenen Bewertungen gefunden.</div>";
    }

    $output = "<div class='testimonials-row'>";
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<div class='testimonial-card'>
        <div class='card-img-div'>
            <img src='img/meals/{$row['bildname']}' class='card-img' alt='{$row['gericht_name']}'>
            <div><p>{$row['gericht_name']}</p></div>
        </div>
        <div class='testimonial-card-content'>
            <p class='testimonial-card-comment'>\"{$row['bemerkung']}\"</p>
            <p class='testimonial-card-author'>- {$row['benutzer_name']}</p>
            <div class='rating'>" . displayRating($row['sterne']) . "</div>
        </div>
      </div>";
    }
    $output .= "</div>";

    return $output;
}