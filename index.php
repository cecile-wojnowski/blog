
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
      <title>Mon blog</title>
      <link rel="stylesheet" href="css/style.css">
      <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
    </head>

    <body>
      <header>
        <?php include('includes/header.php'); ?>
      </header>
      <div class="row">
        <div class="leftcolumn">
          <div class="card">
            <h1>Nos derniers articles</h1>
          </div>
          <?php
          // Connexion à la base de données blog
          try {
              $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
          } catch (Exception $e) {
              die('Erreur : '.$e->getMessage());
          }
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
                  <em><a href="article.php?article=<?php echo $donnees['id']; ?>"  > Voir l'article</a></em>
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
             <h3>Que faisons nous ?</h3>
             <p> Qu'est ce que la philo ? Est ce vraiment réservé à certaines personnes où cela touche t il tout le monde
               dans notre société ? Pour répondre à ces questions et démystifier la philosophie, qui donne du sens à notre existence, nous
               avons mis en place ce blog. </p>
            </div>

            <div class="card">
              <p>
                <div class="mail"> Vous voulez contribuer au blog ? <br>
                  <a href="mailto:blogphilo@caramail.fr" target="_blank"><span>Envoyez nous un mail
                  </span></a>
                </div>
              </p>
            </div>

            <div class=" liens">
              <p> Site amis </p>
              <a href="http://www.philagora.net/" target="_blank">Philagora</a>
              <a href="https://la-philosophie.com/" target="_blank">La philo.com</a>
              <a href="https://www.philolog.fr/" target="_blank">Philolog</a>
            </div>

            <div class="card_network">
              <h3>Nous sommes sur les réseaux</h3>
              <center><a href="https://www.instagram.com/?hl=fr" target="_blank"><img src="https://img.icons8.com/ios-filled/50/000000/instagram-new.png"/>
              </a>
              <a href="https://www.reddit.com/" target="_blank"><img src="https://img.icons8.com/ios-filled/50/000000/reddit.png"/>
              </a>
              <a href="https://fr-fr.facebook.com/" target="_blank"><img src="https://img.icons8.com/metro/52/000000/facebook.png"/>
              </a></center>
            </div>
          </div>
        </div>
<?php include("includes/footer.php");
 ?>
    </body>
</html>
