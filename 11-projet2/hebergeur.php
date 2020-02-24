<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hébergeur d'image</title>
</head>
<header><h1>Mon hébergeur d'image</h1></header>
<body>
<?php
// ENVOI FICHIER PHP

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    if ($_FILES['image']['size'] <= 3000000) {
        // OBTENIR TOUTES LES INFOS DU FICHIER DANS UN TABLEAU (taille, type, extension...)
        $informationsImage = pathinfo($_FILES['image']['name']);
        $extensionImage = $informationsImage['extension'];
        $extensionsArray = array(
            'png',
            'gif',
            'jpg',
            'jpeg',
        );

        // VERIFIE QUE CE QU'UN ELEMENT SE RETROUVE BIEN DANS LE TABLEAU
        if (in_array($extensionImage, $extensionsArray)) {
            // DEPLACEMENT DU FICHIER DU REP TEMP A UN REP DEFINI
            $nouveauNomImage = time() . rand() . '.' . $extensionImage;
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
//                'uploads/'.time().basename($_FILES['image']['name'])); // CHANGEMENT DU NOM EN AJOUTANT L'HEURE DU FICHIER AU NOM
                'uploads/' . $nouveauNomImage
            );
            echo 'Votre image : ';
            echo '<img src="uploads/' . $nouveauNomImage . '"><br>';
            echo '<a href="uploads/' . $nouveauNomImage . '">Lien vers votre image</a>';
        }
    }
}


echo '<form method="post" action="hebergeur.php" enctype="multipart/form-data">
        <p>
            <h2>Formulaire</h2>
            <input type="file" name="image"><br>
            <button type="submit">Envoyer</button>
        </p>
</form>';
?>
</body>
<footer></footer>
</html>

<?php
