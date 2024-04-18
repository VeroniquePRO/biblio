<?php

include "home.php";

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
$statement=$pdo->query("select * from livres");
$livres = $statement->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($livres);
echo "</pre>";
?>
<h1>Liste des livres</h1>
<hr>
<a href="ajouterlivre.php?"> 
    Ajouter
    </a>
<hr>
<?php 

foreach ($livres as $onelivre){ ?>
    Nom : 
    <a href="detaillivre.php?id=<?=$onelivre['idlivres']?>">
        <?=$onelivre['titre']?>
    </a>&nbsp;
    <a href="modifierlivre.php?id=<?=$onelivre['idlivres']?>"> 
       Modifier
    </a> &nbsp;
    <a href="supprimerlivre.php?id=<?=$onelivre['idlivres']?>"> 
       Supprimer
    </a>
    
    <br>
    <?php     
}
?>