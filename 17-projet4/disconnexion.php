<?php
session_start(); /* INITIALISE LES SESSIONS */
session_unset(); /* DESACTIVER LA SESSION */
session_destroy(); /* DETRUIRE LA SESSION */
setcookie('log', '', time() - 3600);

header('location: connexion.php');