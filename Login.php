
<?php
    include("Header.php");
    include("ConnectDB.php");

    $errors = [];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if (empty($_POST['nom']) || strlen($_POST['nom']) ) {
            $errors[] = 'saisissez votre nom';
        }
        
        if (empty($_POST['password']) || strlen($_POST['password'])   ) {
            $errors[] = 'saisissez votre password';
        }
        
        if(count($errors) == 0){
            $req = $pdo->prepare('SELECT * FROM utilisateur WHERE nom = :nom');
            $req->bindParam(':nom', $_POST["nom"]);
            $req->execute();
            $effects = $req->fetch();
    
            if(!$effects || !password_verify($_POST["password"], $effects["password"])){
                $errors["password"] = 'Identifiants ou password incorrecte';
            }
            else{
                session_start();
                $_SESSION["nom"] = $effects["nom"];
                header('location: admin.php');
            }
            var_dump($effects);
        }
    }
    
?>
<div class="conatiner text-center">
    <h1 class="text-center text-warning  mt-4 mb-4">Login</h1>

    <form method="POST" action="login.php" >
        <div class="text-align center">
            <div class="mt-4 mb-4"> 
                <label for="nom">Nom</label>
                <input required type="text" name="nom" placeholder="Nom">
            </div>

            <div class="mt-4 mb-4">  
                <label for="email">Email</label>
                <input required type="text" name="email" placeholder="Email">
            </div>

            <div class="mt-4 mb-4" >
                <label for="password">Mot de passe</label>
                <input required type="password" name="password" placeholder="password">
            </div>

            <button class="btn btn-outline-success text-warning">Se connecter</button>

        </div>
    
    </form>
</div>

<?php
include("footer.php");
?>
