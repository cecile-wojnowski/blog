<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
      <title>Mon blog</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="bootstrap.css">
      <link rel="stylesheet" href="css/button.css">
    </head>

  <body>
    <header>
      <?php include('header.php'); ?>
    </header>
    <?php
    // Connexion à la base de données blog
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '',
          [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $count = (int)$bdd->query('SELECT COUNT(id) FROM articles LIMIT 5')->fetch(PDO::FETCH_NUM)[0];
    $offset = (int)((!isset($_GET['start'])) ? 0 : $_GET["start"]);
    if ($offset < 0){
      $offset = 0;
    }
    
    // On récupère les 5 derniers articles
    $req = $bdd->query("SELECT id_categorie, categories.id, articles.id, article, date, titre
                FROM categories, articles WHERE id_categorie = categories.id
                ORDER BY date DESC LIMIT 5 OFFSET $offset");

    //début de la boucle pour afficher les derniers articles
    while ($donnees = $req->fetch()){
    ?>
    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
      <div class="card">
        <h2>  <?php echo htmlspecialchars($donnees['titre']); ?> <h2>
          <p>  <?php echo htmlspecialchars($donnees['article']); ?> </p>
          <h5>le <?php echo $donnees['date']; ?></h5>

        <em><a href="article.php?article=<?php echo $donnees['id']; ?>"  >voir l'article</a></em>
      </div>
    </div>

    <?php };

    # Liens "Page précédente" et "Page suivante" ?>
    <div class = "d-flex justify-content-between my-4">
      <?php # La page précédente n'est visible que si la page courante est supérieure à 1
      if($offset > 1){ ?>
        <a href="articles.php?start=<?php echo $offset - 5 ?>" class="btn btn-primary">&laquo; Page précédente </a>

      <?php
      }; # La page suivante n'est visible que si la page courante est inférieure au nombre de pages
      if($offset < $count){ ?>
      <a href="articles.php?start=<?php echo $offset + 5 ?>" class="btn btn-primary"> Page suivante &raquo;</a>
    </div>

    <?php
    ;}
    // Fin de la boucle des articles
    $req->closeCursor();
    ?>

  </body>
</html>
