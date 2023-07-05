<?php

    session_start();

    if(isset($_SESSION["nom"])){
        unset($_SESSION["nom"]);    
    }

    header("Location: index.php");

?>