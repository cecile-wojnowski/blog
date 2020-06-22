<?php

$bdd = new PDO('mysql:host=localhost;dbname=blog','root', '');

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
  <?php include("header.php"); ?>

</header>
<body>

<div class="options">

	<h1>ADMIN</h1>
	<p>Vous êtes sur la page admin vous avez plusieurs possibilités :</p>

	<h3> <a href="admin.php?utilisateurs"> Utilisateurs </a></h3>

<?php

if(isset($_GET['utilisateurs'])){

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
			 $sql='SELECT * FROM utilisateurs';
			 $params=[];
			 if(isset($_POST['recherche_valeur'])){
				 $sql.=' where login like :login';
				 $params[':login']="%".addcslashes($_POST['recherche_valeur'],'_')."%";
			 }
			 $resultats=$bdd->prepare($sql);
			 $resultats->execute($params);
			 if($resultats->rowCount()>0){
				 while($d=$resultats->fetch(PDO::FETCH_ASSOC)){
				 ?>
					 <tr><td><?=$d['login']?></td><td><?=$d['email']?></td>
						 <td><?=$d['id']?></td><td><?=$d['id_droits']?></td>
						 <td><a href="admin.php?utilisateurs&modifier_compte=<?php echo $d['id'] ?>">modifier</a></td>
						 <td><a href="">supprimer</a></td>
						 <td><a href="">changer les droits</a></td><tr>
				 <?php
				 }
				 $resultats->closeCursor();
			 }
			 else echo '<tr><td colspan=4>aucun résultat trouvé</td></tr>'.
			 $connect=null;

		 ?>

	 </tbody>
 </table



		<button class="button">   <a href="admin.php?utilisateurs&new_compte">ajouter un utilisateur</a></button>

		<?php if(isset($_GET['new_compte'])){ ?>

			<form class="" action="admin.php" method="post" name="ajouter">
				<table border="0" align="center" cellspacing="2" cellpadding="2">
					<thead>
						<center>Nouvel utilisateur</center>
					</thead>
			     <tr align="center">
			       <td>login</td>
			       <td><input type="text" name="login"></td>
			     </tr>

					 <tr align="center">
			       <td>email</td>
			       <td><input type="text" name="email"></td>
			     </tr>

			     <tr align="center">
			       <td>password</td>
			       <td><input type="password" name="password"></td>
			     </tr>
					 <tr align="center">
			       <td>confirmer password</td>
			       <td><input type="password" name="confirm_password"></td>
			     </tr>
					 <input type="hidden" id="id_droits" name="id_droits" value="1">

			     <tr align="center">
			       <td colspan="2"><input type="submit" value="ajouter"></td>
			     </tr>
			   </table>


			</form>

			<?php
			if(isset($_POST["ajouter"])){
			if(isset($_POST["login"])) {
			  if($_POST["password"] != $_POST["confirm_password"]) {

			    header('Location: inscription.php?erreur=1');
			  } else {
			    $mysqli = mysqli_connect("127.0.0.1", "root", "", "blog"); # Connexion à la base de données
			    $mysqli->set_charset("utf8"); # Permet d'afficher les accents

			    $login = $_POST['login'] ;
			    $password = $_POST['password'];
			    $email= $_POST['email'];
			    $id_droits = $_POST['id_droits'];
			    $passcrypt = password_hash($password, PASSWORD_BCRYPT);

			$sql = "INSERT INTO utilisateurs(login, password, email, id_droits)
			        VALUES('$login', '$passcrypt', '$email', '$id_droits')";

			    # Exécution de la requête :
			    if ($mysqli->query($sql) === TRUE) {
echo "nouvel utilisateur ajouté";

			    } else {
			      echo "Erreur: " . $sql . "<br>" . $mysqli->error;
			    }
			  }
			}
		}
	}
}

if(isset($_GET['modifier_compte'])){

		  $id  = $_GET["modifier_compte"] ;

		  $sql = "SELECT *
		            FROM utilisateurs
			    WHERE id = ".$id ;

		  $requete = mysql_query( $sql, $bdd ) ;

		  //affichage des données:
		  if( $result = mysql_fetch_object( $requete ) )
		  {
		  ?>

			<form name="insertion" action="modification3.php" method="POST">
  <input type="hidden" name="id" value="<?php echo($id) ;?>">
  <table border="0" align="center" cellspacing="2" cellpadding="2">
    <tr align="center">
      <td>login</td>
      <td><input type="text" name="nom" value="<?php echo($result->login) ;?>"></td>
    </tr>
    <tr align="center">
      <td>mail</td>
      <td><input type="text" name="prenom" value="<?php echo($result->email) ;?>"></td>
    </tr>
    <tr align="center">
      <td>id_droits</td>
      <td><input type="text" name="telephone" value="<?php echo($result->id_droits) ;?>"></td>
    </tr>
    <tr align="center">
      <td colspan="2"><input type="submit" value="modifier"></td>
    </tr>
  </table>
</form>

<<?php } }?>



<h3> <a href="admin.php?articles">Articles</a></h3>

<?php if(isset($_GET['articles'])) { ?>

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
<?php } ?>


<div class="btn-group2">

<h3> <a href="admin.php?commentaires"> Commentaires </a></h3>

<?php if(isset($_GET['commentaires'])) { ?>


<button class="button">  Pour modifier un commentaire <a href="admin.php?modifier_comment">cliquez ici</a></button>
<br>
<button class="button">Pour supprimer un commentaire <a href="admin.php?new_comment">cliquez ici</a></button>
<br>
<button class="button"> Pour supprimer un commentaire <a href="admin.php?supprimer_comment">cliquez ici</a> </button>
</div>
</div>

<?php } ?>



</body>
</html>
