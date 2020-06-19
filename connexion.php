<?php
# La page de connexion mène à la page Profil
$mysqli = mysqli_connect("127.0.0.1", "root", "", "blog"); # Connexion à la base de données
$mysqli->set_charset("utf8"); # Permet d'afficher les accents

// Si on vient d'un formulaire
if(isset($_POST["login"])) {

    $login = $_POST["login"];
    $password = $_POST["password"];
    $sql= "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'";
    $resultat = mysqli_query($mysqli, $sql);
    // Est-ce qu'il y a un user dans la BDD ?
    if(mysqli_num_rows($resultat) == 1) {
      // OUI : création de la session, redirection vers profil
      session_start();
      $tableau = mysqli_fetch_assoc($resultat);
      $_SESSION["id"] = $tableau["id"]; # Assigne l'id de la table Utilisateurs dans la session
      $_SESSION["login"] = $login;
      $_SESSION["password"] = $password;
      header("Location:profil.php");
    } else {
      // NON : on affichera un message d'erreur
      $erreur = 1;
    }
}
?>



<!DOCTYPE html>
<html>
    <head>
      <title>Connexion</title>
      <link rel="stylesheet" href="form.css"/>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style.css">
    </head>

    <body>
      <?php include("header.php"); ?>
      <main>
        <h1> Se connecter </h1>

        <div class="container">

        <form action="connexion.php" method="POST" name="connexion">
          <?php
          if (isset($erreur)){
            echo "Ce compte n'existe pas ou le mot de passe est incorrect.";
          }
          ?>
      	  <div>
          	<label for="login"><b> Login:</b></label><br />
          	<input type="text" id="login" name="login">
     		  </div>

          <div>
          	<label for="password"><b> Mot de passe:</b></label><br />
          	<input type="password" name="password">
            <div class="clearfix">
              <button type="submit" class="signupbtn">Valider</button>
            </div>
        </form>

      </main>
    </body>
</html>
