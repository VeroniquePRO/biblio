<?php

include "header.php";



$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');
$statement = $pdo->query("select * from livres");
$livres = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM livres");
$statement->execute();
$livres = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM auteurs");
$statement->execute();
$auteurs = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <h1> Liste des livres<h1><hr>
    <tbody>
        
    <?php foreach ($livres as $onelivre) { ?>
            <tr>
                <td><a href="detaillivre.php?id=<?= $onelivre['idlivres'] ?>">
                        <?= $onelivre['titre'] ?></a></td>
                <td>
                    <?php
                    foreach ($auteurs as $oneauteur) {
                        if ($oneauteur['idauteurs'] === $onelivre['idauteurs']) {
                            echo $oneauteur['nom'];
                            break;
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($categories as $onecategorie) {
                        if ($onecategorie['idcategories'] === $onelivre['idcategories']) {
                            echo $onecategorie['genre'];
                            break;
                        }
                    }
                    ?>
                </td>
                <td>

                    <a href="supprimerlivre.php?id=<?= $onelivre['idlivres'] ?>"> Supprimer</a>
                    <a href="modifierlivre.php?id=<?= $onelivre['idlivres'] ?>">Modifier</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="ajouterlivre.php?id=">Ajouter un livre</a> 