<?php

$mysqli = mysqli_connect("127.0.0.1", "root", "", "blog"); # Connexion à la base de données
$mysqli->set_charset("utf8"); # Permet d'afficher les accents

?>

 <!DOCTYPE html>
 <html>
     <head>
       <title>créer un article</title>
       <link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" href="form.css">
       <meta charset="utf-8">
     </head>

     <body>

       <header>

         <?php include("header.php"); ?>

       </header>
       <main>
         <h1> Ecrire un article </h1>


         <div class="container">

<form class="" action="creer-article.php" method="post">

  <div class="form-group shadow-textarea">

    <div class="form-group">
      <label for="titre"> Titre de l'article</label><br/>
      <input type="text" class="form-control" name="titre">
     </div>


  <label for="article">article</label><br />
  <textarea  id="article" name="article"placeholder="écrivez ici..."></textarea>

  <select id="categorie" name="categorie">
   <option value="1">catégorie 1</option>
   <option value="2">catégorie 2</option>
   <option value="3">catégorie 3</option>
 </select>

  <button type="submit" name="poster_article"> Poster le nouvel article  </button>

  <?php if (isset($_POST['poster_article'])){

$titre=$_POST['titre'];
$article=$_POST['article'];
$id_utilisateur=$_SESSION['id'];
$id_categorie=$_POST['categorie'];

$sql= "INSERT INTO `articles`( `article`, `id_utilisateur`, `id_categorie`, `date`, `titre`) VALUES ('$article','$id_utilisateur','$id_categorie',NOW(),'$titre')";

$resultat = mysqli_query($mysqli, $sql);

echo "l'article a été posté.";
}

     ?>
</div>
</div>

</form>

        </main>



     </body>
   </html>
