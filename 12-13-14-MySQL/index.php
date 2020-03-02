<!-- CONNECT / OPERATEURS (LIRE / ECRIRE / MODIFIER / SUPPRIMER)

types d'extensions :
mysql_ => mySQL, vieilles : plus du tout utilisé
mysqli_ => mySQL, améliorées : utilisé rarement
PDO => très sécurisée, mySQL, Oracle, PostgreSQL : A UTILISER

-->

<?php
// HOTE : localhost - sql.monserveur.com
// NOM DE LA BASE : formation_users
// LOGIN : root
//  MDP :

// CONNEXION
try {
    $bdd = new PDO('mysql:host=localhost;dbname=formation_users;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// AJOUTER UN UTILISATEUR
//$requete = $bdd->exec('INSERT INTO users(prenom, nom, serie_preferee)
//                                  VALUES("Yves","Côte de Porc","Devilman")');

// MODIFIER UN UTILISATEUR
//$requete = $bdd->exec('UPDATE users SET serie_preferee = "Gurren Lagann"
//                                 WHERE prenom="Yves"');

// SUPPRIMER UN UTILISATEUR
//$requete = $bdd->exec('DELETE FROM users WHERE prenom="Yves"');


// AJOUTER UN METIER
//$requete = $bdd->exec('INSERT INTO jobs(id_user,
//                                 metier) VALUES(1,"Ecrivain")');
//$requete = $bdd->exec('INSERT INTO jobs(id_user,
//                                 metier) VALUES(2,"Youtubeur")');
//$requete = $bdd->exec('INSERT INTO jobs(id_user,
//                                 metier) VALUES(3,"Programmeur")');

// LIRE DES INFORMATIONS
//$requete = $bdd->query('SELECT *
//                                  FROM users
//                                  ORDER BY prenom DESC');

// JOINTURES
// WHERE : moins en moins choisi, moins clair
// JOIN : plus en plus choisi, plus clair

//$requete = $bdd->query('SELECT *
//                                  FROM users, jobs
//                                  WHERE users.id = jobs.id_user');

//$requete = $bdd->query('SELECT *
//                                  FROM users AS u
//                                  LEFT JOIN jobs AS j
//                                  ON u.id = j.id_user')
//or die(print_r($bdd->errorInfo()));


/*
 * L'injection SQL est une méthode d'attaque très connue. C'est un vecteur d'attaque extrêmement puissant
 * quand il est bien exploité. Il consiste à modifier une requête SQL en injectant des morceaux de code non filtrés,
 * généralement par le biais d'un formulaire.
 */
// INJECTION SQL
//$prenom = "Alex";
//$requete = $bdd->prepare('SELECT *
//                                  FROM users AS u
//                                  LEFT JOIN jobs AS j
//                                  ON u.id = j.id_user
//                                  WHERE prenom = ?
//                                  ');
//$requete->execute(array($prenom));

// Si on reçoit une requête POST
if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['serie'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $serie = $_POST['serie'];

    $requete = $bdd->prepare('INSERT INTO users(prenom, nom, serie_preferee)
                                        VALUES(?, ?, ?)
                            ');

    $requete->execute(array($prenom, $nom, $serie));
}

// Si on reçoit une requête GET
if (isset($_GET['prenom']) && isset($_GET['nom']) && isset($_GET['serie'])) {
    $prenom = $_GET['prenom'];
    $nom = $_GET['nom'];
    $serie = $_GET['serie'];

    $requete = $bdd->prepare('INSERT INTO users(prenom, nom, serie_preferee)
                                        VALUES(?, ?, ?)
                            ');

    $requete->execute(array($prenom, $nom, $serie));
}

// AFFICHGE LES INFORMATIONS
$requete = $bdd->prepare('SELECT *
                                  FROM users AS u
                        ');

$requete->execute();

// Cryptage
// SHA1 > MD5, mais décryptable via des sites
// GRAIN(584f)
// MOT DE PASSE CRYPTE + GRAIN -> meilleur cryptage

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border style="border-collapse: collapse;">
    <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Mot de passe</th>
        <th>Série préférée</th>
        <!--        <th>Métier</th>-->
    </tr>

    <?php
    while ($donnees = $requete->fetch()) {
        ?>
        <tr>
            <?php
            echo '<td>' . $donnees['prenom'] . '</td>
                 <td>' . $donnees['nom'] . '</td>
                 <td>' . sha1($donnees['mdp']) . '</td>
                 <td>' . $donnees['serie_preferee'] . '</td>
                 ';
            ?>
        </tr>
        <?php
    }

    $requete->closeCursor();
    ?>
</table>

<!-- Ajoute un nouvel utilisateur -->
<h1>Ajouter un utilisateur</h1>

<form method="post" action="index.php">
    <table>
        <tr>
            <td>Prénom</td>
            <td><input type="text" name="prenom"></td>
        </tr>
        <tr>
            <td>Nom</td>
            <td><input type="text" name="nom"></td>
        </tr>
        <tr>
            <td>Série préférée</td>
            <td><input type="text" name="serie"></td>
        </tr>
    </table>
    <button type="submit"> Ajouter</button>
</form>

</body>
</html>
