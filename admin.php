<?php

$bdd = new PDO('mysql:host=localhost;dbname=blog','root', '');

$utilisateurs = $bdd->query('SELECT * FROM utilisateurs articles');


?>

<!DOCTYPE html>
<html>
<head>
	  <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="form.css">
<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <meta charset='utf-8' />
    <title>Admin</title>
</head>
<header>
  <?php include("header.php"); ?>

</header>
<body>

<div class="options">

	<h1>ADMIN</h1>
	<p>Vous êtes sur la page admin vous avez plusieurs possibilités :</p>

	<h3> <a href="admin.php?utilisateurs"> Utilisateurs </a></h3>

<?php

if(isset($_GET['utilisateurs'])){

 ?>

	<div class="btn-group2">

<button class="button">  modifier un utilisateur <a href="admin.php?utilisateurs?modifier_compte">cliquez ici</a></button>

<?php if(isset($_GET['modifier_compte'])){ ?>


<form class="" action="admin.php" method="post">

<input type="text" name="" value="">

</form>


<?php } ?>

<button class="button">   supprimer un compte <a href="admin.php?supprimer_compte">cliquez ici</a></button>

<button class="button">  Pour changer les droits d'un utilisateur <a href="admin.php?new_compte">cliquez ici</a> </button>
</div>

<?php } ?>

<h3> <a href="admin.php?articles">Articles</a></h3>

<?php if(isset($_GET['articles'])) { ?>

<div class="btn-group2">

<button class="button">  Pour modifier un article <a href="admin.php?modifier_article">cliquez ici</a></button>
<br>
<button class="button"> Pour supprimer un article <a href="admin.php?new_article">cliquez ici</a></button>
<br>
<button class="button"> Pour supprimer un article <a href="admin.php?supprimer_article">cliquez ici</a> </button>

<button class="button">  Pour supprimer une catégorie <a href="admin.php?supprimer_categorie">cliquez ici</a></button>

<button class="button">Pour modifier une catégorie <a href="admin.php?modifier_categorie">cliquez ici</a> </button>

<button class="button"> Pour créer une catégorie <a href="admin.php?new_categorie">cliquez ici</a> </button>
</div>
<?php } ?>


<div class="btn-group2">

<h3> <a href="admin.php?commentaires"> Commentaires </a></h3>

<?php if(isset($_GET['articles'])) { ?>


<button class="button">  Pour modifier un commentaire <a href="admin.php?modifier_comment">cliquez ici</a></button>
<br>
<button class="button">Pour supprimer un commentaire <a href="admin.php?new_comment">cliquez ici</a></button>
<br>
<button class="button"> Pour supprimer un commentaire <a href="admin.php?supprimer_comment">cliquez ici</a> </button>
</div>
</div>

<?php } ?>



	<div class="admin">
            <h2> <img src="https://img.icons8.com/wired/64/000000/administrative-tools.png"/> Liste et informations de tout les utilisateurs du site</h2>

        <?php
        while($user = $utilisateurs->fetch())
        {
            ?>
            <div class="tableau">


            <table>
                <td>
                    <tr> <?= $user['id'] ?>  </tr>
                     <tr> <?= $user['login'] ?>  </tr>
                      </tr> <tr> <?= $user['password'] ?>
                      </tr>
                    <?php

                    }?>
                </td>
            </table>
          </div>
</div>

<div class="admin">
          <h2> <img src="https://img.icons8.com/wired/64/000000/administrative-tools.png"/> Liste et informations de tout les articles du site</h2>

      <?php


      while($article = $article->fetch())
      {
          ?>
          <div class="tableau">


          <table>
              <td>
                  <tr> <?= $article['id'] ?>  </tr>
                   <tr> <?= $article['titre'] ?>  </tr>
                 </tr> <tr> <?= $article['date'] ?>
                    </tr>
                  <?php

                  }?>
              </td>
          </table>
        </div>
</div>
<div class="admin">
          <h2> <img src="https://img.icons8.com/wired/64/000000/administrative-tools.png"/> Liste et informations de tout les commentaires du site</h2>

      <?php


      while($article = $article->fetch())
      {
          ?>
          <div class="tableau">


          <table>
              <td>
                  <tr> <?= $article['id'] ?>  </tr>
                   <tr> <?= $article['titre'] ?>  </tr>
                 </tr> <tr> <?= $article['date'] ?>
                    </tr>
                  <?php

                  }?>
              </td>
          </table>
        </div>
</div>


</body>
</html>
