<?php
// IS RECEIVED SHORTCUT
if (isset($_GET['q'])) {
    // VARIABLE
    $shortcut = htmlspecialchars($_GET['q']);

    // IS A SHORTCUT ?
    $bdd = new PDO('mysql:host=localhost;dbname=bitly;charset=utf8',
        'root', '');
    $req = $bdd->prepare('SELECT COUNT(*) AS x FROM
                                    links WHERE shortcut = ?');
    $req->execute(array($shortcut));

    while ($result = $req->fetch()) {
        if ($result['x'] != 1) {
            header('location: ?error=true&message=Adresse non connue');
            exit();
        }
    }

    // REDIRECTION
    $req = $bdd->prepare('SELECT * FROM links WHERE shortcut = ?');
    $req->execute(array($shortcut));

    while ($result = $req->fetch()) {
        header('location: ' . $result['url']);
        exit();
    }

}

// IS SENDING A FORM
if (isset($_POST['url'])) {
    // VARIABLE
    $url = $_POST['url'];

    // VERIFICATION
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        // PAS UN LIEN
        header('location: ?error=true&message=Adresse url non valide');
        exit();
    }

    // SHORTCUT
    $shortcut = crypt($url, rand());

    // HAS BEEN ALREADY SEND ?
    $bdd = new PDO('mysql:host=localhost;dbname=bitly;charset=utf8',
        'root', '');

    $req = $bdd->prepare('SELECT COUNT(*) AS x FROM
                        links WHERE url = ?');
    $req->execute(array($url));

    while ($result = $req->fetch()) {
        if ($result['x'] != 0) {
            header('location: ?error=true&message=Adresse déjà raccourcie');
            exit();
        }
    }

    // SENDING
    $req = $bdd->prepare('INSERT INTO links(url, shortcut)
                                    VALUES(?, ?)');
    $req->execute(array($url, $shortcut));
    header('location: ?short=' . $shortcut);
}
?>

    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="design/default.css">
        <link rel="icon" href="pictures/favico.png"/>
        <title>Raccourcisseur d'URL Express</title>
    </head>
    <body>
    <!-- PRESENTATION -->
    <section id="hello">
        <!-- CONTAINER -->
        <div class="container">
            <header>
                <img src="pictures/logo.png" alt="header" id="logo">
            </header>
            <!-- VP -->
            <h1>Une URL longue? Raccourcissez-là</h1>
            <h2>Largement meilleur et plus court que les autres</h2>

            <!-- FORM -->
            <form method="post" action="">
                <input type="url" name="url" placeholder="Collez un lien à raccourcir">
                <input type="submit" value="Raccourcir">
            </form>
            <?php
            if (isset($_GET['error']) && isset($_GET['message'])) {
                ?>
                <div class="center">
                    <div id="result">
                        <b><?php
                            echo htmlspecialchars($_GET['message']);
                            ?></b>
                    </div>
                </div>
                <?php
            } else if (isset($_GET['short'])) {
                ?>
                <div class="center">
                    <div id="result">
                        <b>URL RACCOURCIE : </b>
                        http://localhost/PHPudemy/15-Projet3/index.php?q=<?php
                        echo htmlspecialchars($_GET['short'])
                        ?>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </section>

    <!-- BRANDS -->
    <section id="brands">
        <!-- CONTAINER -->
        <div class="container">
            <h3>Ces marques nous font confiance</h3>
        </div>
        <img src="pictures/1.png" alt="1" class="picture">
        <img src="pictures/2.png" alt="2" class="picture">
        <img src="pictures/3.png" alt="3" class="picture">
        <img src="pictures/4.png" alt="4" class="picture">
    </section>

    <!-- FOOTER -->
    <footer>
        <img src="pictures/logo2.png" alt="logo" id="logo"><br>
        2020 &copy; Bitly<br>
        <a href="">Contact</a> -
        <a href="">A propos</a>
    </footer>

    </body>
    </html>

<?php
