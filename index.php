
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">

    </head>

    <body>

<header>

  <?php include('header.php'); ?>

</header>

<div class="row">
<div class="leftcolumn">

<?php
// Connexion à la base de données blog
try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}

// On récupère les 3 derniers articles
$req = $bdd->query('SELECT id, article, date, titre FROM articles ORDER BY date DESC LIMIT 0, 3');


//début de la boucle pour afficher les derniers articles
while ($donnees = $req->fetch()) {
    ?>
        <div class="card">

          <h2>  <?php echo htmlspecialchars($donnees['titre']); ?> </h2>
          <h5>le <?php echo $donnees['date']; ?></h5>

          <div class="dropdown_card">

        <p>  <?php echo htmlspecialchars($donnees['article']); ?></p>
          <div class="dropdown-content_card">
        <em><a href="article.php?id=<?php echo $donnees['id']; ?>"  >voir l'article</a></em>
          </div>
      </div>

</div>

<?php
} // Fin de la boucle des articles
$req->closeCursor();
?>
</div>

<div class="rightcolumn">
   <div class="card">
     <h2>L'équipe du blog</h2>
     <div class="card_img">

     <div class="container">
       <img src="img/portrait1.jpeg" alt="">
       <div class="overlay">
         <div class="text">Aïcha chercheuse</div>
       </div>
     </div>

     <div class="container">
       <img src="img/portrait2.jpeg" alt="">
       <div class="overlay">
         <div class="text">Nengah doctorante</div>
       </div>
     </div>

     <div class="container">
       <img src="img/portrait3.jpeg" alt="">
       <div class="overlay">
         <div class="text">Ruth étudiante</div>
       </div>
     </div>

          <div class="container">
            <img src="img/portrait4.jpeg" alt="">
            <div class="overlay">
              <div class="text">Salomée maître de conférence</div>
            </div>
          </div>
        </div>

   </div>


   <div class="card">
     <h3> Site amis </h3>
<a href="http://www.philagora.net/">Philagora</a>
<a href="https://la-philosophie.com/">La philo.com</a>
<a href="https://www.philolog.fr/">Philolog</a>
   </div>
   <div class="card">
     <h3>Catégories du site</h3>
     <div class="picture">




       <div class="top_slider">
         <div id="slider">

         <figure>
   <img src="img/philo7.png" alt="">
   <img src="img/philo8.jpg" alt="">
   <img src="img/philo3.jpg" alt="">
   <img src="img/philo4.jpg" alt="">
   <img src="img/philo4.jpg" alt="">
         </figure>
         </div>
       </div>

   </div>
     <?php   $reponse = $bdd->query('SELECT * FROM categories');
        while ($donnees = $reponse->fetch()) {
            ?>
            <a href="">
        <?php echo $donnees['nom'];
        }
            ?><a/>

   </div>
   <div class="card_network">
     <h3>Suivez nous </h3>


<a href="https://www.instagram.com/?hl=fr"><img src="https://img.icons8.com/ios-filled/50/000000/instagram-new.png"/>
</a>
<a href="https://www.reddit.com/"><img src="https://img.icons8.com/ios-filled/50/000000/reddit.png"/>
</a>
<a href="https://fr-fr.facebook.com/"><img src="https://img.icons8.com/metro/52/000000/facebook.png"/>
</a>
   </div>


 </div>



</div>
<?php include("footer.php");
 ?>
    </body>
</html>
