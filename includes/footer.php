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
              ?>
              <div class="navbar_bottom">
                <a href="index.php"><center>Accueil</center></a>
                <a href="profil.php"> Votre profil <i> <?php $_SESSION['login'] ?></i></a>
                <a href="articles.php"> Articles  </a>

                <?php   $reponse = $bdd->query('SELECT * FROM categories');
                 while ($donnees = $reponse->fetch())
                 {
                   ?>
                    <a href="">
                   <?php echo $donnees['nom'];
                  }
                  ?><a/>
              </div>
              <?php
            }elseif ($_SESSION['id_droits']== 42){ ?>
              <div class="navbar_bottom">
                <div class="liste_footer">
                  <a href="index.php"><center>Accueil</center></a>
                  <a href="profil.php">  Votre profil <i><?php $_SESSION['login']?></i></a>
                  <a href="creer-article.php"> Ecrire un article </a>
                  <a href="articles.php"> Les articles </a>
                  <?php   $reponse = $bdd->query('SELECT * FROM categories');
                  while ($donnees = $reponse->fetch())
                  {
                  ?>
                  <a href="articles.php?categorie=<?php echo $donnees['id'];
                  ?>" class="link_categorie"> <?php  echo " ". $donnees['nom']; }?> </a>
                </div>
                <?php
                }elseif ($_SESSION['id_droits']== 1337){ ?>
                  <div class="navbar_bottom">
                    <div class="liste_footer">
                      <a href="index.php">Accueil</a>
                      <a href="profil.php"> Votre profil <i><?php $_SESSION['login'] ?></i></a>
                      <a href="creer-article.php"> Ecrire un article </a>
                      <a href="admin.php"> Espace admin </a>
                      <a href="articles.php"> Les articles </a>
                    </div>

                    <div class="liste_categories">
                      <strong> Catégories : </strong>
                      <?php   $reponse = $bdd->query('SELECT * FROM categories');
                      while ($donnees = $reponse->fetch())
                      {
                      ?>
                      <a href="articles.php?categorie=<?php echo $donnees['id'];
                      ?>" class="link_categorie"> <?php  echo " ". $donnees['nom']; }?> </a>
                    </div>
                  </div>

                <?php  }
                } else { ?>
                <div class="navbar_bottom">
                  <div class="liste_footer">
                    <a href="index.php"> Accueil </a>
                    <a href="inscription.php"> Inscription </a>
                    <a href="connexion.php"> Connexion </a>
                    <a href="articles.php"> Articles </a>
                  </div>

                  <div class="liste_categories">
                    <strong> Catégories : </strong>
                    <?php   $reponse = $bdd->query('SELECT * FROM categories');
                    while ($donnees = $reponse->fetch())
                    {
                      ?>
                      <a href="articles.php?categorie=<?php echo $donnees['id'];
                      ?>" class="link_categorie"> <?php  echo " ". $donnees['nom']; }?> </a>
                  </div>
                </div>

              <?php  }  ?>
  </body>
</html>
