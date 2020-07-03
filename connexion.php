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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
    <title>Connexion</title>
  </head>

  <body>
    <header>
      <?php  include('includes/header.php') ?>
    </header>

    <div class="content-connexion">
      <main>
        <h1>Connexion</h1>
        <?php
            if (isset($_SESSION['login']) == false)
            {
              $bdd = mysqli_connect("localhost", "root", "", "blog"); ?>
              <div class="container">

                <form action="connexion.php" method="POST">
                  <p>
                  <div class="row">
                    <div class="style_label">
                      <label for="login">Login</label>
                    </div>
                    <div class="style_input">
                      <input type="text" name="login" id="login" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="style_label">
                      <label for="password">Mot de Passe</label>
                    </div>

                    <div class="style_input">
                      <input type="password" name="password" id="password" required>
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="connexion" class="bouton">Connexion</button>
                  </div>
                  </p>
                </div>
              </form>

        <?php   # Si le formulaire de connexion est rempli...
                if (isset($_POST['connexion']))
                {
                  # On stocke dans des variables les infos provenant du formulaire
                  $login = $_POST['login'];
                  $mdp = $_POST['password'];

                  /* On sélectionne les données de la table login où l'entrée login est identique à
                   la variable provenant du formulaire */
                  $info_log = "SELECT * FROM utilisateurs WHERE login = '$login'";
                  # On exécute la requête et on stocke ce résultat dans $infos_query
                  $info_query = mysqli_query($bdd, $info_log);
                  /* mysqli_fetch_all lit les résultats de $info_query
                  dans le tableau associatif MYSQLI_ASSOC */
                  $infos = mysqli_fetch_all($info_query, MYSQLI_ASSOC);

                  # Si le tableau contenant les résultats de la requête n'est pas vide...
                  # S'il y a au moins un user avec ce login
                  if (!empty($infos))
                  {
                    /* On stocke le mot de passe dans un tableau à deux dimensions,
                    0 étant la première ligne du tableau, c'est-à-dire l'user
                    qui contient la clé password */
                    $mdpbdd = $infos[0]['password'];

                    # Si le mdp est vérifié, on ouvre une session...
                    if (password_verify($mdp, $mdpbdd))
                    {
                      session_start();
                      # Et on stocke les données du tableau dans des variables de session
                      $_SESSION['login'] = $infos[0]['login'];
                      $_SESSION['id'] = $infos[0]['id'];
                      $_SESSION['id_droits'] = $infos[0]['id_droits'];
                      $_SESSION['password'] = $infos[0]['password'];
                      header('location:profil.php');
                    }else{
                      # Si le mdp n'est pas vérifié, on affiche ce message :
                      $message = 'Mot de passe non reconnu.';
                    }
                  }else{
                    # Si $infos est vide, on affiche ce message :
                    $message = 'Ce login n\'existe pas.';
                  }
                }
                mysqli_close($bdd);
            } else {
              # Si on ne passe pas par le formulaire de connexion, c'est qu'une session est ouverte
                $message = 'Vous êtes déjà connecté(e) '.$_SESSION['login'].". <br/>Vous devez choisir ce que vous voulez faire, soit
                créer un événement soit consulter le planning.";
            }
        ?>
        <p class="message">
            <?php echo $message; ?>
        </p>
    </main>
  </div>

  <?php  include('includes/footer.php') ?>

</body>
</html>
