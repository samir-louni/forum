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
        <h2 class = 'h2pagesujet'>Accueil</h2>
        <section class = 'article'>
            <div class ='ps5rupture'>
                <h3>PS5 en rupture mondiale : désastre ou génie marketing ?</h3>
                    <img src = "images-forum/ps5.jpg" alt = 'image article playstation 5' class = 'margehaut'>
                        <p>
                        La PS5 est enfin disponible ! Enfin… en théorie… parce que si la date de sortie – le 19 novembre 2020 – est déjà passée, elle est en rupture de stock mondiale.<br>
                        Bien que la demande soit qualifiée de « sans précédent » par Sony, cela reste une grande déception pour les nombreux gamers privés du précieux graal qu’on leur annonce depuis plus d’un an.<br>
                        Compte tenu du nombre important de bugs constatés sur les premières consoles livrées, ce n’est peut-être pas plus mal d’être patient pour acquérir un exemplaire plus fiable.<br>
                        <br>
                        Malgré les excuses et les promesses de Sony qui a déjà significativement augmenté les volumes livrés, l’indisponibilité de sa console nouvelle génération pourrait se prolonger au-delà des fêtes de fin d’année,<br>
                        ce qui ne manquera pas d’aggraver la frustration de ceux qui sont tentés de l’acheter jusqu’à 6 fois son prix déjà élevé de 500 euros sur certains sites. Sony aurait vendu autant de PS5 en 12 heures que de PS4 lors des 12 premières semaines.
                        </p>
            </div>
            <div class ='demonsoul'>
                <h3>Demon's Souls Remake : Une refonte somptueuse aux allures de vrai jeu next-gen</h3>
                    <iframe width="640" height="427" src="https://www.youtube.com/embed/d4VAM2HY8ak" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class = 'margehaut'></iframe>
                        <p>
                        Pour le lancement de la PS5, Bluepoint Games et Sony rappellent d’entre les morts Demon’s Souls, titre fondateur de la célèbre série de From Software, berceau d’une philosophie de game design et de level design qui fera exploser le studio.<br>
                        Onze ans plus tard, le jeu fait donc l’objet d’un remake, piloté par les équipes à l’origine de la refonte de Shadow of the Colossus. C’est l’heure du verdict.<br>
                        <br>
                        La tâche est lourde pour Bluepoint Games : faire revenir un titre considéré comme culte et créer la première “véritable exclusivité next-gen" de la PS5.<br>
                        Et autant le dire tout de suite : le défi est relevé haut la main, malgré quelques petits défauts inhérents au jeu de From Software (et que le studio en charge de ce remake ne s’est pas aventuré à corriger - on en reparle plus tard). <br>
                        Bien sûr, ce sont d’abord les graphismes de ce Demon’s Souls, mettant à profit la puissance de la nouvelle PlayStation, qui sautent aux yeux.
                        </p>
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