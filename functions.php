<?php
    function exist_user ($nom) {
        require 'connexion1.php';
        $exist = false;

        $req = "SELECT * FROM users WHERE nom = '$nom'";

        $rep = $con->query($req);

        if ($rep->rowCount() > 0) 
            $exist = true;

        return $exist;
    } 

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
      

?>