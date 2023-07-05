



<?php
    session_start();
    // vérification de session sinon renvoi sur "login.php"
    if (!isset($_SESSION["nom"])) {
        header("Location: login.php");
    }


    // les erreurs vont se retrouver dans un tableau
    $errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['id'])) { 
        $errors[] = 'Veuillez saisir un id';
    }
    if (empty($_POST['nom'])) {
        $errors[] = 'Veuillez saisir un nom';
    }
    if (empty($_POST['prenom'])) {
        $errors[] = 'Veuillez saisir un prenom';
    }
    if (empty($_POST['email'])) {
        $errors[] = 'Veuillez saisir un email';
    }

    // insertion de connect car usage de pdo juste après
    include("connectDB.php");

    if (count($errors) === 0) {
        
        // ... la requête préparée peut être exécutée
        $requete = $pdo->prepare("INSERT INTO annonce (id, nom, prenom, email) VALUES(:id,:nom,:prenom,:email);");

        $requete->execute([
            "id" => $_POST['id'],
            "nom" => $_POST['nom'],
            "prenom" => $_POST['prenom'],
            "email" => $_POST['email'],

        ]);
        header('Location: admin.php');
    }
}


?>

    <form method="POST" action="add.php">
        
        <label>Id</label>
        <input type="text" name="id">
        
        <label>Titre</label>
        <input type="text" name="titre">

        <label>Image</label>
        <input type="number" name="image">



            <?php
        //Affichage des erreurs
        if (isset($errors)) {
            echo (' <h4>Erreurs lors de soumission du formulaire : </h2>');
            foreach ($errors as $error) {
                echo ('<div class="text-danger">' . $error . '</div>');
            }
        }
        ?>


        <button class="btn btn-outline-success"> Add announcement</button>

    </form>


