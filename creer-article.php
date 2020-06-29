<?php

$mysqli = mysqli_connect("127.0.0.1", "root", "", "blog"); # Connexion à la base de données
$mysqli->set_charset("utf8"); # Permet d'afficher les accents

try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>


 <!DOCTYPE html>
 <html>
     <head>
       <title>créer un article</title>
       <link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" href="form.css">
<link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">

       <meta charset="utf-8">
     </head>

     <body>

       <header>

         <?php include("header.php"); ?>

       </header>
       <main>
         <?php if (isset($_SESSION['login'])){ ?>


         <h1> Ecrire un article </h1>


         <div class="container">

<form class="" action="" method="post">

  <div class="form-group shadow-textarea">

    <div class="form-group">
      <label for="titre"> Titre de l'article</label><br/>
      <input type="text" class="form-control" name="titre">
     </div>


  <label for="article">article</label><br />
  <textarea  id="article" name="article"placeholder="écrivez ici..."></textarea>

  <label for="">catégorie</label>
<select>
  <?php   $reponse = $bdd->query('SELECT * FROM categories');

     // On affiche chaque entrée une à une
     while ($donnees = $reponse->fetch()) {
         ?>
         <p>
         <strong>catégorie</strong> : <?php echo"<option>". $donnees['nom']."</option>";
     }
         ?><br />

   </select>

  <button type="submit" name="poster_article"> Poster le nouvel article  </button>

  <?php if (isset($_POST['poster_article'])) {
             $titre=$_POST['titre'];
             $article=$_POST['article'];
             $id_utilisateur=$_SESSION['id'];
             $id_categorie=$_POST['categorie'];

             $sql= "INSERT INTO `articles`( `article`, `id_utilisateur`, `id_categorie`, `date`, `titre`) VALUES ('$article','$id_utilisateur','$id_categorie',NOW(),'$titre')";

             $resultat = mysqli_query($mysqli, $sql);

             echo "l'article a été posté.";
         }

}
         else {

       		echo "<br /><center> Bien essayé, mais vous ne pouvez pas accéder à cette page !"."<a href='connexion.php'> me connecter</a> ou alors <a href='inscription.php'> m'inscrire </a></center>";


     ?>

     <center><img src="philo5.gif" alt=""></center>

     <?php	}
             ?>

</div>
</div>

</form>

        </main>



     </body>
   </html>
