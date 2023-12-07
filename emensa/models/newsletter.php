<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

// Count the number of newsletter signups
function newsletterCount()
{
    if (is_file("newsletter.csv")) { // Check if the file "newsletter.csv" exists
// Open the existing file for reading
        $newsletterFile = fopen("newsletter.csv", "r");
        $newsletterSignups = 0;
// Count the number of non-empty lines in the file
        while (!feof($newsletterFile)) {
            $line = fgets($newsletterFile);
            if (trim($line) != "") {
                $newsletterSignups++;
            }
        }
        fclose($newsletterFile);
    } else {
// If the file does not exist, create a new file for writing
        $newsletterFile = fopen("newsletter.csv", "c");
        fclose($newsletterFile);
        $newsletterSignups = 'x';
    }

    return $newsletterSignups;
}


