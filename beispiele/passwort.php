<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

/**
 * Generates hash with custom salt.
 *
 * @param string $passwort
 * @return string
 */
function generateSHA1Hash(string $passwort)
{
    //Same Salt for all user
    $salt = 'z7HjaGWj8P7S';

    return sha1($salt . $passwort);
}

//Admin Passwort: i9L05?QBZGD_

echo generateSHA1Hash('i9L05?QBZGD_') . PHP_EOL;