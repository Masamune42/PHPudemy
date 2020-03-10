<?php
$identite = array(
    'id' => 4,
    'prenom' => 'Nicolas',
    'nom' => 'Dupont',
    'age' => 20,
);

echo 'Je m\'appelle '.$identite['prenom'].' '.$identite['nom'].' j\'ai '.$identite['age'].' ans<br>';

$identite2 = array(15, 'Nicolas', 'Dupont');
echo 'Je m\'appelle '.$identite2[1].' '.$identite2[2].' j\'ai '.$identite2[0].' ans';

$identite3 = [];

$identite3[] = 1;
$identite3[] = 2;
$identite3[] = "test";

foreach ($identite3 as $item) {
    echo '<br>'.$item;
}
