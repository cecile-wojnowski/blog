<?php
# Si le champ login est rempli
if(isset($_POST["login"])) {
  if($_POST["password"] != $_POST["confirm_password"]) {
    /* Si le mot de passe confirmé n'est pas identique au premier mot de passe saisi :
    Rediriger vers inscription avec un message d'erreur */
    header('Location: inscription.php?erreur=1');
  } else {
    $mysqli = mysqli_connect("127.0.0.1", "root", "", "blog"); # Connexion à la base de données
    $mysqli->set_charset("utf8"); # Permet d'afficher les accents

    # Est enregistré dans des variables ce que l'utilisateur entre dans les champs du formulaire
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
      <link rel="stylesheet" href="form.css"/>
      <link rel="stylesheet" href="style.css">
      <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">

      <meta charset="utf-8">
    </head>



    <body>
      <?php include("header.php"); ?>
      <main>
        <h1> Créer un compte </h1>
        <div class="container">

        <form action="inscription.php" method="POST" name="inscription">
          <?php
          if (isset($_GET['erreur'])){
            echo "Veuillez confirmer votre mot de passe.";
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

    	    <button type="submit"> Envoyer </button>
        </div>
   	    </form>
        <?php include("footer.php");
         ?>
      </main>
    </body>
  </html>
