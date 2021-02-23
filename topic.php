<?php
session_start();
require("fonctions.php");
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
        <title>Topic</title>
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
            <h2 class = 'h2pagesujet'>Liste des topics</h2>
            <section class = 'fond'>
                <div class = 'centrer'>
                    <?php
                       $user->affichertopic()
                    ?>
                    <?php
                        echo "<div class = 'casetopic'>";          
                        echo "<a href='sujet.php?id_topic=18628'>Règlement du forum</a>";
                        echo "</div>";

                        if(!isset($_SESSION['user'])){
                            echo '';
                        }
                        elseif($_SESSION['user']['id_droit'] == 3){   
                        echo "<div class = 'casetopic'>";          
                        echo "<a href='sujet.php?id_topic=18627'>Topic reserver uniquement au admin</a>";
                        echo "</div>";
                        }
                    ?>
                    <?php
                        if(!isset($_SESSION['user'])){
                        echo '';}
                        elseif($_SESSION['user']['id_droit'] == 3 OR $_SESSION['user']['id_droit'] == 2){
                        echo "</div>
                        <div class = 'formulairetopic'>
                        <h4 class = 'h4casetopic'>Créer un topic</h4>
                        <form action='' method='post'>
                        <input type='text' name='topic' id='topic' placeholder='Titre du topic'><br>
                        <input type='submit' name='submit' id='submit' placeholder= 'Publier' class = 'button'><br>";
                        if(isset($_POST['submit'])){
                        $user->topic($_POST['topic'], date('Y/m/d H:i:s'));
                        }
                        }else 
                        echo '';
                    ?>
                </form>
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