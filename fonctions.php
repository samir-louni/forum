<?php

class forum
{
private $_link;
private $_id;
private $_id_utilisateur;
private $_id_sujet;
public $_login;
public $_password;


///////////////////////////////////////////////////// Fonction pour instancier la connexion à la base de donnée



public function dbconnect()
{

$conn = new PDO("mysql:host=localhost; dbname=forum", 'root', '');
$this->_link = $conn;

}



/////////////////////////////////////////////////////////// Fonction pour créer l'utilisateur en BDD



public function register($_login, $_name, $_password, $_confirm_password)
{

$link = $this->_link;
$_login = htmlspecialchars($_login);
$_name =  htmlspecialchars($_name);
$_password = htmlspecialchars($_password);
$login = trim($_login);
$password = trim($_password);
$droit = 1;
$name = trim($_name);
$confirm = trim($_confirm_password);
$crypt = password_hash($password, PASSWORD_BCRYPT);
$verif = "SELECT login FROM utilisateurs WHERE login = '$login'";
$query = $link->query($verif);



if (!empty($login) && !empty($password) && !empty($confirm)) {
if ($query->fetch(PDO::FETCH_ASSOC) == 0) {
    if ($password == $confirm) {
    $query = "INSERT INTO utilisateurs (login, nom , password, id_droit) VALUES ('$login', '$name', '$crypt', '$droit')";
    $link->query($query);
    header("Location:connexion.php");
    } else
    echo '<br>Les mots de passe ne sont pas identiques.<br>';
} else
    echo '<br>Ce login existe déja<br>';
} else
echo '<br>Veuillez remplir le formulaire s\'il vous plait ! <br>';

}



////////////////////////////////////////////////////// Fonction qui vérifie les informations en BDD pour se connecter avec le bon utilisteur 



public function connect($_login, $_password)
{

$_login = htmlspecialchars($_login);
$_password = htmlspecialchars($_password);

$this->_login = $_login;
$this->_password = $_password;
$msg = "";
$link = $this->_link;

$SQL = "SELECT * FROM utilisateurs WHERE login = '$_login'";
$query = $link->query($SQL);
$user = $query->fetch(PDO::FETCH_ASSOC);
if ($_password == null) {
echo 'Remplissez tout les champs';
} else {
if (password_verify($_password, $user['password'])) {
    $_SESSION['user'] = $user;
    header("location: index.php");
} else {
    echo "<br>Le login ou le mot de passe n'est pas correct ! <br>";
    }
 }

}




///////////////////////////////////////////////////////////////////////////////// Fonction pour déconnecter l'utilisateur



public function disconnect()
{

$this->_login = '';
$this->_password = '';
session_destroy();
header("refresh: 0.1; url=index.php");

}



//////////////////////////////////////////////////////////////////////////////// Fonction pour traduire les jours en FR



public function dateToFrench($_date, $_format)
{

$english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
$french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
$english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($_format, strtotime($_date))));

}



//////////////////////////////////////////////////////////////////////////////////////// Fonction pour créer un topic en BDD



public function topic($_topic, $_date)
{

$link = $this->_link;

if (!empty($_topic)) {
    $SQL1 = "INSERT INTO topics(topic, date) VALUES ('$_topic', '$_date')";
    $query1 = $link->prepare($SQL1);
    $query1->execute();
    echo 'Nouveau topic créer';
    header("refresh: 1");
} else
echo '<br>Veuillez remplir le champ s\'il vous plait <br>';

}



///////////////////////////////////////////////////////////////////////////////////////////////// Fonction pour créer un sujet en BDD



public function sujet($_sujet, $_date, $_id_utilisateur, $_id_topic)
{
$link = $this->_link;

if (!empty($_sujet)) {
    $query = "INSERT INTO sujets (sujet, date, id_utilisateur, id_topic) VALUES ('$_sujet', '$_date', '$_id_utilisateur', '$_id_topic')";
    $prepare =  $link->prepare($query);
    $prepare->execute();
    echo 'Nouveau sujet créer';
    header("refresh: 1");
}else
    echo '<br>Veuillez remplir le champ s\'il vous plait <br>';

    
}




////////////////////////////////////////////////////////////////////////////////////////////////////////// Fonction pour afficher les topics



public function affichertopic()
{
$link = $this->_link;

$select = $link->prepare("SELECT id, topic, date FROM topics");
$select->execute();
if(!isset($_SESSION['user'])){
    echo '';}
    else
foreach($select as $value){
    $id = $value['id'];
    echo " <div class = 'casetopic'>";
    echo "<a href='sujet.php?id_topic=$id'>" . $value['topic'] . '</a>' . '<br>';     
    echo "</div>";
}
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////// Fonction pour afficher les sujets



public function affichersujet($_id_topic)
{
$link = $this->_link;

$select = $link->prepare("SELECT id, sujet, date FROM sujets WHERE id_topic = $_id_topic");
$select->execute();
$info2 = $select->fetchAll(PDO::FETCH_ASSOC);
foreach($info2 as $key=>$value){
    $id = $value['id'];
    echo "<div class = 'casetopic'>"; 
    echo "<a href='conversation.php?id_sujet=$id'>" . $value['sujet'] . '</a>' . '<br>';  
    echo "</div>";
}
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////// Fonction pour afficher le(s) commentaire(s) du bon sujet


public function affichercommentaire($_id_sujet)
{
$link = $this->_link;


if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $this->supprimer($id);
    header('refresh: 0.1');
}


if(isset($_POST['vote'])){


    $id = $_POST['id'];
    $user = $_SESSION['user']['id'];

    $query1 = $link->prepare("SELECT * FROM likes WHERE `like` = 1 and id_commentaire = '$id' and id_utilisateur = '$user'");
    $query2 = $link->prepare("DELETE FROM likes WHERE `like` = 1 and id_commentaire = '$id' and id_utilisateur = '$user'");
    $query3 = $link->prepare("SELECT * FROM likes WHERE dislike = 1 and id_commentaire = '$id' and id_utilisateur = '$user'");
    $query4 = $link->prepare("DELETE FROM likes WHERE dislike = 1 and id_commentaire = '$id' and id_utilisateur = '$user'");
    $query1->execute();
    $query3->execute();
    $countdislike = $query3->rowCount();
    $countlike = $query1->rowCount();


    $query1->fetch(PDO::FETCH_ASSOC);
    $countlike = $query1->rowCount();
    if($countlike == 0){
        if($countdislike == 1){
            $query4->execute();
            if($_POST['vote'] == 'like'){
            $this->like($id, $user);
            }
        }else{
        if($_POST['vote'] == 'like'){
            $this->like($id, $user);
        }
        }
    }else{
    $query2->execute();
    }

    $query3->fetch(PDO::FETCH_ASSOC);
    $countdislike = $query3->rowCount();
    if($countdislike == 0){
        if($countlike == 1){
            $query2->execute();
            if($_POST['vote'] == 'dislike'){
            $this->dislike($id, $user);
            }
        }else{
            if($_POST['vote'] == 'dislike'){
                $this->dislike($id, $user);
            } 
        }
    }else{
    $query4->execute();
    }


}



$select = $link->prepare("SELECT * FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id WHERE id_sujet = ('$_id_sujet') ORDER BY DATE");
$select->execute();
foreach($select as $value){
    echo "<div class = 'casetopic'>"; 
       echo "<p class = 'pseudo'>"  . $value['login'] . '</p>';
       echo  "<p class = 'date'>" . 'Envoyée le : &nbsp;&nbsp;' . $value['date'] . '</p><br>';
       echo "<p class = 'commentaire'>" . $value['commentaire'] . '</p><br>';  
       
    
       
       if(!isset($_SESSION['user'])){
        echo '';
        echo '</div>';
    }
        else{
    
    echo $this->recuplikes($value[0]) . "<section class = 'boutongauche'><form method=post> <input type='hidden' name='id' value='{$value[0]}'> <input type='submit' name='vote' value='like' class = 'button2'></form>" . '<br>' . $this->recupdislikes($value[0])  . "<form method=post><input type='hidden' name='id' value='{$value[0]}'><input type='submit' name='vote' value='dislike' class ='button2'></form>" . '<br>';
    if(!isset($_SESSION['user'])){
        echo '';
        echo '</div>';
    }
    elseif($_SESSION['user']['id_droit'] == 2 OR $_SESSION['user']['id_droit'] == 3 ){
        echo "<form method=post><input type='hidden' name='id'  value='{$value[0]}'><input type='submit' name='delete' value='Supprimer' class = 'button'></form></section>" . '<br>';
        echo "</div>";  
    }
    else{
        echo '';   
        echo "</div>";  
        
    }
}}
}
public function like($_id_commentaire, $_id_utilisateur)
{
$link = $this->_link;

$query = $link->prepare("INSERT INTO likes (`like`, dislike, id_commentaire, id_utilisateur) VALUES (1, 0, '$_id_commentaire', '$_id_utilisateur')");
$query->execute();
}

public function dislike($_id_commentaire, $_id_utilisateur)
{
$link = $this->_link;

$query = $link->prepare("INSERT INTO likes (`like`, dislike, id_commentaire, id_utilisateur) VALUES (0, 1, '$_id_commentaire', '$_id_utilisateur')");
$query->execute();
}




public function recuplikes($_id_commentaire)
{
$link = $this->_link;

$query = $link->prepare("SELECT COUNT(*) FROM likes WHERE `like` = 1 and id_commentaire = $_id_commentaire");
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);
echo "<div class = 'likedislike'><p class = 'like'>(</p>";
echo array_sum($user);




}


public function recuplikes2($_id_commentaire)
{
$link = $this->_link;

$query = $link->prepare("SELECT COUNT(*) FROM likes WHERE `like` = 1 and id_commentaire = $_id_commentaire");
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);
echo "<div class = 'likedislike2'><p class = 'like'>(</p>";
echo array_sum($user);




}


public function recupdislikes($_id_commentaire)
{
$link = $this->_link;

$query = $link->prepare("SELECT COUNT(*) FROM likes WHERE dislike = 1 and id_commentaire = $_id_commentaire");
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);
echo "<p class = 'like'>{</p>";
echo array_sum($user);

echo "</div>";
}

public function supprimer($_id)
{
$link = $this->_link;

$query = $link->prepare("DELETE FROM `commentaires` WHERE id = $_id");
$query->execute();
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////// Fonction pour envoyer un commentaire



public function commentaire($_commentaire, $_date, $id_utilisateur, $id_sujet)
{
$link = $this->_link;
if(!isset($_SESSION['user'])){
    echo 'Tu dois être connecté pour envoyer un commentaire ';
}
elseif (!empty($_commentaire)) {
    $_com = addslashes($_commentaire);

$query = $link->prepare("INSERT INTO commentaires (commentaire, date, id_utilisateur, id_sujet) VALUES ('$_com', '$_date', '$id_utilisateur', '$id_sujet')");

    $query->execute();
echo 'commentaire envoyé';
header("refresh: 0.5");

}else 
    echo '<br>Veuillez remplir le champ s\'il vous plait <br> ';
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////// Fonction pour afficher le(s) commentaire(s)



////////////////////////// Fonction pour afficher le statut de l'utilisateur ( membres / modérateur / admin )

public function statut(){
$link = $this->_link;
if($_SESSION['user']['id_droit'] == 1)
{
    echo 'Membre';
}elseif($_SESSION['user']['id_droit'] == 2)
{
    echo 'Modérateur';
}elseif($_SESSION['user']['id_droit'] == 3)
{
    echo 'Admin';
}
echo '<br>';
}

///////////////////// Fonction qui donne droit uniquement a l'admin de pouvoir crée un topic.
public function droitadmin(){
if($_SESSION['user']['id_droit'] == 3 OR $_SESSION['user']['id_droit'] == 2 )
{
    echo "<form action='' method='post'>
    <input type='text' name='topic' id='topic' placeholder='topic'><br>
    <input type='submit' name='submit' id='submit' placeholder='envoyer'><br>
    </form>";
}
}

/////// Fonction qui permet de changer le statut de l'utilisateur dans la base de donnée 

public function changementdedroit($_id_droit, $_id_utilisateur)
{
    $link = $this->_link;
    $verif = "SELECT id FROM utilisateurs WHERE id = '$_id_utilisateur'";
    $requete = $link->query($verif);
    if(!empty($_id_droit) && (!empty($_id_utilisateur)))
    {
    if ($requete->fetch(PDO::FETCH_ASSOC) == 0) {
        echo "<p class = 'messageerreur'>Cette id n'existe pas</p>";
}else{
    $query = $link->prepare("UPDATE utilisateurs SET id_droit = '$_id_droit' WHERE id = $_id_utilisateur");
    $query->execute();
    if($_id_droit == 3){
        echo "<p class = 'messagevalide'>L'utilisateur est passé admin !</p>";
    }elseif($_id_droit == 2){
        echo "<p class = 'messagevalide'>L'utilisateur est passé modérateur !</p>";
    }else{
        echo "<p class = 'messagevalide'>L'utilisateur est passé membre !</p>";
    }
}
    }else 
    echo "<p class ='messageerreur'>Remplissez les champs !</p>";
    header("refresh: 2");
}


///////////////////// Fonction qui permet d'afficher la table utilisateur sous forme de tableau

public function afficherbasededonner()
{
    
    $link = $this->_link;
    $requete = $link->prepare('SELECT id, login, id_droit FROM utilisateurs WHERE 1');
    $requete->execute();
    $resultat = $requete->fetchall();
            
            
            foreach ($resultat as $key) {
                echo "<tr>";
                echo "<td>".$key['id']."</td>";
                echo "<td>".$key['login']."</td>";
                echo "<td>".$key['id_droit']."</td>";
                echo "</tr>";
            }
               
        
            


}

public function afficherbasededonner2()
{
    
    $link = $this->_link;
    $requete = $link->prepare('SELECT id, login, id_droit FROM utilisateurs WHERE 1');
    $requete->execute();
    $resultat = $requete->fetchall();
            
            
            foreach ($resultat as $key) {
                $id = $key['id'];
                echo "<tr>";
                echo "<td>".$key['login']."</td>";
                echo "<td>";
                echo "<a href='voir_profil.php?id=$id'>Profil </a>";
                echo "</td>";

            }      
}

///////////////////// Fonction qui accorde l'accès a une page seulement si l'utilisateur est admin

public function droitaccespageadmin()
{
    if (!isset($_SESSION['user'])) {
        header("Refresh: 4; url=connexion.php");
        echo " <section class='cadre-connexion'><div class = 'tab-connexion'><h4> Tu n'es pas connecté ! </h4></div></section>";
        echo "<footer class = 'footer2'><img class = 'fot2' src='images-forum/playlogo.png' alt = ' Logo playstation '></footer>";

        exit();
    }else{
if($_SESSION['user']['id_droit'] != 3)
{
    header("Refresh: 4; url=index.php");
    echo " <section class='cadre-connexion'><div class = 'tab-connexion'><h4> Tu dois être admin pour acceder à cette page  ! </h4></div></section>";
    echo "<footer class = 'footer2'><img class = 'fot2' src='images-forum/playlogo.png' alt = ' Logo playstation '></footer>";

    exit();
}}
}


///////////////////// Fonction qui affiche le header du site 

public function header()
{
    
    if(!isset($_SESSION['user'])){
        echo "<li><a href='index.php'>Accueil</a></li>
              <li><a href='topic.php'>Topic</a></li>
              <li><a href='utilisateur'>Utilisateurs</a></li>
              <li><a href='inscription.php'>Inscription</a></li>
              <li><a href='connexion.php'>Connexion</a></li>";
            
    }
    elseif($_SESSION['user']['id_droit'] == 3 ){
        echo "<li = class 'margeheader'><a href='admin'>Admin</a></li>
              <li><a href='index.php'>Accueil</a></li>
              <li><a href='topic.php'>Topic</a></li>
              <li><a href='utilisateur'>Utilisateurs</a></li>
              <li><form method='post'><input type = 'submit' name = 'deconnexion' value='Deconnexion' class = 'deco'></form></li>";   }                   
              else{
            echo "<li><a href='index.php'>Accueil</a></li>
            <li><a href='topic.php'>Topic</a></li>
            <li><a href='profil.php'>Profil</a></li>
            <li><a href='utilisateur'>Utilisateurs</a></li>
            <li><form method='post'><input type = 'submit' name = 'deconnexion' value='Deconnexion' class = 'deco'></form></li>";
        }
}

///////////////////// Fonction qui empeche l'utilisateur d'accéder a une page car il n'est pas connecté

public function noconnect()
{
    if(!isset($_SESSION['user'])){
        header("Refresh: 3; url=connexion.php");
        echo "<body><main>";
        echo " <section class='cadre-connexion'><div class = 'tab-connexion'><h4> Tu n'es pas connecté ! </h4></div></section>";
        echo "</main></body>";
        echo " <footer class = 'footer2'><section class = 'footercentrer'><img class = 'fot2' src='images-forum/playlogo.png' alt = ' Logo playstation '></section></footer>";

        exit();
    }
}

///////////////////// Fonction qui empeche l'utilisateur d'accéder a une page car il est déjà connecté
public function dejaconnect()
{
    if(isset($_SESSION['user'])){
        header("Refresh: 3; url=index.php");
        echo " <section class='cadre-connexion'><div class = 'tab-connexion'><h4> Tu es déjà connecté ! </h4></div></section>";
        echo "<footer class = 'footer2'><img class = 'fot2' src='images-forum/playlogo.png' alt = ' Logo playstation '></footer>";

        exit();
    }
}

public function profil()
{
    $link = $this->_link;
    $login = ($_SESSION['user']['login']);
    $requete = $link->prepare("SELECT * FROM utilisateurs WHERE login='$login'");
    $requete->execute();
    $info =  $requete->fetch();
    $idinfo = $info['id'];
    $logininfo = $info['login'];
    echo "<h4>ID : $idinfo</h4><br>";
    echo "<h4>Login :  $logininfo</h4><br>";
    echo "<h4>Statut : "; $this->statut();
    echo "</h4>";
}

public function voirprofil()
{
$link = $this->_link;
$id = $_GET['id'];
$profil = $link->prepare("SELECT * FROM utilisateurs WHERE id = $id");
$profil->execute();
$afficherprofil = $profil->fetch();
    echo " <h4>Voici le profil de : ";
    echo $afficherprofil['login'];
    echo "<br>";
    echo "<br>ID : ";
    echo $afficherprofil['id'];
    echo "<br>";
    echo "<br>Nom : ";
    echo $afficherprofil['nom'];
    echo "</h4>";
    echo "<br>";
if($afficherprofil['id_droit'] == 1){
    echo '<h4><br> Statut : Membre </h4>';
}
elseif($afficherprofil['id_droit'] == 2 ){
    echo '<h4><br>Statut : Modérateur</h4>';
}
elseif($afficherprofil['id_droit'] == 3){
    echo '<h4><br>Statut : Admin<h4>';
}
}

}
