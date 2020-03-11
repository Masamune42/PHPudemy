<?php

session_start(); /* INITIALISE LES SESSIONS */
session_unset(); /* DESACTIVER LA SESSION */
session_destroy(); /* DETRUIRE LA SESSION */
setcookie('auth', '', time() - 1, '/', null, false, true); // DETRUIT LE COOKIE

header('location: index.php');