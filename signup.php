<?php
    session_start();
    if (isset($_SESSION['id'])) {
        header('location:Accueil.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SignUp</title>
    <link rel="icon" href="logo.jpg" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body><?php
	if (!empty($_POST)) {
        require 'functions.php';

		$nom = $_POST["nom"];
		$adresse = $_POST["adresse"];
		$mdp= $_POST["mdp"];

        $valid=true; // true si le formulaire est valide (tous les champs sont remplis)

        // Test username
		if (empty($nom)) {
			$nomErr = "Le nom est obligatoire";
			$valid=false;// si le champ nom est vide alors le formulaire n'est plus valide
		} else if (!preg_match("/^[a-zA-Z ]*$/",$nom)) {    //la vérification est faite en utilisant la notion d'expression réguliaire
			$nomErr = "Seuls les lettres et l'espace sont permis";
			$valid=false;
		} else if (exist_user($nom)) {
            $nomErr = "Username existe déjà";
			$valid=false;
        }
        
        // Test user email
		if (empty($adresse)) {
			$emailErr = "Adresse mail obligatoire";
			$valid=false;// si le champ mail est vide alors le formulaire n'est plus valide
		} else if (!filter_var($adresse, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Format adresse mail invalide";
			$valid=false;
		}
        
        // Test user password
		if (empty($mdp)) {
			$pwdErr = "Mot de passe obligatoire";
			$valid=false;// si le champ mail est vide alors le formulaire n'est plus valide
		} else if (strlen($mdp) < 8) {
			$pwdErr = "Au moins 8 caractères";
			$valid=false;
		}

       
            
		if ($valid) {
            // Insertion dans la Base de données
            require 'connexion1.php';
            $mdp= password_hash ($mdp, PASSWORD_DEFAULT);

            $req = "INSERT INTO users (nom,adresse,mdp) VALUES ('$nom', '$adresse', '$mdp')";
            $rep = $con->exec($req);

            if ($rep) { 
                echo '<div class="alert alert-success" role="alert">';
                echo 'Insertion effectuée avec succès';
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo 'Insertion non effectuée';
                echo '</div>';
            }
		}
	}
	 ?>
    <div class="container">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" class="form-signin" enctype="multipart/form-data">
            <h2 class="form-signin-heading">Inscription</h2><hr />
            <div class="form-group">
                <span class="text-danger"><?php if(isset($nomErr)) echo $nomErr;?></span>
                <input type="text" class="form-control" name="nom" value="<?php if(isset($nom)) echo $nom?>" placeholder="Votre nom d'utilisateur" />
            </div>
            <div class="form-group">
                <span class="text-danger"><?php if(isset($emailErr)) echo $emailErr;?></span>
                <input type="text" class="form-control" name="adresse" value="<?php if(isset($adresse)) echo $adresse?>" placeholder="Votre E-Mail" />
            </div>
            <div class="form-group">
                <span class="text-danger"><?php if(isset($pwdErr)) echo $pwdErr;?></span>
            	<input type="password" class="form-control" name="mdp" placeholder="Votre mot de passe" />
            </div>
            <div class="form-group">
                <label class="control-label" for="userimg">Profile Img</label>
                <span class="text-danger"><?php if(isset($errMSG)) echo $errMSG;?></span>
                <input type="file" class="form-control-file" name="userimg" id="userimg" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	S'inscrire
                </button>
            </div>
            <br />
            <label>Déjà inscrit ! <a href="signin.php">Connexion</a></label>
        </form>
       </div>
</div>
</body>
</html>