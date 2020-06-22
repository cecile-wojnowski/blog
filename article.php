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

// Récupération des articles
$req = $bdd->prepare('SELECT article, date FROM articles WHERE id  = ? ORDER BY date');
$req->execute(array($_GET['article']));

while ($donnees = $req->fetch())
{
?>
<p><strong><?php echo htmlspecialchars($donnees['article']); ?></strong> le <?php echo $donnees['date']; ?></p>
<?php
} // Fin de la boucle des articles
$req->closeCursor();
?>



</body>
</html>
