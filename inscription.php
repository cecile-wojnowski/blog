<?php
$mysqli = mysqli_connect("127.0.0.1", "root", "", "blog"); # Connexion à la base de données
$mysqli->set_charset("utf8"); # Permet d'afficher les accents

# Si le champ login est rempli
if(isset($_POST["login"])) {
  $sql = "SELECT * FROM utilisateurs WHERE login = '".$_POST['login']."'";
  $requete=$mysqli->query($sql);

  if($_POST["password"] != $_POST["confirm_password"]) {
    /* Si le mot de passe confirmé n'est pas identique au premier mot de passe saisi :
    Rediriger vers inscription avec un message d'erreur */
    header('Location: inscription.php?erreur=1');

  } elseif($requete->num_rows > 0) { # Si le login provenant du form existe déjà dans la bdd, on redirige
    header('Location: inscription.php?erreur=2');
  } else {
    $login = $_POST['login'] ;
    $password = $_POST['password'];
    $email= $_POST['email'];
    $id_droits = $_POST['id_droits'];
    $passcrypt = password_hash($password, PASSWORD_BCRYPT);

    # Requête : insérer dans la table Utilisateurs les données correspondant à ces variables
    $sql = "INSERT INTO utilisateurs(login, password, email, id_droits)
            VALUES('$login', '$passcrypt', '$email', '$id_droits')";

    # Exécution de la requête :
    if ($mysqli->query($sql) === TRUE) {
      # Redirection vers connexion.php
      header('Location: connexion.php');
    } else {
      echo "Erreur: " . $sql . "<br>" . $mysqli->error;
    }
  }
}
?>

<!DOCTYPE html>
<html>
    <head>
      <title> Inscription </title>
      <link rel="stylesheet" href="css/form.css"/>
      <link rel="stylesheet" href="css/style.css">
      <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">

      <meta charset="utf-8">
    </head>



    <body>
      <?php  include('includes/header.php') ?>
      <main>
        <h1> Créer un compte </h1>
        <div class="container">

        <form action="inscription.php" method="POST" name="inscription">
          <?php
          if (isset($_GET['erreur'])){
            if ($_GET["erreur"] == 1) {
              echo "Veuillez confirmer votre mot de passe.";
            } elseif($_GET["erreur"] == 2) {
              echo "Ce login existe déjà.";
            }

          }
          ?>
    	    <div>
        	    <label for="login"> Login:</label><br/>
        	     <input type="text" id="login" name="login">
   		    </div>

          <div>
          	<label for="email"> E-mail:</label><br/>
          	  <input type="email" id="email" name="email">
     		  </div>

    	    <div>
        	  <label for="password"> Mot de passe:</label><br/>
        	  <input type="password" name="password" required>
          </div>

          <div>
        	  <label for="password"> Confirmez votre mot de passe:</label><br/>
            <input type="password" name="confirm_password" required>
    	    </div>

          <div>
            <input type="hidden" id="id_droits" name="id_droits" value="1">
          </div>

        <div class="row">
    	    <button type="submit"> Envoyer </button>
        </div>
        </div>
   	    </form>
        <?php  include('includes/footer.php') ?>
      </main>
    </body>
  </html>
