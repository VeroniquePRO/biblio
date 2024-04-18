<?php

include "home.php";

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
$statement=$pdo->query("select * from categories");
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($categories);
echo "</pre>";
?>
<h1>Liste des catogories</h1>
<hr>

<a href="ajoutercategorie.php?"> 
    Ajouter
    </a>
<hr>

<?php 
foreach ($categories as $onecategorie){ ?>
    Nom : 
    <a href="detailcategorie.php?id=<?=$onecategorie['idcategories']?>">
        <?=$onecategorie['genre']?>
    </a>
    &nbsp;
    <a href="modifiercategorie.php?id=<?=$onecategorie['idcategories']?>"> 
       Modifier
    </a> 
    &nbsp;
    <a href="supprimercategorie.php?id=<?=$onecategorie['idcategories']?>"> 
       Supprimer
    </a>

    
    <br>
    <?php     
}
?>