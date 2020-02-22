<?php

// DEFINIR UNE FONCTION : LES RACINES D'UNE EQUATION
// ax²+bx+c

$a = 4;
$b = 4;
$c = 1;

$solution = calcul($a, $b, $c);

if (is_array($solution)) {
    if (is_numeric($solution)) {

        echo 'la solutions de l\'équation '.$a.'x² + '.$b.'x + '.$c.' est : '.$solution;
    } else {
        echo 'les solutions de l\'équation '.$a.'x² + '.$b.'x + '.$c.' sont : '.$solution[0].' et '.$solution[1];
    }
} else{
    echo $solution;
}


function calcul($a, $b, $c)
{
    $delta = $b * $b - 4 * $a * $c;

    if ($delta > 0) {
        $solution = [];

        $solution[] = (-$b - sqrt($delta)) / (2 * $a);
        $solution[] = (-$b + sqrt($delta)) / (2 * $a);
    } else {
        if ($delta < 0) {
            $solution = 'pas de solution';
        } else {
            $solution = (-$b ) / (2 * $a);
        }
    }


    return $solution;
}