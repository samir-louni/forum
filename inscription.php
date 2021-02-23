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
            <section class="cadre-inscription">
                <div class="tab-inscription">
                    <h3 class = 'petittitre'>Inscription</h3>
                    <form action="" method="post" >
                        <label for="login">Login</label>
                        <input type="text" name="login" id="login" ><br>

                        <label for="login">Nom</label>
                        <input type="text" name="name" id="name" ><br>
                        

                        <label for="password">Mot de passe </label>
                        <input type="password" name="password" id="password" ><br>
                    
                        <label for="confirm_paswword">Confirmez</label>
                        <input type="password" name="confirm_password" id="confirm_password" >
                        <br>
                        <input type="submit" name="submit" value="S'inscrire !" class = "inscrire">
                    </form>
                    <?php
                        if(isset($_POST['submit'])){
                        $user->register($_POST['login'], $_POST['name'], $_POST['password'], $_POST['confirm_password']);
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