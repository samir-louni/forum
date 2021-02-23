<?php
session_start();
include("fonctions.php");
$user = new forum();
$user->dbconnect();

if(isset($_POST['deconnexion'])){
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
                <?php $user->header(); ?>
            </nav>
        </section>
    </header>
    <main>
        <h2 class = 'h2pagesujet'>Liste des sujets</h2>
            <section class = 'fond'>
        <div class = 'centrer'>
            <?php
            $user->affichersujet($_GET['id_topic']); 
            ?>
            <div class = "formulairetopic">
                <h4 class = "h4casetopic">Créer un sujet</h4>
                    <form action='' method="post">
                        <input type="text" name="sujet" id="sujet" placeholder="sujet"><br>
                        <input type="submit" name="submit" id="submit" placeholder="Publier " class = "button"><br>
                            <?php
                            if(!isset($_SESSION['user']) && isset($_POST['submit'])){
                            echo ' Tu dois être connecté pour créer un sujet';
                            header("refresh: 2");
                            }
                            elseif(isset($_POST['submit'])){
                            $user->sujet($_POST['sujet'], date('Y/m/d H:i:s'), $_SESSION['user']['id'], $_GET['id_topic']);
                            }
                            ?>
                    </form>
            </div>
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