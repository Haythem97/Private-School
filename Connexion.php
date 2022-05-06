<?php
try {
    $con = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur de base de données ');
}

	
?>