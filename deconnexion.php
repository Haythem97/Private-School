<?php

	//On déconnecte l'utilisateur
	session_start();
	session_destroy();
    unset($_SESSION['id']);

	//Puis on le redirige vers la page de connexion
	header("Location: index.php");
?>