<?php

if (isset($_COOKIE['auth']) && !isset($_SESSION['connect'])) {

    // VARIABLE
    $secret = htmlspecialchars($_COOKIE['auth']);

    // VERIFICATION
    require 'connect.php';

    $req = $db->prepare('SELECT COUNT(*) AS numberAccount FROM user WHERE secret = ?');
    $req->execute(array($secret));

    while ($user = $req->fetch()) {
        if ($user['numberAccount'] == 1) {
            $reqUser = $db->prepare('SELECT * FROM user WHERE secret = ?');
            $reqUser->execute(array($secret));

            while ($userAccount = $reqUser->fetch()) {
                $_SESSION['connect'] = 1;
                $_SESSION['email'] = $userAccount['email'];
            }
        }
    }
}

if (isset($_SESSION['connect'])) {

    require 'connect.php';

    $reqUser = $db->prepare('SELECT * FROM user WHERE email = ?');
    $reqUser->execute(array($_SESSION['email']));

    while ($userAccount = $reqUser->fetch()) {
        if ($userAccount['blocked']) {
            header('location: logout.php');
            exit();
        }
    }
}