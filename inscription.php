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
    # Requête : insérer dans la table Utilisateurs les données correspondant à ces variables
    $sql = "INSERT INTO utilisateurs(login, password, email, id_droits)
            VALUES('$login', '$password', '$email', 'id_droits')";
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
      <meta charset="utf-8">
    </head>

    <body>
      <main>
        <h1> Créer un compte </h1>
        <form action="inscription.php" method="POST" name="inscription">
          <?php
          if (isset($_GET['erreur'])){
            echo "Veuillez confirmer votre mot de passe.";
          }
          ?>
    	    <div>
        	    <label for="login"> Login:</label>
        	     <input type="text" id="login" name="login">
   		    </div>

          <div>
          	<label for="email"> E-mail:</label>
          	  <input type="email" id="email" name="email">
     		  </div>

          <div>
          	   <label for="id_droits"> Id_droits:</label>
          	    <input type="number" id="id_droits" name="id_droits">
     		  </div>

    	    <div>
        	  <label for="password"> Mot de passe:</label>
        	  <input type="password" name="password" required>
          </div>

          <div>
        	  <label for="password"> Confirmez votre mot de passe:</label>
            <input type="password" name="confirm_password" required>
    	    </div>
    	    <button type="submit"> Envoyer </button>
   	    </form>
      </main>
    </body>
  </html>
