<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
<link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.css">
    </head>

    <body>

<header>

  <?php include('header.php'); ?>

</header>


<?php
// Connexion à la base de données blog

$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '',
          [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  # Tests de pagination
$count = (int)$bdd->query('SELECT COUNT(id) FROM articles LIMIT 5')->fetch(PDO::FETCH_NUM)[0];
$currentPage = (int)((!isset($_GET['page'])) ? 1 : $_GET["page"]);
  if ($currentPage <= 0){
    $currentPage = 1;
  }
$perPage = 5;
$pages = ceil($count/$perPage);
  if($currentPage > $pages){
    $currentPage = 1;
  }
# Fin des tests de pagination


$offset = $perPage * ($currentPage - 1);
// On récupère les 5 derniers articles
$req = $bdd->query("SELECT id, article, date, titre FROM articles
            ORDER BY date DESC LIMIT $perPage OFFSET $offset");

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

<?php }; ?>

<div class = "d-flex justify-content-between my-4">
  <?php if($currentPage > 1){ ?>
  <a href="articles.php?page=<?php echo $currentPage - 1 ?>" class="btn btn-primary"> Page précédente </a>
</div>

<?php
;}
// Fin de la boucle des articles
$req->closeCursor();
?>


  </body>
</html>
