<?php
// ENVOI FICHIER PHP

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $_FILES['image']['name']; // NOM
    $_FILES['image']['type']; // TYPE
    $_FILES['image']['size']; // TAILLE : 1Mo = 1 000 000 d'octets
    $_FILES['image']['tmp_name']; // EMPLACEMENT DU FICHIER TEMPORAIRE
    $_FILES['image']['error']; // ERREUR : SI L'IMAGE A BIEN ETE TRAITEE

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

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
//                'uploads/'.time().basename($_FILES['image']['name'])); // CHANGEMENT DU NOM EN AJOUTANT L'HEURE DU FICHIER AU NOM
                'uploads/'.time().rand().'.'.$extensionImage
            );
            echo 'envoi réussi !';
        }
    }
}


echo '<form method="post" action="fichier.php" enctype="multipart/form-data">
        <p>
            <h1>Formulaire</h1>
            <input type="file" name="image"><br>
            <button type="submit">Envoyer</button>
        </p>
</form>';