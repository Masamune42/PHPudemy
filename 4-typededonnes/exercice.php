<?php
//TABLEAU (id, prenom, nom, age)
// AFFICHER l'AGE de la personne dans 50 ans
// Bonjour PRENOM NOM ! Dans 50 ans vous aurez x ans.

$personne = array(
    'id' => 20,
    'prenom' => 'alex',
    'nom' => 'masa',
    'age' => 42,
);

$ageDans50Ans = $personne['age'] + 50;

echo 'Bonjour '.$personne['prenom'].' '.$personne['nom'].' dans 50 ans vous aurez '.$ageDans50Ans.' ans.';