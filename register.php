
<?php
include("ConnectDB.php");

session_start();

$title = "Register";
include("Header.php");

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(empty($_POST['email'])){
        $errors['email'] = 'Veuillez saisir un email !';
    }

    $resu = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $resu->bindParam("email", $_POST["email"]);
    $resu->execute();
    $resull = $resu->fetchAll();
    if(count($resull)>0){
        $errors['email'] = 'Impossible, ce compte existe déjà';
    }
    // Password saisie
    if(empty($_POST['password'])){
        $errors["password"] = "Veuillez saisir un mot de passe";
    }

    if(count($errors) == 0){
        $resu = $pdo->prepare(
                'INSERT INTO utilisateur (email, password)
                VALUES (:email, :password)'
        );

        $resu->bindParam(':email', $_POST["email"]);
        $resu->bindParam(':password', password_hash($_POST["password"], PASSWORD_DEFAULT));
        $resu->execute();
        header("Location: admin.php");
    }
}

    ?>
    <form method="post" action="register.php" class="p-5">
        <div class="form-group ">
            <label for="email">Email</label>
            <input id="email" name="email" placeholder="email" class="form-control">
        </div>

        <div class="form-group mt-2">
            <label for="password">Password</label>
            <input id="password" name="password" placeholder="Password" class="form-control">  
        </div>
        <?php
                if(count($errors) != 0){
                    echo(' <h4>Erreurs lors de la dernière soumission du formulaire : </h2>');
                    foreach ($errors as $error){
                        echo('<div class="text-danger">'.$error.'</div>');
                    }
                }
            ?>

        <input type="submit" class="btn btn-success mt-3">
    </form>


<?php
include("Footer.php");
?>
