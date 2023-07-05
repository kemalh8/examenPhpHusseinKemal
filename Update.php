
<?php 
    include("connectDB.php");

    session_start();

        if(!isset($_SESSION["nom"])){
            header("Location: login.php");
        }
        if(!isset($_GET['id'])){
            header("Location: admin.php");
        }
        $requete = $pdo->prepare("SELECT * FROM annonce WHERE id = :id;");
        $requete->execute([
            'id' => $_GET['id']
        ]);

        $annonce = $requete->fetch();

        if (!$annonce){
            header('Location: admin.php');
        }

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // s'il n'y a pas de nom/prénom/age/position, il y aura une erreur 
        if (empty($_POST['id'])) {
            $errors[] = 'Veuillez saisir un id';
        }
        if (empty($_POST['titre'])) {
            $errors[] = 'Veuillez saisir un titre';
        }
        if (empty($_POST['contenu'])) {
            $errors[] = 'Veuillez saisir un contenu';
        }
        if (empty($_POST['image'])) {
            $errors[] = 'Veuillez inserer une image';
        }
        if (count($errors) === 0) {
            
            // ... la requête préparée peut être exécutée
            $requete = $pdo->prepare(" UPDATE annonce SET titre = :titre, contenu = :contenu,  image = :image  WHERE id = :id;");

            $requete->execute([
                "titre" => $_POST["titre"],
                "contenu" => $_POST["contenu"],
                "image" => $_POST["image"],
                "id" => $_GET["id"]
            ]);
            header('Location: admin.php');
        }
    }

    include("header.php");

?>
        <form method="POST" action="update.php?id=<?=$_GET["id"]?>">
            
            <label>ID</label>
            <input type="text" name="Id" value ="<?=$annonce['id'];?>">
            
            <label>Titre</label>
            <input type="text" name="titre"value ="<?=$annonce['titre'];?>">

            
            <label>Contenu</label>
            <input type="text" name="contenu" value ="<?=$annonce['contenu'];?>">

            
            <label>Image</label>
            <input type="text" name="image" value ="<?=$annonce['image'];?>">

            
        <?php
            //Affichage des erreurs
            if (isset($errors)) {
                echo (' <h4>Erreurs lors de soumission du formulaire : </h2>');
                foreach ($errors as $error) {
                    echo ('<div class="text-danger">' . $error . '</div>');
                }
            }
        ?>

            <button class="btn btn-outline-success">Add  announcement</button>
    </form>

    <?php
    include("footer.php");
    ?>