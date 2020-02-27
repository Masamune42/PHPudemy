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
$requete = $bdd->exec('DELETE FROM users WHERE prenom="Yves"');

// LIRE DES INFORMATIONS
$requete = $bdd->query('SELECT * 
                                  FROM users
                                  ORDER BY prenom DESC');
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
        <th>Série préférée</th>
    </tr>

    <?php
    while ($donnees = $requete->fetch()) {
        ?>
        <tr>
            <?php
            echo '<td>'.$donnees['prenom'].'</td>
                 <td>'.$donnees['nom'].'</td>
                 <td>'.$donnees['serie_preferee'].'</td>'
            ?>
        </tr>
        <?php
    }

    $requete->closeCursor();
    ?>

</table>
</body>
</html>
