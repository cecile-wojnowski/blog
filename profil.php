<?php

$mysqli = mysqli_connect("127.0.0.1", "root", "", "blog"); # Connexion à la base de données
$mysqli->set_charset("utf8"); # Permet d'afficher les accents

?>

 <!DOCTYPE html>
 <html>
     <head>
       <title>Profil</title>
       <link rel="stylesheet" href="style.css"/>
       <link rel="stylesheet" href="form.css">
       <meta charset="utf-8">
     </head>

     <body>
       <?php include("header.php");
          if (isset($_SESSION['login'])){

            $login = $_SESSION["login"];
            $password = $_SESSION["password"];
            # Requête permettant d'afficher dans le formulaire les infos de l'utilisateur connecté
            $sql= "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'";
            $resultat = mysqli_query($mysqli, $sql);?>
       <main>
         <h1> Votre profil </h1>
         <div class="container">

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

           if(isset($_GET['supprimer'])){
             if($_GET['supprimer']!="ok"){
                 echo "<p>Tu es sûr de vouloir supprimer ce compte définitivement?</p>
                 <br>
                 <h2></p><a href='profil.php?supprimer=ok' style='color:red'>OUI</a> <a href='profil.php' style='color:green'>NON</a></h2>";
             } else {
                 if(mysqli_query($mysqli,"DELETE FROM utilisateurs WHERE pseudo='$login'")){
                     echo "Ton compte vient d'être supprimé pour toujours.";
                     unset($_SESSION['login']);
                 } else {
                     echo "Il y a une erreur quelque part ...";
                 }
             }
         }
           ?>

         <!-- Formulaire pré-rempli -->
         <form action="profil.php" method="POST" name="profil">
       	  <div>
           	<label for="login"> Login:</label><br />
           	<input type="text" id="login" name="login" value="<?php if(isset($_POST['login'])){
              echo $_POST['login'];
              $_SESSION['login'] = $_POST['login'];
            } else{
            echo $_SESSION["login"];
          }
            ?> ">
      		</div>

       	  <div>
           	<label for="password"> Mot de passe:</label><br />
           	<input type="password" name="password" values="<?php if(isset($_POST['password'])){
              echo $_POST['password'];
              $_SESSION['password'] = $_POST['password'];
            }else{
            echo $_SESSION["password"];
            };
            ?>">
           </div>

       	  <button type="submit"> Modifier le profil </button>

        </form>
        </div>

        </main>
<?php }

else {

echo "<br /><center>vous ne pouvez pas accéder à cette page sans être connecté(e)"."<a href='connexion.php'> me connecter</a> ou alors <a href='inscription.php'> m'inscrire </a></center>";


}?>
</body>
   </html>
