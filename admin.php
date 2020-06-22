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
