<?php
    session_start();
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
    <div class="top">

            <h2> The new blog</h2>
            <p> ici le sous titre du blog </p>
    </div>
    <?php


        $message = "";

        if (isset($_SESSION['login'])) {
            if ($_SESSION['id_droits']== 1) {
                ?> '<div class="navbar"> <a href="index.php"><center>Accueil</center></a>
          <a href="profil.php">  Votre profil    <i> <?php $_SESSION['login'] ?></i></a>
          <a href="articles.php"> les articles  </a> <div class="dropdown">
            <button class="dropbtn">Catégories d'articles
            </button>
            <div class="dropdown-content">
              <?php   $reponse = $bdd->query('SELECT * FROM categories');
                 while ($donnees = $reponse->fetch())
                 {
                 ?>
                     <a href="">
                 <?php echo $donnees['nom']; }
                     ?><a/>
            </div>
          </div> <a href="index.php?deconnexion">
            <img src="https://img.icons8.com/fluent/48/000000/shutdown.png"/></a></div>;
          <?php } elseif ($_SESSION['id_droits']== 42) { ?>
                ?> '<div class="navbar"> <a href="index.php"><center>Accueil</center></a>
<a href="profil.php">  Votre profil    <i><?php $_SESSION['login']?></i></a><a href="creer-article.php"> écrire un article </a>

<a href="articles.php"> les articles  </a> <div class="dropdown">
  <button class="dropbtn">Catégories d'articles
  </button>
  <div class="dropdown-content">
    <?php   $reponse = $bdd->query('SELECT * FROM categories');
       while ($donnees = $reponse->fetch())
       {
       ?>
           <a href="">
       <?php echo $donnees['nom']; }
           ?><a/>
  </div>
</div> <a href="index.php?deconnexion">
  <img src="https://img.icons8.com/fluent/48/000000/shutdown.png"/></a></div>;
<?php    } elseif ($_SESSION['id_droits']== 1337) { ?>
                <div class="navbar"> <a href="index.php"><center>Accueil</center></a>
<a href="profil.php">  Votre profil    <i><?php $_SESSION['login'] ?></i></a>.
<a href="creer-article.php"> écrire un article </a>'.
<a href="admin.php"> espace admin </a>
<a href="articles.php"> les articles  </a><div class="dropdown">
  <button class="dropbtn">Catégories d'articles
  </button>
  <div class="dropdown-content">
    <?php   $reponse = $bdd->query('SELECT * FROM categories');
       while ($donnees = $reponse->fetch())
       {
       ?>
           <a href="">
       <?php echo $donnees['nom']; }
           ?><a/>
  </div>
</div><a href="index.php?deconnexion">
  <img src="https://img.icons8.com/fluent/48/000000/shutdown.png"/></a></div>';
<?php  }
        } else { ?>
  <div class="navbar">
  <a href="index.php">accueil</a>
  <a href="inscription.php">inscription</a>
  <a href="connexion.php">connexion</a>

<a href="articles.php">Voir les articles</a>
<div class="dropdown">
<button class="dropbtn">Catégories d'articles
</button>
<div class="dropdown-content">
  <?php   $reponse = $bdd->query('SELECT * FROM categories');
     while ($donnees = $reponse->fetch())
     {
     ?>
         <a href="">
     <?php echo $donnees['nom']; }
         ?><a/>
</div>
</div>
</div>
<?php  }  ?>


        <?php  if (isset($_GET['deconnexion'])) {
    unset($_SESSION['login']);
    //au bout de 2 secondes redirection vers la page d'accueil
    header("Refresh: 1; url=index.php");

    echo "<p>Vous avez été déconnecté</p><br><p>Redirection vers la page d'accueil...</p>";
}

        $message = "";  ?>
  </body>
</html>
