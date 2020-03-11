# PHPudemy
Cours de PHP sur udemy.

## IDE utilisé
- PHPStorm -> Extensions :
    - PHP Annotations

## Résumé des projets
Projet 2 : Hébergeur d'images
==========
### Principe
Le but du projet est de pouvoir upload une image et de pouvoir l'afficher par la suite.

### Description
- On crée un formulaire qui avec méthode post.
- On vérifie que le fichier est bien une image de type pris en charge
- Si c'est le cas, alors on stock l'image dans le dossier uploads en la renommant avec une valeur aléatoire
- On affiche l'image via son chemin d'accès dans uploads

Projet 3 : Raccourcisseur d'URL
==========
### Principe
Le but du projet est de renseigner un lien voulu afin d'en renvoyer un autre plus cours ramenant à la même page.

### Description
- On reçoit un lien avec un paramètre "q" passé en paramètre
    - On établi une connexion à la BDD avec PDO
    - On compte le nombre d'éléments correspondants à la valeur du paramètre en BDD
    - Si on compte une valeur différente de 1, on renvoie un erreur sur la page.
    - Sinon, on renvoie l'utilisateur à l'url correspondant
- On reçoit un paramètre "url" dans une méthode post qu'on place dans une variable $url
    - Si $url n'est pas une url valide, on renvoie une erreur
    - Sinon, on lui attribut un raccourci généré aléatoirement
    - On vérifie que l'url indiqué n'existe pas déjà en BDD, si c'est c'est le cas -> erreur
    - Sinon, on stock la valeur de l'url et son raccourci

### Base de données
- Nom : bitly
- Fichier : bitly.sql
- Table : links
    - Colonnes : id, url, shortcut
    
Projet 4 : Espace membre
==========
### Principe
Le but du projet est de pouvoir créer un compte utilisateur et de se connecter.

### Description
index.php ->
- On rempli le formulaire d'inscription
- On vérifie que tous les champs sont remplis
- On vérifie que le mot de passe et la vérification sont identiques

### Base de données
- Nom : formation_members
- Fichier : formation_members.sql
- Table : links
    - Colonnes : id, email, password, secret, creation_date, blocked
    
Projet 5 : Espace membre Netflix
==========
### Principe
Le but du projet est de pouvoir créer un compte utilisateur et de se connecter sur un site ressemblant à Netflix.

### Description
index.php ->

inscription.php ->

### Base de données
- Nom : netflix
- Fichier : netflix.sql (à générer)
- Table : links
    - Colonnes : id, email, password, secret, creation_date, blocked