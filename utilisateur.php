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
            <h2 class = 'h2pageadmin'>Liste des utilisateurs</h2>
            <section class = 'tableaucentrer'>
                <table>
                    <thead>
                        <tr>
                            <td><h3>Login<h3></td>
                            <td><h3>Visiter</h3></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $user->afficherbasededonner2(); ?>
                    </tbody>
                </table>
            </section>
        </main>
            <footer>
                    <section class = 'footercentrer'>
                <img class = "fot" src="images-forum/playlogo.png" alt = " Logo playstation ">
                </section>
            </footer>
    </body>
</html>