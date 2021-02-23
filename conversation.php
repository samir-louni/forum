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
                    <?php $user->header(); ?>
                </nav>
            </section>
        </header>
        <main> 
            <h2 class = 'h2pagesujet'>Liste des messages</h2>
            <section class = 'fond'>
                <div class = 'centrer'>
                    <?php
                    $user->affichercommentaire($_GET['id_sujet']);
                    ?>
                </div>
                <div class = "formulairetopic">
                    <h4 class = "h4casetopic">Envoyer un message</h4>
                    <form action='' method="post">
                        <textarea id="msg" name="commentaire" id = "commentaire"  placeholder="100 caractères maximum."  maxlength="100" style="margin: 0px; width: 505px; height: 88px;" required></textarea><br><br>
                        <input type="submit" name="submit" id="submit" placeholder="envoyer" class = 'button'><br>
                        <?php
                        if(!isset($_SESSION['user']) && isset($_POST['submit'])){
                            echo '<br>Tu dois être connecté pour envoyer un commentaire ! ';
                            header("refresh: 2");
                        }
                        elseif(isset($_POST['submit'])){
                        $user->commentaire($_POST['commentaire'], date('Y/m/d H:i:s'), $_SESSION['user']['id'], $_GET['id_sujet']);
                        }
                        ?>
                    </form>
                </div>
        </main>
        <footer>
                <section class = 'footercentrer'>
            <img class = "fot" src="images-forum/playlogo.png" alt = " Logo playstation ">
            </section>
        </footer>
    </body>
</html>