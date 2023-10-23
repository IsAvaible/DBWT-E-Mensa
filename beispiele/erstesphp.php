<?php


$var = "1";
$var_2 = 1;

if ($var === $var_2) {
    echo "Choice 1: " . $var;
} else if ($var == $var_2) {
    echo "Choice 2: " . $var;
} else {
    echo " $var und $var_2 sind nicht 'identical' und/oder 'equal' ";
}