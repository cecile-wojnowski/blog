
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
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// On récupère les 3 derniers articles
$req = $bdd->query('SELECT id, article, date, titre FROM articles ORDER BY date DESC');


//début de la boucle pour afficher les derniers articles
while ($donnees = $req->fetch())
{
?>
<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">

<div class="card-header">
          <?php echo htmlspecialchars($donnees['article']); ?>
        </div>
          <div class="card-body">

        <em>le <?php echo $donnees['date']; ?></em>
    </div>

      <p class="card-text">

    <br />
    <em><a href="article.php?article=<?php echo $donnees['id']; ?>" class="btn btn-xs btn-primary" >voir l'article</a></em>
    </p>
</div>
<?php
} // Fin de la boucle des articles
$req->closeCursor();
?>
    </body>
</html>
