<?php 
include "header.php";

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
$statement=$pdo->query("select * from users");
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($users);
echo "</pre>";

?>
<h1> Liste des utilisateurs<h1><hr></h1>
<a href="ajouteruser.php?"> 
    Ajouter
    </a>
<hr>
<?php 

foreach ($users as $oneuser){ ?>
    Nom de l'utilisateur: 
    <a href="detailuser.php?id=<?=$oneuser['idusers']?>">
        <?=$oneuser['nom']?>
    </a> 
    &nbsp;<a href="modifieruser.php?id=<?=$oneuser['idusers']?>">Modifier</a>
    &nbsp;<a href="supprimeruser.php?id=<?=$oneuser['idusers']?>"> 
       Supprimer
    </a>
    <br>
    <?php     
}
?>
