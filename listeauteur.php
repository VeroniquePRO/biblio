<?php 
include "home.php";

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');
$statement=$pdo->query("select * from auteurs");
$auteurs = $statement->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($auteurs);
echo "</pre>";

?>
<h1> Liste des auteurs<h1><hr></h1>
<a href="ajouterauteur.php?"> 
    Ajouter
    </a>
<hr>
<?php 

foreach ($auteurs as $oneauteur){ ?>
    Nom de l'auteur: 
    <a href="detailauteur.php?id=<?=$oneauteur['idauteurs']?>">
        <?=$oneauteur['nom']?>
    </a> 
    &nbsp;<a href="modifierauteur.php?id=<?=$oneauteur['idauteurs']?>">Modifier</a>
    &nbsp;<a href="supprimerauteur.php?id=<?=$oneauteur['idauteurs']?>"> 
       Supprimer
    </a>
    <br>
    <?php     
}
?>
