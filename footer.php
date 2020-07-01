<?php
    try
    {
    	$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>header</title>
    <link rel="stylesheet" href="css/style.css">

  </head>
  <body>

    <?php

        $message = "";

        if (isset($_SESSION['login'])) {
            if ($_SESSION['id_droits']== 1) {
                ?> '<div class="navbar_bottom"> <a href="index.php"><center>Accueil</center></a>
          <a href="profil.php">  Votre profil    <i> <?php $_SESSION['login'] ?></i></a>
          <a href="articles.php"> Articles  </a>
            <button>Catégories
            </button>
              <?php   $reponse = $bdd->query('SELECT * FROM categories');
                 while ($donnees = $reponse->fetch())
                 {
                 ?>
                     <a href="">
                 <?php echo $donnees['nom']; }
                     ?><a/>
          </div>
          <?php } elseif ($_SESSION['id_droits']== 42) { ?>
                ?> '<div class="navbar_bottom"> <a href="index.php"><center>Accueil</center></a>
<a href="profil.php">  Votre profil    <i><?php $_SESSION['login']?></i></a><a href="creer-article.php"> écrire un article </a>

<a href="articles.php"> les articles  </a>
    <?php   $reponse = $bdd->query('SELECT * FROM categories');
       while ($donnees = $reponse->fetch())
       {
       ?>
           <a href="">
       <?php echo $donnees['nom']; }
           ?><a/>
<?php    } elseif ($_SESSION['id_droits']== 1337) { ?>
                <divs class="navbar_bottom"> <a href="index.php"><center>Accueil</center></a>
<a href="profil.php">  Votre profil    <i><?php $_SESSION['login'] ?></i></a>
<a href="creer-article.php"> écrire un article </a>
<a href="admin.php"> espace admin </a>
<a href="articles.php"> les articles  </a>


    <?php   $reponse = $bdd->query('SELECT * FROM categories');
       while ($donnees = $reponse->fetch())
       {
       ?>
           <a href="">
       <?php echo $donnees['nom']; }
           ?><a/>
<?php  }
        } else { ?>

  <a href="index.php">accueil</a>
  <a href="inscription.php">inscription</a>
  <a href="connexion.php">connexion</a>

<a href="articles.php">Voir les articles</a>


  <?php   $reponse = $bdd->query('SELECT * FROM categories');
     while ($donnees = $reponse->fetch())
     {
     ?>
  <a href="articles.php">   <?php echo $donnees['nom']; }
         ?><a/>
</div>
<?php  }  ?>

  </body>
</html>
