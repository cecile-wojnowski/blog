<?php
$bdd = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

$utilisateurs = $bdd->query('SELECT * FROM utilisateurs articles');

?>

<!DOCTYPE html>
<html>
	<head>
		<link href="css/style.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
	  <meta charset='utf-8' />
	  <title>Admin</title>
	</head>
	<header>
  	<?php include("includes/header.php"); ?>
	</header>

	<body>
		<div class="container_admin">
			<?php if (isset($_SESSION['login'])) { ?>
		<div class="options">
			<div class="admin">
				<h1> ADMIN</h1>
				<p>Vous êtes sur la page admin vous avez plusieurs possibilités :</p>
			</div>
			<h3> <a href="admin.php?utilisateurs"> Utilisateurs </a></h3>
			<?php
			if (isset($_GET['utilisateurs'])) {
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
				    if (isset($_POST['recherche_valeur'])) {
				        $sql .= ' where login like :login';
				        $params[':login'] = "%" . addcslashes($_POST['recherche_valeur'], '_') . "%";
				    }
				    $resultats = $bdd->prepare($sql);
				    $resultats->execute($params);
				    if ($resultats->rowCount() > 0) {
				        while ($d = $resultats->fetch(PDO::FETCH_ASSOC)) {
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
	    			} else {
	        	echo '<tr><td>aucun résultat trouvé</td></tr>' . $connect = null;
	    			} ?>
	 				</tbody>
 				</table>
				<button class="button"><a href="admin.php?utilisateurs&new_compte">Ajouter un utilisateur</a></button>


				<?php //créer un compte
				if (isset($_GET['new_compte'])) {
				    if (isset($_POST["ajouter"])) {
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
				        if ($mysqli->query($sql2) === true) {
				            echo'compte ajouté';
				        } else {
				            echo "Erreur: " . $sql2 . "<br>" . $mysqli->error;
				        }
				    } ?>

		        <form action="admin.php?utilisateurs&new_compte" method="POST" name="new_compte">
		          <?php
                  if (isset($_GET['erreur'])) {
                      echo "Veuillez confirmer votre mot de passe.";
                  } ?>
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
						</form>
		</div>

			<?php //modifier un compte
			}
			}


			if (isset($_GET['modifier_compte'])) {
			    $pdoselect = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = :id');

			    $pdoselect ->bindValue(':id', $_GET['modifier_compte'], PDO::PARAM_INT);

			    $executepdo= $pdoselect->execute();

			    $info= $pdoselect->fetch();

			    if (isset($_POST['modifier'])) {
			        $login2= $_POST['login'];
			        $password2= $_POST['password'];
			        $email2=$_POST['email'];
			        $id_droits2=$_POST['id_droits'];
			        $id= $_GET['modifier_compte'];
			        $req = $bdd->prepare('UPDATE utilisateurs SET login = :login, password = :password, email = :email, id_droits = :id_droits WHERE id = :id');
			        $req->execute(array(
			    'login' => $login2,
			    'password' => $password2,
			    'email' => $email2,
			    'id_droits' => $id_droits2,
			    'id' => $id
			    ));

        if ($req) {
            echo 'Modification enregistrée';
            header("location: admin.php?utilisateurs");
        }
    } ?>


			<form name="modification" action="" method="POST">
				<table border="0" align="center" cellspacing="2" cellpadding="2">
					<tr align="center">
					<td>login</td>
						<td><input type="text" name="login" value="<?php echo $info['login']; ?>"></td>
					</tr>
					<tr align="center">
					<td>mail</td>
					<td><input type="text" name="email"value="<?php echo $info['email'] ; ?>"></td>
					</tr>
					<tr align="center">
					<td>id_droits</td>
					<td>
					<select name="id_droits" id="id_droits">
						<option value="1">utilisateur</option>
						<option value="42">modérateur</option>
						<option value="1337">admin</option>
					</td>
					</tr>
					<tr align="center">
					<td>password</td>
					<td><input type="password" name="password" value="<?php echo $info['password'] ?>"></td>
					</tr>
					<tr align="center">
					<td><input name="modifier" type="submit" value="modifier"></td>
					</tr>
				</table>
			</form>

<?php
}
?>

<?php //supprimer un compte
 if (isset($_GET['supprimer_compte'])) {
     try {
         $id = $_GET["supprimer_compte"];
         $req = $bdd->prepare("DELETE FROM utilisateurs WHERE id = $id");
         $req->execute();
         echo 'Utilisateur supprimé';
         $delai = 1;
         $url = 'admin.php?utilisateur';
         header("Refresh: $delai;url=$url");
     } catch (PDOException $e) {
         echo "Erreur : " . $e->getMessage();
     }
 }

?>
<?php // WARNING: FIN DE LA ZONE UTILISATEUR?>



<?php // WARNING: DEBUT DE LA ZONE ARTICLES>?>

<div>
	<h3> <a href="admin.php?articles">Articles</a></h3>
</div>
<?php if (isset($_GET['articles'])) { ?>


	<p>Chercher un article dans la liste avec le titre</p>
	 <form method='post'>
		 <input type='text' placeholder='recherche' name="recherche_valeur"/>
		 <input type='submit' value="Rechercher"/>
		 <input type='submit' value="Afficher tout les articles"/>
	 </form>

	 <table>
		 <thead>
			 <tr><th>Titre</th><th>Date de création</th><th>Id</th><th>Catégorie</th></</tr>
		 </thead>
		 <tbody>
			 <?php
        $sql = 'SELECT * FROM articles';
        $params = [];
        if (isset($_POST['recherche_valeur'])) {
            $sql .= ' where titre like :titre';
            $params[':titre'] = "%" . addcslashes($_POST['recherche_valeur'], '_') . "%";
        }
        $resultats = $bdd->prepare($sql);
        $resultats->execute($params);
        if ($resultats->rowCount() > 0) {
            while ($d = $resultats->fetch(PDO::FETCH_ASSOC)) {
                ?>
				<div class="">
					<tr><td><?=$d['titre'] ?></td><td><?=$d['date'] ?></td>
					<td><?=$d['id'] ?></td><td><?=$d['id_categorie'] ?></td>
					<td><a href="admin.php?article&modifier_article=<?php echo $d['id'] ?>">modifier</a></td>
					<td><a href="admin.php?article&supprimer_article=<?php echo $d['id'] ?>">supprimer</a></td>
				</div>

					<?php
            }
            $resultats->closeCursor();
        } else {
            echo '<tr><td>aucun résultat trouvé</td></tr>' . $connect = null;
        }
    ?>
		</tbody>
	 </table>

			<button class="button">   <a href="creer-article.php">ajouter un article</a></button>
			<button class="button">   <a href="admin.php?articles&categorie">ajouter une catégorie</a></button>

	<?php
    }

if (isset($_GET['categorie'])) {

//connexion à la base de donnée
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    if (isset($_POST['creer'])) {
        $id_categorie=$_POST['id'];
        $nom_categorie=$_POST['nom_categorie'];

        $bdd->exec("INSERT INTO `categories`(`id`, `nom`) VALUES ( '$id_categorie','$nom_categorie')");

        echo 'la catégorie a été ajoutée';
    }
    //req pour ajouter la catégorie dans la base de donnée
?>

<form name="creer_categorie" class="" action="" method="post">
	<label for="">Nom de la catégorie</label>
	<input type="text" name="nom_categorie" value="">
	<label for="">Numéro de la catégorie</label>
	<input type="number" name="id" value="insérer le numéro de la catégorie" max="50" min="1">
	<input type="submit" name="creer" value="créer">
</form>

<?php
}

                if (isset($_GET['modifier_article'])) {
                    $pdoselect2 = $bdd->prepare('SELECT * FROM articles WHERE id= :id');

                    $pdoselect2 ->bindValue(':id', $_GET['modifier_article'], PDO::PARAM_INT);

                    $executepdo2= $pdoselect2->execute();

                    $info2= $pdoselect2->fetch();

                    if (isset($_POST['modifier'])) {
                        $titre2= $_POST['titre'];
                        $article2= $_POST['article'];
                        $id_categorie2=$_POST['id_categorie'];
                        $date2=$_POST['date'];
                        $id2= $_GET['modifier_article'];

                        $req2 = $bdd->prepare('UPDATE articles SET titre = :titre, article = :article, id_categorie = :id_categorie, date = :date WHERE id = :id');
                        $req2->execute(array(
                    'titre' => $titre2,
                    'article' => $article2,
                    'id_categorie' => $id_categorie2,
                    'date' => $date2,
                    'id' => $id2
                    ));


                        if ($req2) {
                            echo 'Modification enregistrée';

                            header("location: admin.php?articles");
                        }
                    }

                    // requête pour pré-remplir le formulaire de modification


                     ?>

										<form name="modification_article" action="" method="POST">
										<table border="0" align="center" cellspacing="2" cellpadding="2">
										<tr align="center">
										<td>titre</td>
											<td><input type="text" name="titre" value="<?php echo $info2['titre'] ?>"></td>
										</tr>
										<tr align="center">
										<td>contenu</td>
										<td><textarea  id="article" name="article"placeholder="<?php echo $info2['article'] ?>"></textarea></td>
										</tr>
										<tr align="center">
										<td>date</td>
										<td><input type="datetime" name="date"value="<?php echo $info2['date'] ?>"></td>
										</tr>
										<tr align="center">
										<td>catégorie</td>
										<td><input type="textarea" name="id_categorie"value="<?php echo $info2['id_categorie'] ?>"></td>
										</tr>
										<tr align="center">

										</tr>

										<tr align="center">
										<td><input name="modifier" type="submit" value="modifier"></td>
										</tr>
										</table>
										</form>
	<?php
                } ?>

	<?php if (isset($_GET['supprimer_article'])) {
                    try {
                        $id = $_GET["supprimer_article"];
                        $req = $bdd->prepare("DELETE FROM articles WHERE id = $id");
                        $req->execute();
                        echo 'Article supprimé';
                        $delai = 1;
                        $url = 'admin.php?articles';
                        header("Refresh: $delai;url=$url");
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
    ?>

	<?php // WARNING: FIN DE LA ZONE ARTICLE?>


	<?php // WARNING: DEBUT DE LA ZONE COMMENTAIRES>?>

	<div>
		<h3> <a href="admin.php?commentaires"> Commentaires </a></h3>
	</div>
	<?php if (isset($_GET['commentaires'])) {
  ?>
<div class="btn-group2">
	<p>Chercher un commentaire à partir d'un mot</p>
	 <form method='post'>
		 <input type='text' placeholder='recherche' name="recherche_valeur"/>
		 <input type='submit' value="Rechercher"/>
		 <input type='submit' value="Afficher tout les commentaires"/>
	 </form>

	 <table>
		 	<thead>
			 	<tr><th>Commentaire</th><th>Date de création</th><th>ID</th><th>Utilisateur</th></tr>
		 	</thead>

		 	<tbody>
			 	<?php
        $sql = 'SELECT * FROM commentaires';
        $params = [];
        if (isset($_POST['recherche_valeur'])) {
            $sql .= ' where titre like :commentaire';
            $params[':titre'] = "%" . addcslashes($_POST['recherche_valeur'], '_') . "%";
        }
        $resultats = $bdd->prepare($sql);
        $resultats->execute($params);
        if ($resultats->rowCount() > 0) {
            while ($d = $resultats->fetch(PDO::FETCH_ASSOC))
						{
                ?>

							<div class="">
								<tr><td><?=$d['commentaire'] ?></td><td><?=$d['date'] ?></td>
									<td><?=$d['id'] ?></td><td><?=$d['id_utilisateur'] ?></td>
									<td><a href="admin.php?commentaires&modifier_commentaire=<?php echo $d['id'] ?>">modifier</a></td>
									<td><a href="commentaires&supprimer_commentaire=<?php echo $d['id'] ?>">supprimer</a></td>
							</div>


							<?php

			    		//connexion à la base de donnée
			        try {
			            $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
			        } catch (Exception $e) {
			            die('Erreur : '.$e->getMessage());
			        }

              if (isset($_GET['modifier_commentaire']))
							{
                  if (isset($_POST['modifier'])) {
                    $commentaire3= $_POST['commentaire'];
                    $date3= $_POST['date'];
                    $id3= $_GET['modifier_commentaire'];

                    $req3 = $bdd->prepare('UPDATE  SET commentaire = :commentaire, date = :date, WHERE id = :id');
                    $req3->execute(array(
                    'commentaire' => $commentaire3,
                    'date' => $date3,
                    'id' => $id3,));

                    if ($req3)
										{
                      echo 'Modification enregistrée';
                      header("location: admin.php?commentaires");
                    }
                    } else {
                      // requête pour pré-remplir le formulaire de modification
                      $pdoselect3 = $bdd->prepare('SELECT * FROM commentaires WHERE id= :id');
                      $pdoselect3 ->bindValue(':id', $_GET['modifier_commentaire'], PDO::PARAM_INT);
                      $executepdo3= $pdoselect3->execute();
                      $info3= $pdoselect3->fetch();
                    } ?>




										<form name="modification_commentaire" action="" method="POST">
											<table border="0" align="center" cellspacing="2" cellpadding="2">
												<tr align="center">
												<td>commentaire</td>
													<td><input type="text" name="titre" value="<?php echo $info3['commentaire'] ?>"></td>
												</tr>

												<tr align="center">
												<td>date</td>
												<td><input type="datetime" name="date"value="<?php echo $info3['date'] ?>"></td>
												</tr>
												<tr align="center">

												</tr>

												<tr align="center">
												<td><input name="modifier" type="submit" value="modifier"></td>
												</tr>
											</table>
										</form>
		<?php
                } ?>

		<?php if (isset($_GET['supprimer_commentaire']))
								{
                    try {
                        $id = $_GET["supprimer_article"];
                        $req = $bdd->prepare("DELETE FROM commentaire WHERE id = $id");
                        $req->execute();
                        echo 'Article supprimé';
                        $delai = 1;
                        $url = 'admin.php?articles';
                        header("Refresh: $delai;url=$url");
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
            }
        }
    }
    } else {
        echo "<br /><center> Bien essayé, mais vous ne pouvez pas accéder à cette page !"."<a href='connexion.php'> me connecter</a> ou alors <a href='inscription.php'> m'inscrire </a></center>"; ?>

<img src="philo5.gif" alt="">

<?php
    }
      ?>
		</tbody>
	</table>
	</div>
</div>
		<footer>
			<?php include('includes/footer.php');  ?>
		</footer>

</body>
</html>
