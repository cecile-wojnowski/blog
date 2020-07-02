

<?php
$bdd = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

$utilisateurs = $bdd->query('SELECT * FROM utilisateurs articles');

?>



  <?php if (isset($_SESSION['login'])){ ?>

    <?php

//rechercher un utilisateur
    if (isset($_GET['utilisateurs'])) {
        ?>
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

               <?php
              }
              $resultats->closeCursor();
          } else {
              echo '<tr><td>aucun résultat trouvé</td></tr>' . $connect = null;
          } ?>



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


              <?php //modifier un compte
              }
              }


              if (isset($_GET['modifier_compte'])) {
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
                          echo 'Modification enregistrée';
                          $delai = 1;
                          $url = 'admin.php?utilisateur';
                          //header("Refresh: $delai;url=$url");


                  }

                      // requête pour pré-remplir le formulaire de modification

                      $pdoselect = $bdd->prepare('SELECT * FROM utilisateurs WHERE id= :id');

                      $pdoselect ->bindValue(':id', $_GET['modifier_compte'], PDO::PARAM_INT);

                      $executepdo= $pdoselect->execute();

                      $info= $pdoselect->fetch();
                   ?>

                   <?php
                   }
                   ?>


                   <?php
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

                   <?php if (isset($_GET['articles'])) { ?>
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
                          <tr><td><?=$d['login'] ?></td><td><?=$d['email'] ?></td>
                            <td><?=$d['id'] ?></td><td><?=$d['id_droits'] ?></td>
                              <td><a href="admin.php?utilisateurs&modifier_compte=<?php echo $d['id'] ?>">modifier</a></td>
                            <td><a href="admin.php?utilisateur&supprimer_compte=<?php echo $d['id'] ?>">supprimer</a></td>
                        </div>


                              <?php
                              }

                                              if (isset($_GET['modifier_article'])) {
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
                                                          $delai = 11;
                                                          $url = 'admin.php?articles';
                                                          header("Refresh: $delai;url=$url");
                                                      }
                                                  } else {

                                                      // requête pour pré-remplir le formulaire de modification

                                                      $pdoselect2 = $bdd->prepare('SELECT * FROM articles WHERE id= :id');

                                                      $pdoselect2 ->bindValue(':id', $_GET['modifier_article'], PDO::PARAM_INT);

                                                      $executepdo2= $pdoselect2->execute();

                                                      $info2= $pdoselect2->fetch();
                                                  } ?>


                                                  <?php
                                                   }
                                                   $resultats->closeCursor();
                                               } else {
                                                   echo '<tr><td>aucun résultat trouvé</td></tr>' . $connect = null;
                                               }


                                           ?>

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

                                            <?php if (isset($_GET['commentaires'])) {
                                                    ?>
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
                                                         while ($d = $resultats->fetch(PDO::FETCH_ASSOC)) {
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

                                                          if (isset($_GET['modifier_commentaire'])) {
                                                              if (isset($_POST['modifier'])) {
                                                                  $commentaire3= $_POST['commentaire'];
                                                                  $date3= $_POST['date'];
                                                                  $id3= $_GET['modifier_commentaire'];

                                                                  $req3 = $bdd->prepare('UPDATE  SET commentaire = :commentaire, date = :date, WHERE id = :id');
                                                                  $req3->execute(array(
                                                                  'commentaire' => $commentaire3,
                                                                  'date' => $date3,
                                                                  'id' => $id3,
                                                                  ));


                                                                  if ($req3) {
                                                                      echo 'Modification enregistrée';
                                                                      $delai = 11;
                                                                      $url = 'admin.php?commentaires';
                                                                      header("Refresh: $delai;url=$url");
                                                                  }
                                                              } else {

                                                                      // requête pour pré-remplir le formulaire de modification

                                                                  $pdoselect3 = $bdd->prepare('SELECT * FROM commentaires WHERE id= :id');

                                                                  $pdoselect3 ->bindValue(':id', $_GET['modifier_commentaire'], PDO::PARAM_INT);

                                                                  $executepdo3= $pdoselect3->execute();

                                                                  $info3= $pdoselect3->fetch();
                                                              } ?>



                                                              <?php
                                                                          } ?>

                                                              <?php if (isset($_GET['supprimer_commentaire'])) {
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
                                                            }


                                                            else {

                                                              echo "<br /><center> Bien essayé, mais vous ne pouvez pas accéder à cette page !"."<a href='connexion.php'> me connecter</a> ou alors <a href='inscription.php'> m'inscrire </a></center>";
                                                          ?>

                                                          <?php	}
                                                                  ?>
