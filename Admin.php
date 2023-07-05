<?php 
    if (!isset($_SESSION["nom"])) {
        header("Location: Login.php");
    }


    include("Header.php");
    include("ConnectDB.php");


// pour que admin puisse ajouter une annonce
    $requete = $pdo->prepare("SELECT * FROM annonce;");
    $requete->execute();
    $annonces = $requete->fetchAll();

    if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != "admin" || $_SERVER['PHP_AUTH_PW'] != "admin*1"){
        header('WWW-Authenticate: Basic realm = "Accès restreint"');
        header('HTTP/1.0 401 Unauthorized');
        echo "Accès non autorisé.";
        exit;
?>
                
        <?php }

            else { 
        ?>
                <a href="add.php">Add announcement</a><br />
                <a href="update.php">Update announcement</a><br />
                <a href="delete.php">Delete announcement</a><br />
        <?php 
            }
        ?>