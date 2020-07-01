<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
      <title>Mon blog</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="button.css">

      <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
    </head>

    <body>
      <header>
        <?php include('header.php'); ?>
      </header>
      <?php
      // Connexion à la base de données blog
      $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

      if(isset($_GET["categorie"])) {
        $categorie = $_GET["categorie"];
        $count = (int)$bdd->query('SELECT COUNT(id) FROM articles WHERE id_categorie = "$categorie" LIMIT 5')->fetch(PDO::FETCH_NUM)[0];
      } else {
        $count = (int)$bdd->query('SELECT COUNT(id) FROM articles LIMIT 5')->fetch(PDO::FETCH_NUM)[0];
      }
      $offset = (int)((!isset($_GET["start"])) ? 0 : $_GET["start"]);

      # Condition empêchant que l'offset soit négatif
      if ($offset < 0){
        $offset = 0;
      };

      # Affichage des catégories
      ?>
      <main>
        <div class="articles_categorie">
          <h2> Filtrer par catégorie : </h2>

          <?php   $reponse = $bdd->query('SELECT * FROM categories');
          while ($donnees = $reponse->fetch())
          {
          ?>

          <a href="articles.php?categorie=<?php echo $donnees['id'];
            ?>" class="link_categorie"> <?php  echo " ". $donnees['nom']; }?> </a>
        </div>

      <div class="articles">
        <?php
        if (isset($_GET['categorie'])){
          $categorie = $_GET["categorie"];

          // On récupère les 5 derniers articles
          $req = $bdd->query("SELECT articles.id, article, date, titre
                      FROM articles
                      WHERE id_categorie = $categorie
                      ORDER BY date DESC LIMIT 5 OFFSET $offset");

          # $donnees est un array renvoyé par fetch, qui organise les champs de $req
          while ($donnees = $req->fetch()){
          ?>

        <div class="card_articles">
          <h2>  <?php echo htmlspecialchars($donnees['titre']); ?> </h2>
          <p>  <?php echo htmlspecialchars($donnees['article']); ?> </p>
          <h5> le <?php echo $donnees['date']; ?></h5>

          <em><a href="article.php?id=<?php echo $donnees['id']; ?>">voir l'article</a></em>
        </div>
      </div>
        <?php
        }
        # Si aucune des conditions n'est remplie, afficher les 5 derniers articles
        }else{

        // On récupère les 5 derniers articles
        $req = $bdd->query("SELECT articles.id, article, date, titre
                    FROM articles
                    ORDER BY date DESC LIMIT 5 OFFSET $offset");

        # $donnees est un array renvoyé par fetch, qui organise les champs de $req
        while ($donnees = $req->fetch()){
          ?>
          <div style="max-width: 18rem;">
            <div class="card_articles">

              <h2>  <?php echo htmlspecialchars($donnees['titre']); ?> </h2>
                <p>  <?php echo htmlspecialchars($donnees['article']); ?> </p>
                <h5>le <?php echo $donnees['date']; ?></h5>

              <em><a href="article.php?id=<?php echo $donnees['id']; ?>">voir l'article</a></em>
            </div>
          </div>
          <?php
        }
      };?>

      <?php # Liens "Page précédente" et "Page suivante" ?>
      <div class = "d-flex justify-content-between ">
        <?php # Page précédente
        if($offset > 1){
          if(isset($_GET["categorie"])) { ?>
            <a href="articles.php?categorie=<?php echo $_GET["categorie"]; ?>&start=<?php echo $offset - 5 ?>" class="btn btn-primary">&laquo; Page précédente </a>
          <?php } else { ?>
            <a href="articles.php?start=<?php echo $offset - 5 ?>" class="btn btn-primary">&laquo; Page précédente </a>
          <?php }
      }; # Page suivante
        if($offset + 5 < $count){
          if(isset($_GET["categorie"])) { ?>
            <a href="articles.php?categorie=<?php echo $_GET["categorie"]; ?>&start=<?php echo $offset + 5 ?>" class="btn btn-primary"> Page suivante &raquo;</a>
          <?php } else { ?>
            <a href="articles.php?start=<?php echo $offset + 5 ?>" class="articles_bouton"> Page suivante &raquo;</a>
          <?php } ?>    </div>

      <?php
      ;}
      // Termine la boucle des articles
      $req->closeCursor();
      ?>
    </main>

    <?php include("footer.php");
     ?>
  </body>
</html>
