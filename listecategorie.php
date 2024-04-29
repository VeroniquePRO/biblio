<?php

include "header.php";

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
$statement=$pdo->query("select * from categories");
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<h1>Liste des catogories</h1>
<hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Catégories</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $onecategorie) { ?>
            <tr>
                <td><a href="detailcategorie.php?id=<?=$onecategorie['idcategories']?>">
                        <?= $onecategorie['genre'] ?></a></td>
                <td>

                    <a href="modifiercategorie.php?id=<?=$onecategorie['idcategories'] ?>"> Modifier</a>
                    <a href="supprimercategorie.php?id=<?=$onecategorie['idcategories']?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="ajoutercategorie.php?id=">Ajouter une catégorie</a> 