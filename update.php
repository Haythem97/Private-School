<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title>Accueil</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div id='cssmenu'>
<ul>
   <li><a href='Accueil.php'>Home</a></li>
   <li class='active'><a href='#'>Parametre</a>
      <ul>
         <li><a href='MonProfil'>Mon Profil</a></li>
         <li><a href='#'>Decconexion</a></li>
      </ul>
   </li>
</ul>
</div>
    <?php
        require 'connexion.php';
        $id = $_GET['id'];

        if (!empty($_POST)) {
            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];

            $req = "UPDATE users SET nom = '$nom', adresse = '$adresse' WHERE id = $id";
            $rep = $con->exec($req);

            if ($rep) {
                echo '<div class="alert alert-success" role="alert">';
                echo "Modification effectuée avec succès";
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo "Echec de la modification";
                echo '</div>';
            }
        }

        $req = "SELECT * FROM users WHERE id = $id";

        $rep = $con->query($req);
        $ligne = $rep->fetch();
    ?>
<div class="container">
    <form method="post" action="update.php?id=<?php echo $id;  ?>" >
        <div class="form-group">
            <label for="nom"> Nom: </label> 
            <input type="text" value="<?php echo $ligne['nom'] ?>" required name="nom" id="nom" class="form-control" placeholder="Votre nom & prénom"  />
        </div>
        <div class="form-group">
            <label for="email"> Email: </label>
            <input type="text" value="<?php echo $ligne['adresse'] ?>" required name="adresse" id="adresse" class="form-control" placeholder="personne@exemple.xy"/>
        </div>
        <div>
            <input type="submit" class="btn btn-info" value="Envoyer" />
            <input type="reset" class="btn btn-warning" value="Annuler">
        </div>
    </form>
</div>
</body>
</html>