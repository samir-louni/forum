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
        <link rel="stylesheet" href="forum.">
        <title>Admin</title>
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
        <?php
            $user->droitaccespageadmin();
        ?>
    <h2 class = 'h2pageadmin'>Liste des membres</h2>
        <section class = 'tableaucentrer'>
        <table>
            <thead>
                <tr>
                    <td><h3>ID<h3></td>
                    <td><h3>Login<h3></td>
                    <td><h3>Accès<h3></td>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $user->afficherbasededonner()
                ?>
            </tbody>
        </table>
        </section>
<section class = "centre">
    <div class = "casedroit">
        <h4>Gerer les droits</h4><br>
            <form action="" method="POST" >
                <label for="changementdroit" >Droit</label>
                <select name="changementdroit" id="changementdroit" class ='change'>
                    <option value="1" >Membres</option>
                    <option value="2">Modérateur</option>
                    <option value="3">Admin</option>
                </select><br>
                    <label for="changement">Id de l'utilisateur</label>
                    <input type ='text' id = 'changement' name = 'changement' class = 'change'><br>
                    <input type ='submit' name = 'validerlechangement' value='Changer droit' class = 'button'>
            </form>
        <?php             
            if(isset($_POST['validerlechangement'])){
            $user->changementdedroit($_POST['changementdroit'], $_POST['changement']);
            }
        ?>
    </div>
        <?php 
        $texte = "<div class ='caseinfo'>
        <h4 class = 'h4caseinfo'>Accès en fonction du statut</h4>
        <h5>1 = Membre :</h4> Accès restreint à certain topics et ne peut pas en créer, peut créer un sujet et participer au conversation, like et dislike.<br>
        <h5>2 = Modérateur :</h4> Accès restreint à certain topics, Peut créer des topics, Supprimer des messages.<br>
        <h5>3 = Admin :</h4>Accès a tout, peut gérer les droits.<br>
        <form method='post'><input type = 'submit' name = 'Fermer' value='Fermer' class = 'deco'></form>
        </div>";
        
        if(isset($_POST['rappel'])){
        echo $texte;}
        if(isset($_POST['Fermer'])){
        }
        ?>
</section>
    <section class = "bouttonrapel">
        <form method='post'><input type = 'submit' name = 'rappel' value='Rappel' class = 'deco2'></form>
    </section>
    </main>
    <footer>
        <section class = 'footercentrer'>
            <img class = "fot" src="images-forum/playlogo.png" alt = " Logo playstation ">
        </section>
    </footer>
</body>
</html>