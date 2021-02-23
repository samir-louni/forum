<?php
session_start();
include("fonctions.php");
$user = new forum();
$user->dbconnect();

if(isset($_POST['deconnexion']))
{
    $user->disconnect();
}

?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="forum.css">
        <title>Accueil</title>
    </head>
    <body>
        <header>
            <section class="encart">
                <div class="titre1">
                    <a href="index.php">
                        <img src="images-forum/log.png" alt = "Logo Playstation">
                    </a>
                </div>
                <nav>
                    <?php 
                        $user->header();
                    ?>
                </nav>
            </section>
        </header>
        <main>
            <section class='cadre-connexion'>
                <div class = 'tab-connexion'>
                    <h3 class = "petitemarge">Informations</h3>
                    <?php    
                        $user->voirprofil();
                    ?>
                </div>
            </section>
        </main>
        <footer>
                <section class = 'footercentrer'>
            <img class = "fot" src="images-forum/playlogo.png" alt = " Logo playstation ">
            </section>
        </footer>
    </body>
</html>