<?php
session_start();
# Doit contenir un formulaire pré-rempli avec les infos de l'utilisateur

$mysqli = mysqli_connect("127.0.0.1", "root", "", "blog"); # Connexion à la base de données
$mysqli->set_charset("utf8"); # Permet d'afficher les accents

$login = $_SESSION["login"];
$password = $_SESSION["password"];
# Requête permettant d'afficher dans le formulaire les infos de l'utilisateur connecté
$sql= "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'";
$resultat = mysqli_query($mysqli, $sql);
?>

 <!DOCTYPE html>
 <html>
     <head>
       <title>Profil</title>
       <link rel="stylesheet" href="css/form.css"/>
       <meta charset="utf-8">
     </head>

     <body>
       <?php include("includes/header.php"); ?>
       <main>
         <h1> Votre profil </h1>
         <p class="p_profil"> Le formulaire ci-dessous est pré-rempli avec vos informations actuelles.
            Si vous désirez les changer, vous pouvez entrer directement votre nouveau login et/ou mot de passe,
          puis valider en cliquant sur le bouton "Modifier le profil".</p>
         <?php
         # Permet la modification des données par l'utilisateur :
         if(isset($_POST["login"])) {
           $new_login = $_POST['login'];
           $ancien_login = $_SESSION['login'];

           $new_password = $_POST['password'];
           $ancien_password = $_SESSION['password'];

           $sql= "UPDATE utilisateurs SET login = '$new_login', password = '$new_password'
           WHERE login = '$ancien_login' AND password = '$ancien_password'";

           $resultat = mysqli_query($mysqli, $sql);

           echo "Vos données ont été modifiées.";
           }
           ?>

         <!-- Formulaire pré-rempli -->
         <form action="profil.php" method="POST" name="profil">
       	  <div>
           	<label for="login"> Login:</label>
           	<input type="text" id="login" name="login" value="<?php if(isset($_POST['login'])){
              echo $_POST['login'];
              $_SESSION['login'] = $_POST['login'];
            } else{
            echo $_SESSION["login"];
          }
            ?> ">
      		</div>

       	  <div>
           	<label for="password"> Mot de passe:</label>
           	<input type="password" name="password" value="<?php if(isset($_POST['password'])){
              echo $_POST['password'];
              $_SESSION['password'] = $_POST['password'];
            }else{
            echo $_SESSION["password"];
            };
            ?>">
           </div>

       	  <button type="submit"> Modifier le profil </button>
      	  </form>
        </main>

        <?php include("includes/footer.php"); ?>
     </body>
   </html>
