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

<div class=listelivrecantainer>
    <div class="cardlistelivre">
        <?php foreach ($livres as $onelivre) { ?>
            <img src=<?= $onelivre['cover'] ?> class="-list-card-img-top">
            <a href="detaillivre.php?id=<?= $onelivre['idlivres'] ?>">
                <?= $onelivre['titre'] ?></a>
                <?php
            foreach ($auteurs as $oneauteur) {
                if ($oneauteur['idauteurs'] === $onelivre['idauteurs']) {
                    echo $oneauteur['nom'];
                    break;
                }
            }
        }
        ?>

    </div>
</div>