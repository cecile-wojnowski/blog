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

/* Pour empêcher l'accès à un article inexistant :
On compte le nombre d'article avec id = $_GET["id"]
Si il est égal à 0, on redirige */
$sql = "SELECT count(*) FROM articles WHERE id = ?";
$result = $bdd->prepare($sql);
$result->execute(array($_GET["id"]));
$nombre_resultats = $result->fetchColumn();

if($nombre_resultats == 0) {
  header("Location:articles.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
      <title>Mon blog</title>
    	<link href="css/style.css" rel="stylesheet" />
      <link rel="stylesheet" href="css/form.css">
      <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
    </head>

    <header>
      <?php  include('includes/header.php') ?>
    </header>

    <body>
      <p><a class="link_voir_article" href="articles.php">Retour à la liste des articles</a></p>
      <div class="article">
        <h2> Article sélectionné </h2>
        <?php
        # Affichage des articles
        if(isset($_GET['id']))
        {
          $req = $bdd->prepare('SELECT login, titre, article, date FROM articles, utilisateurs
                  WHERE utilisateurs.id = articles.id_utilisateur AND articles.id  = ?');
          $req->execute(array($_GET['id']));

          while ($donnees = $req->fetch())
          {
          ?>
            <div class="card_article">
              <h2><?php echo htmlspecialchars($donnees['titre']); ?></h2>
                écrit par <?php echo htmlspecialchars($donnees['login']);?>
                le <?php echo $donnees['date']; ?><br>
              <?php echo htmlspecialchars($donnees['article']); ?></p>
            </div>
          <?php
          } // Fin de la boucle des articles
          $req->closeCursor();
        }
        ?>

        <?php
        # Affichage des commentaires
        $req = $bdd->prepare('SELECT * FROM commentaires, utilisateurs
          WHERE commentaires.id_utilisateur = utilisateurs.id AND id_article = ?');
        $req->execute(array($_GET['id']));

        while ($donnees = $req->fetch())
        {
        ?>
            <div class="card_commentaire">
              <h4> Posté par <?php echo htmlspecialchars($donnees['login']); ?>,
                le <?php echo $donnees['date']; ?></h4><br>
              <p class="commentaire"><?php echo htmlspecialchars($donnees['commentaire']); ?></p>
            </div>

        <?php
        } // Fin de la boucle des commentaires
        $req->closeCursor();

        if(isset($_POST['commentaire'])){
          $commentaire = $_POST['commentaire'];
          $req = $bdd->prepare("INSERT INTO commentaires(commentaire,id_article, id_utilisateur, date) VALUES(?, ?, ?, NOW())");
          $req->execute(array($commentaire, $_GET['id'], $_SESSION['id']));
          header("Refresh:0");
        }
        ?>

        <?php if(isset($_SESSION['login'])){
          ?> <form class="form_commentaire" action="article.php?id=<?php echo $_GET['id']; ?>" method="post" name="commentaire">
            <div class="ajout_commentaire">
              <label> Laissez un commentaire :</label>
              <textarea id = "commentaire" name="commentaire" value="" rows="5" cols="73"></textarea>
            </div>

            <div class="submit_commentaire">
              <input id="bouton_commentaire" type="submit" value="Envoyer">
            </div>
          </form>
        </div>
        <?php } ?>



      <?php include("includes/footer.php");?>
    </body>
</html>
