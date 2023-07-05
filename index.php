<?php
    require 'Header.php';
    require 'ConnectDB.php';

        $requete = $pdo->prepare("SELECT * FROM annonce;");
        $requete->execute();
        $annonces = $requete->fetchAll();
?>
    <div class="container custom-container">
            <h1 class="text-center text-warning mt-4 mb-4">Listes d'annonces</h1>
        <table class="table  text-light" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>utilisateur</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($annonces as $annonce) { ?>
                    <tr>
                           <td> <?=$annonce["id"] ?> </td>          
                           <td> <?=$annonce["titre"] ?> </td>
                           <td> <?=$annonce["contenu"] ?> </td>
                           <td> <?=$annonce["utilisateur"] ?> </td>
                           <td><img src="image/<?=$annonce["image"]?>" height="100"> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table> 
    </div>    
<?php
 require 'Footer.php';

 ?>

