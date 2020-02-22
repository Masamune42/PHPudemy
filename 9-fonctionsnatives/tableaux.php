<?php
// FONCTIONS SUR LES TABLEAUX
$array = array(
  "Stendhal",
    "Arnold",
    "Steve"
);

// array_flip
$array_two = array_flip($array);
echo $array_two['Stendhal'].'<br>';

// array_key_exists
if (array_key_exists(0,$array)){
    echo 'yes'.'<br>';
}

// count
echo count($array).'<br>';

// sort
sort($array);
foreach ($array as $name) {
    echo $name.' ';
}