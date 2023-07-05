<?php

include("ConnectDB.php");

session_start();

if (!isset($_SESSION["nom"])) {
    header("Location: login.php");
}

if (!isset($_GET['id'])) {
    header("Location: admin.php");
}

$requete = $pdo->prepare("SELECT * FROM annonce WHERE id = :id;");
$requete->execute([
    'id' => $_GET['id']
]);

$annoncesById = $requete->fetch();

if (!$annoncesById) {
    header('Location: admin.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($annoncesById);
    $requete = $pdo->prepare("DELETE FROM annonce WHERE id = :id;");

    $requete->execute([
        "id" => $_GET["id"]
    ]);

    header('Location: admin.php');
}
include("header.php");



?>

<form method="POST" action="delete.php?id=<?=$_GET["id"]?>">
    <button class="btn btn-danger">Delete</button>
    <button class="btn btn-secondary" formaction = "admin.php"> Cancel </button>
</form>


<?php
include("footer.php");
?>