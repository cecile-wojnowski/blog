<?php
$bdd = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

$utilisateurs = $bdd->query('SELECT * FROM utilisateurs articles');

?>

<!DOCTYPE html>
<html>
<head>
	  <link href="style.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <meta charset='utf-8' />
    <title>Admin</title>
</head>
<header>
  <?php include ("header.php"); ?>

</header>
<body>

<div class="options">

	<h1>ADMIN</h1>
	<p>Vous êtes sur la page admin vous avez plusieurs possibilités :</p>

	<h3> <a href="admin.php?utilisateurs"> Utilisateurs </a></h3>

<?php
if (isset($_GET['utilisateurs']))
{

?>


<p>Chercher un utilisateur dans la liste</p>
 <form method='post'>
	 <input type='text' placeholder='recherche' name="recherche_valeur"/>
	 <input type='submit' value="Rechercher"/>
	 <input type='submit' value="Afficher tout utilisateurs"/>

 </form>
 <table>
	 <thead>
		 <tr><th>login</th><th>Email</th><th>Id</th><th>droits</th></</tr>
	 </thead>
	 <tbody>
		 <?php
    $sql = 'SELECT * FROM utilisateurs';
    $params = [];
    if (isset($_POST['recherche_valeur']))
    {
        $sql .= ' where login like :login';
        $params[':login'] = "%" . addcslashes($_POST['recherche_valeur'], '_') . "%";
    }
    $resultats = $bdd->prepare($sql);
    $resultats->execute($params);
    if ($resultats->rowCount() > 0)
    {
        while ($d = $resultats->fetch(PDO::FETCH_ASSOC))
        {
?>
<div class="">
	<tr><td><?=$d['login'] ?></td><td><?=$d['email'] ?></td>
		<td><?=$d['id'] ?></td><td><?=$d['id_droits'] ?></td>
		<td><a href="admin.php?utilisateurs&modifier_compte=<?php echo $d['id'] ?>">modifier</a></td>
		<td><a href="admin.php?utilisateur&supprimer_compte=<?php echo $d['id'] ?>">supprimer</a></td>
</div>

				 <?php
        }
        $resultats->closeCursor();
    }
    else echo '<tr><td colspan=4>aucun résultat trouvé</td></tr>' . $connect = null;


?>

	 </tbody>
 </table

		<button class="button">   <a href="admin.php?utilisateurs&new_compte">ajouter un utilisateur</a></button>


<?php
if(isset($_GET['new_compte'])){

		if(isset($_POST["ajouter"])) {

		    $mysqli = mysqli_connect("127.0.0.1", "root", "", "blog"); # Connexion à la base de données
		    $mysqli->set_charset("utf8"); # Permet d'afficher les accents

		    # Est enregistré dans des variables ce que l'utilisateur entre dans les champs du formulaire
		    $login = $_POST['login'] ;
		    $password = $_POST['password'];
		    $email= $_POST['email'];
		    $id_droits = $_POST['id_droits'];
		    $passcrypt = password_hash($password, PASSWORD_BCRYPT);

		# Requête : insérer dans la table Utilisateurs les données correspondant à ces variables
		$sql2 = "INSERT INTO utilisateurs(login, password, email, id_droits)
		        VALUES('$login', '$passcrypt', '$email', '$id_droits')";
		    # Exécution de la requête :
		    if ($mysqli->query($sql2) === TRUE) {

echo'compte ajouté';
		    } else {
		      echo "Erreur: " . $sql2 . "<br>" . $mysqli->error;
		    }
		  }
		}

		?>

		        <form action="admin.php?utilisateurs&new_compte.php" method="POST" name="new_compte">
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
		                 	    <input type="hidden" id="id_droits" name="id_droits" value="1">
		            		  </div>

											<input type="submit" name="ajouter" value="ajouter">
		        </div>
		   	    </form>

<?php
}



if (isset($_GET['modifier_compte']))
{

    $id = $_GET["modifier_compte"];

    if (isset($_POST['modifier']))
    {

        $login = $_POST['login'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $id_droits = $_POST['id_droits'];

        try
        {

            $bdd = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

            $sql = "UPDATE `utilisateurs` SET `id`=$id,`login`=$login,`password`=$password,`email`=$email,`id_droits`=$id_droits WHERE id=$id";
            $dbco->exec($sql);
            echo 'Modification enregistrée';
        }

        catch(PDOException $e)
        {
            $dbco->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }
?>


			<form name="modification" action="admin.php?utilisateur&modifier_compte" method="POST">
  <input type="hidden" name="id" value="<?php echo ($id); ?>">
  <table border="0" align="center" cellspacing="2" cellpadding="2">
    <tr align="center">
      <td>login</td>
      <td><input type="text" name="login" value="<?php ?>"></td>
    </tr>
    <tr align="center">
      <td>mail</td>
      <td><input type="text" name="email" value="<?php ?>"></td>
    </tr>
    <tr align="center">
      <td>id_droits</td>
<td>
			<select name="id_droits" id="id_droits" form="modification">
			  <option value="1">utilisateur</option>
			  <option value="42">modérateur</option>
			  <option value="1337">admin</option>
</td>
    </tr>
		<tr align="center">
			<td>password</td>
			<td><input type="password" name="password" value=""></td>
		</tr>
    <tr align="center">
      <td colspan="2"><input type="submit" value="modifier"></td>
    </tr>
  </table>
</form>

<?php
} ?>

<?php if (isset($_GET['supprimer_compte']))
{

    $servname = "localhost";
    $dbname = "blog";
    $user = "root";
    $pass = "";

    try
    {
        $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);

        $id = $_GET["supprimer_compte"];
        $req = $dbco->prepare("DELETE FROM utilisateurs WHERE id = $id");
        $req->execute();
        echo 'Utilisateur supprimé';
        $delai = 1;
        $url = 'admin.php?utilisateur';
        header("Refresh: $delai;url=$url");

    }

    catch(PDOException $e)
    {
        echo "Erreur : " . $e->getMessage();

    }

}

?>





<h3> <a href="admin.php?articles">Articles</a></h3>

<?php if (isset($_GET['articles']))
{ ?>

<div class="btn-group2">

<button class="button">  Pour modifier un article <a href="admin.php?modifier_article">cliquez ici</a></button>
<br>
<button class="button"> Pour supprimer un article <a href="admin.php?new_article">cliquez ici</a></button>
<br>
<button class="button"> Pour supprimer un article <a href="admin.php?supprimer_article">cliquez ici</a> </button>

<button class="button">  Pour supprimer une catégorie <a href="admin.php?supprimer_categorie">cliquez ici</a></button>

<button class="button">Pour modifier une catégorie <a href="admin.php?modifier_categorie">cliquez ici</a> </button>

<button class="button"> Pour créer une catégorie <a href="admin.php?new_categorie">cliquez ici</a> </button>
</div>
<?php
} ?>


<div class="btn-group2">

<h3> <a href="admin.php?commentaires"> Commentaires </a></h3>

<?php if (isset($_GET['commentaires']))
{
} ?>


<button class="button">  Pour modifier un commentaire <a href="admin.php?modifier_comment">cliquez ici</a></button>
<br>
<button class="button">Pour supprimer un commentaire <a href="admin.php?new_comment">cliquez ici</a></button>
<br>
<button class="button"> Pour supprimer un commentaire <a href="admin.php?supprimer_comment">cliquez ici</a> </button>
</div>
</div>




</body>
</html>
