<?php//requête pour modifier les infos via le formulaire

					$servname = "localhost";
			    $dbname = "blog";
			    $user = "root";
			    $pass = "";

			    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);

$req = $dbco ->prepare('UPDATE utilisateurs SET	login = :login,
	password = :password,
	email = :email,
	id_droits = :id_droits WHERE id=:id');

$req->bindValue(':id',$_GET['modifier_compte'], PDO::PARAM_INT);
$req->bindValue(':login',$_POST['login'], PDO::PARAM_INT);
$req->bindValue(':password',$_POST['password'], PDO::PARAM_INT);
$req->bindValue(':email',$_POST['email'], PDO::PARAM_INT);
$req->bindValue(':id_droits',$_POST['id_droits'], PDO::PARAM_INT);

$executereq = $req->execute();

            if ($executereq) {
                echo 'Modification enregistrée';

            }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
