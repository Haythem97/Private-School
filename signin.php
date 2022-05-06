<?php
    session_start();
    if (isset($_SESSION['id'])) {
        header('location:Accueil.php');
    }
?>

<?php
	require_once 'connexion1.php';
    require_once 'functions.php';

	if(!empty($_POST)) {
		//récupération des informations du formulaire
		$adresse = test_input($_POST["adresse"]);
        $mdp = test_input($_POST["mdp"]);
        


        $sql = "SELECT * FROM users WHERE adresse= :adresse";
        $req = $con->prepare($sql);
        $req->bindparam(":adresse", $adresse);
        $req->execute(); 

        if ($req->rowCount() > 0)  {
            $user = $req->fetch();
            if (password_verify($mdp, $user['mdp'])) {
                session_start();
                $_SESSION['id'] = $user['id'];
                header('location:Accueil.php');
            } else {
                $error = "Mot de passe erroné";
            }
        } else {
            $error = "username erroné !";
        }
	}
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Login : Atelier 5</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="icon" href="logo.jpg" />
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div class="container">
       <form class="form-signin" method="post" id="login-form">
        <h2 class="form-signin-heading">Connexion</h2><hr />
        
        <div id="error">
        <?php
			//Si la variable $error existe on l'affiche
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="adresse" placeholder="Votre adresse mail" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="mdp" placeholder="Votre mot de passe" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-primary">
                Connexion
            </button>
        </div>  
      	<br />
            <label>Vous n'avez pas un compte ! <a href="signup.php">Inscription</a></label>
      </form>

    </div>
</body>
</html>