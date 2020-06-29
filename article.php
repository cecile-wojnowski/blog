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
  $req = $bdd->prepare('SELECT id_utilisateur, titre, article, date FROM articles WHERE id  = ?');
  $req->execute(array($_GET['article']));

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

  # Afficher les commentaires et le formulaire d'ajout de commentaires
  ?>
  <form class="ajout_commentaire" action="article.php" method="post">
  </form>


  </body>
</html>
