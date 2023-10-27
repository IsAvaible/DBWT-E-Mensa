<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

const ACCESSLOG_PATH = "accesslog.txt";

/**
 * Logs $content to the accesslog
 * @param string $content The content to log
 */
function logAppend(string $content): void
{
    $file = fopen(ACCESSLOG_PATH, "a");
    fwrite($file, "$content\n");
    fclose($file);
}

function logRead(): string
{
    return file_get_contents(ACCESSLOG_PATH);
}

logAppend(date("Y-m-d H:i:s") . ": \n\tUser-Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\n\tClient-IP: " . $_SERVER['REMOTE_ADDR']);


echo '<pre>' . logRead() . '</pre>';