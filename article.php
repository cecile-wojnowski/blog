<?php

  ?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
      <title>Mon blog</title>
    	<link href="style.css" rel="stylesheet" />
      <link rel="stylesheet" href="bootstrap.css">
    </head>

    <header>
      <?php  include('header.php')    ?>
    </header>

    <body>
        <h1>The new blog</h1>
        <p><a href="articles.php">Retour à la liste des articles</a></p>

    <?php
    // Connexion à la base de données
    try
    {
    	$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }


    ?>


  <h2>Article sélectionné </h2>

  <?php
  # Joindre Article et Utilisateurs pour afficher le login dans "écrit par"
  // Récupération des articles
  if(isset($_GET['id']))
  {
    $req = $bdd->prepare('SELECT id_utilisateur, titre, article, date FROM articles WHERE id  = ?');
    $req->execute(array($_GET['id'])); # Ne fonctionne pas

    while ($donnees = $req->fetch())
    {
    ?>
      <p><strong><?php echo htmlspecialchars($donnees['titre']); ?></strong>
        écrit par <?php echo htmlspecialchars($donnees['id_utilisateur']); ?>
        le <?php echo $donnees['date']; ?><br>
      <?php echo htmlspecialchars($donnees['article']); ?></p>
    <?php
    } // Fin de la boucle des articles
    $req->closeCursor();
  }
  ?>

  <?php
    $req = $bdd->prepare('SELECT * FROM commentaires WHERE id_article = ?');
    $req->execute(array($_GET['id']));

    while ($donnees = $req->fetch())
    {
    ?>
      <p> <?php echo htmlspecialchars($donnees['id_utilisateur']); ?>
        le <?php echo $donnees['date']; ?><br>
      <?php echo htmlspecialchars($donnees['commentaire']); ?></p>

    <?php
    } // Fin de la boucle des commentaires
    $req->closeCursor();

    if(isset($_POST['commentaire'])){
      $commentaire = $_POST['commentaire'];
      $req = $bdd->prepare("INSERT INTO commentaires(commentaire,id_article, id_utilisateur, date) VALUES(?, ?, ?, NOW())");
      $req->execute(array($commentaire, $_GET['id'], 0)); #Mettre la variable id_utilisateur à place de 0
      header("Refresh:0");
    }
    ?>

  <form class="form_commentaire" action="article.php?id=<?php echo $_GET['id']; ?>" method="post" name="commentaire">
    <div class="ajout_commentaire">
      <label> Laissez un commentaire :</label>
      <textarea id = "commentaire" name="commentaire" value="" rows="5" cols="33"></textarea>
    </div>

    <div class="submit_commentaire">
      <input type="submit" value="Envoyer">
    </div>
  </form>

  </body>
</html>
