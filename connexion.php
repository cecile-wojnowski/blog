<?php
    if (isset($_GET['deconnexion'])) {
        unset($_SESSION['login']);
        //au bout de 2 secondes redirection vers la page d'accueil
        header("Refresh: 1; url=index.php");

        echo "<p>Vous avez été déconnecté</p><br><p>Redirection vers la page d'accueil...</p>";
    }

  $message = "";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">

    <title>Connexion</title>
</head>
<body>
<header>
  <?php include("header.php"); ?>

</header>
<center>
  <div class="container_connexion">


<div class="content-connexion">

    <main>
      <h1>Connexion</h1>
        <?php
            if (isset($_SESSION['login']) == false) {
                $bdd = mysqli_connect("localhost", "root", "", "blog"); ?>
        <div class="container">
<center>
                <form action="" method="POST" >
                    <p>
<div class="row">


                        <label for="login">Login</label>
  <input type="text" name="login" id="login" required><br />

</div>

<div class="row">

  <label for="password">Mot de Passe</label>

  <input type="password" name="password" id="password" required>


</div>
  <button type="submit" name="connexion" class="bouton">Connexion</button>
</div>
                    </p>

                </form>
                </div>
              </center>

        <?php
                if (isset($_POST['connexion'])) {
                    $login = $_POST['login'];
                    $mdp = $_POST['password'];

                    $info_log = "SELECT * FROM utilisateurs WHERE login = '$login'";
                    $info_query = mysqli_query($bdd, $info_log);
                    $infos = mysqli_fetch_all($info_query, MYSQLI_ASSOC);

                    $mdpbdd = $infos[0]['password'];

                    if (!empty($infos)) {
                        if (password_verify($mdp, $mdpbdd)) {
                            session_start();
                            $_SESSION['login'] = $infos[0]['login'];
                            $_SESSION['id'] = $infos[0]['id'];
                            $_SESSION['email'] = $infos[0]['email'];
                            $_SESSION['id_droits'] = $infos[0]['id_droits'];
                            $_SESSION['password'] = $infos[0]['password'];
                            header('location:profil.php');
                        } else {
                            $message = 'mot de passe non reconnu';
                        }
                    } else {
                        $message = 'nous ne connaissons pas ce login';
                    }
                }
                mysqli_close($bdd);
            } else {
                $message = 'Vous êtes déjà connecté(e) '.$_SESSION['login'].". <br/>Vous devez choisir ce que vous voulez faire, soit
                créer un événement soit consulter le planning.";
            }
        ?>
        <p class="message">
            <?php echo $message; ?>
        </p>
    </main>
  </div>
</center>
  <?php include("footer.php");
   ?>

</body>
</html>
