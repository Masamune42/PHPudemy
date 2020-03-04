<?php
session_start();
if (isset($_SESSION['connect'])) {
    header('location: index.php');
    exit();
}
require('src/connexion.php');


// CONNEXION
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    //VARIABLES
    $email = $_POST['email'];
    $password = $_POST['password'];

    // CRYPTER LE PASSWORD
    $password = "aq1" . sha1($password . "1254") . "25";

    $req = $db->prepare('SELECT * FROM users
                        WHERE email = ?');
    $req->execute(array($email));

    while ($user = $req->fetch()) {
        if ($password == $user['password']) {
            $_SESSION['connect'] = 1;
            $_SESSION['pseudo'] = $user['pseudo'];

            if (isset($_POST['connect'])) {
                setcookie('log', $user['secret'], time() + 365 * 24 * 3600);
            }

            header('location: connexion.php?success=1');
            exit();
        }
    }

    header('location: connexion.php?error=1');

}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="design/default.css">
</head>
<body>
<h1>Connexion</h1>
<p>Bienvenue sur mon site, si vous n'êtes pas inscrit, <a href="index.php">inscrivez-vous</a></p>
<?php
if (isset($_GET['error'])) {
    echo '<p id="error">Nous ne pouvons pas vous authentifier.</p>';
} else if (isset($_GET['success'])) {
    echo '<p id="success">Vous êtes maintenant connecté.</p>';
}
?>
<form method="post" action="connexion.php">
    <table>
        <tr>
            <td>Adresse mail</td>
            <td><input type="email" name="email" placeholder="Ex : example@gmail.com" required></td>
        </tr>
        <tr>
            <td>Mot de passe</td>
            <td><input type="password" name="password" placeholder="Ex : *****" required></td>
        </tr>
    </table>
    <p><label><input type="checkbox" name="connect" checked>Connexion automatique</label></p>
    <button type="submit">Connexion</button>
</form>

</body>
</html>
