<?php
session_start();
require('src/connexion.php');
// PROJET #3 : Un espace membre

if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) &&
    !empty($_POST['password_confirm'])) {

    // VARIABLES
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // TEST SI PASSWORD = PASSWORD_CONFIRM
    if ($password != $password_confirm) {
        header('location: index.php?error=1&pass=1');
        exit();
    }

    // TEST SI EMAIL UTILISE
    $req = $db->prepare("SELECT COUNT(*) AS numberEmail
                        FROM users WHERE email = ?");
    $req->execute(array($email));

    while ($email_verification = $req->fetch()) {
        if ($email_verification['numberEmail'] != 0) {
            header('location: index.php?error=1&email=1');
            exit();
        }
    }

    // HASH
    $secret = sha1($email) . time();
    $secret = sha1($secret) . time() . time();

    // CRYPTAGE DU PASSWORD
    $password = "aq1" . sha1($password . "1254") . "25";

    // ENVOI DE LA REQUETE
    $req = $db->prepare('INSERT INTO users(pseudo, email, password, secret)
                        VALUES(?, ?, ?, ?)');
    $req->execute(array($pseudo, $email, $password, $secret));
    header('location: index.php?success=1');
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP et MYSQL : la formation ULTIME</title>
    <link rel="stylesheet" type="text/css" href="design/default.css">
</head>
<body>
<h1>Inscription</h1>
<?php
if (!isset($_SESSION['connect'])) {
    ?>
    <p>Bienvenue sur mon site, pour en voir plus, inscrivez-vous.
        Sinon, <a href="connexion.php">connectez-vous</a></p>


    <?php
    if (isset($_GET['error'])) {
        if (isset($_GET['pass'])) {
            echo '<p id="error">Les mots de passes ne sont pas identiques.</p>';
        } else if (isset($_GET['email'])) {
            echo '<p id="error">Cette adresse email est déjà prise.</p>';
        }
    } else if (isset($_GET['success'])) {
        echo '<p id="success">Inscription prise en compte.</p>';
    }
    ?>

    <!-- PSEUDO
         EMAIL
         MOT DE PASSE
         MOT DE PASSE A CONFIRMER-->
    <form method="post" action="index.php">
        <table>
            <tr>
                <td>Pseudo</td>
                <td><input type="text" name="pseudo" placeholder="Ex : Nicolas" required></td>
            </tr>
            <tr>
                <td>Adresse mail</td>
                <td><input type="email" name="email" placeholder="Ex : example@gmail.com" required></td>
            </tr>
            <tr>
                <td>Mot de passe</td>
                <td><input type="password" name="password" placeholder="Ex : *****" required></td>
            </tr>
            <tr>
                <td>Retaper mot de passe</td>
                <td><input type="password" name="password_confirm" placeholder="Ex : *****" required></td>
            </tr>
        </table>
        <button type="submit">Inscription</button>
    </form>
    <?php
} else {
    ?>
    <p>Bonjour <?= $_SESSION['pseudo'] ?></p>
    <a href="disconnexion.php">Déconnexion</a>
    <?php
}
?>

</body>
</html>
