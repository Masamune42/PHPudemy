<?php
// FORMULAIRE

// Si il existe une méthode de type POST
if (isset($_POST['prenom']) && $_POST['nom']) {
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);

    // SI QUE DES CARACTERES ALPHABETIQUES

    echo 'Bonjour '.$prenom.' '.$nom;
}

echo '<form method="post" action="index.php">
            <p>
                <table>
                    <tr>
                        <td>Prénom</td>
                        <td><input type="text" name="prenom"></td>
                    </tr>
                    <tr>
                        <td>Nom</td>
                        <td><input type="text" name="nom"></td>
                    </tr>
                </table>
                <button type="submit">Valider</button>
            </p>
        </form>';