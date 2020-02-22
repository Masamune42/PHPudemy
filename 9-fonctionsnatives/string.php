<?php
// FONCTIONS SUR STRING

$string = "Bienvenue sur la formation ultime en PHP et MySQL";

//STRLEN
echo 'Nombre de caractères : '.strlen($string).'<br>';

// STR_REPLACE
echo 'La string transformée : '.str_replace('Bienvenue','Welcome',$string).'<br>';

// STRTOLOWER
echo strtolower($string).'<br>';

// STRTOUPPER
echo strtoupper($string).'<br>';

//SUBSTR
echo substr($string,0,9).'<br>';