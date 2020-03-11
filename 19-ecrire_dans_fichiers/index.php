<?php
// LIRE / ECRIRE DANS UN FICHIER

// MODE
// r - Lire votre fichier
// r+ - Lire et écrire
// a - Lire votre fichier + le créer s'il n'existe pas
// a+ - Lire et écrire dans un fichier + créer s'il n'existe pas + écrire à la suite du fichier

// ECRIRE
// fputs($fichier,'World');

// LIRE
// fgets() - Ligne
// fgetc() - caractère
// $ligne = fgets($fichier);

// echo $ligne;

// EXERCICE : COMPTEUR DE VISITE
// compteur.txt -> 0

// OUVRIR
$fichier = fopen('count.txt', 'r+');

// LIRE
$pages = fgets($fichier);

// CURSEUR
fseek($fichier, 0);

$pages++;

fputs($fichier, ($pages));

echo 'Vous êtes la ' .$pages. 'e visite sur ce site.';
// FERMER
fclose($fichier);