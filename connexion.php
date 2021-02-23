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
                    <?php 
                        $user->header();
                    ?>
                </nav>
            </section>
        </header>
        <main>
            <?php $user->dejaconnect(); ?>
            <section class="cadre-connexion">
                <div class="tab-connexion">
                    <h3 class = 'petittitre'>Connexion</h3>
                    <form action="" method="post" >
                        <label for="login">Login</label>
                        <input type="text" name="login" id="login" ><br>
                        <label for="password">Mot de passe </label>
                        <input type="password" name="password" id="password" ><br>
                        <input type="submit" name="submit" value = "Se connecter" class = 'connect'>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $user->connect($_POST['login'], $_POST['password']);
                        }
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