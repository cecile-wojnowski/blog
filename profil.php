<?php

$mysqli =mysqli_connect("127.0.0.1", "root", "", "blog"); # Connexion à la base de données
$mysqli->set_charset("utf8"); # Permet d'afficher les accents

if (mysqli_connect_errno()) {
    printf("Échec de la connexion : %s\n", mysqli_connect_error());
    exit();
}

?>

 <!DOCTYPE html>
 <html>
     <head>
       <title>Profil</title>
       <link rel="stylesheet" href="css/style.css"/>
       <link rel="stylesheet" href="css/form.css">
       <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">

       <meta charset="utf-8">
     </head>

     <body>
       <?php include("includes/header.php");
          if (isset($_SESSION['login'])) {

              $login = $_SESSION["login"];
              # Requête permettant d'afficher dans le formulaire les infos de l'utilisateur connecté
              $sql= "SELECT * FROM utilisateurs WHERE login = '$login' ";
              $query = mysqli_query($mysqli, $sql);
              $resultat= mysqli_fetch_all($query, MYSQLI_ASSOC);
  ?>
       <main>
         <h1> Votre profil </h1>
         <center><div class="container">

         <p class="p_profil"> Le formulaire ci-dessous est pré-rempli avec vos informations actuelles.
            Si vous désirez les changer, vous pouvez entrer directement votre nouveau login et/ou mot de passe,
          puis valider en cliquant sur le bouton "Modifier le profil".</p>
         <?php

         # Permet la modification des données par l'utilisateur :
         if (isset($_POST["login"])) {
             $new_login = $_POST['login'];
             $ancien_login = $_SESSION['login'];

             $new_password =  password_hash($_POST['password'], PASSWORD_BCRYPT);
             $ancien_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
             $ancien_email = $_SESSION['email'];
             $new_email = $_POST['email'];

             $sql= "UPDATE utilisateurs SET login = '$new_login', password = '$new_password', email= '$new_email'
           WHERE login = '$ancien_login'";

             $query = mysqli_query($mysqli, $sql);
             echo "Vos données ont été modifiées.";

             var_dump($query);
         }
               ?>

         <!-- Formulaire pré-rempli -->
         <form action="profil.php" method="POST" name="profil">
       	  <div>
           	<label for="login"> Login:</label><br />
           	<input type="text" id="login" name="login" value="<?php if (isset($_POST['login'])) {
                  echo $_POST['login'];
                  $_SESSION['login'] = $_POST['login'];
              } else {
                  echo $_SESSION["login"];
              } ?>" required>
      		</div>

       	  <div>
           	<label for="password"> Nouveau mot de passe</label><br />
           	<input type="password" name="password" value="<?php if (isset($_POST['password'])) {
                  echo password_hash($_POST['password'], PASSWORD_BCRYPT);
                  $_SESSION['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
              } else {
                  echo $_SESSION["login"];
              } ?> " required>
           </div>

           <div>
             <label for="email"> Email:</label><br />
             <input required type="email" name="email" value="<?php if (isset($_POST['email'])) {
                   echo $_POST['email'];
                   $_SESSION['email'] = $_POST['email'];
               } else {
                   echo $_SESSION["email"];
               } ?> ">
            </div>

       	  <button type="submit"> Modifier le profil </button>
        </form>
      </div>
    </main>
<?php
          } else {
    echo "<br /><center>vous ne pouvez pas accéder à cette page sans être connecté(e)"."<a href='connexion.php'> me connecter</a> ou alors <a href='inscription.php'> m'inscrire </a></center>"; ?>

<center><img src="philo5.gif" alt=""></center>

<?php
}

include("includes/footer.php");

        ?>
</center>

</body>
   </html>
