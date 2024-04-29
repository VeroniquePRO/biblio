<?php
include "header.php";

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');
$statement = $pdo->query("select * from auteurs");
$auteurs = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
        <h1>Liste des auteurs</h1>
<hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Auteurs</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($auteurs as $oneauteur) { ?>
            <tr>
                <td><a href="detailauteur.php?id=<?=$oneauteur['idauteurs']?>">
                        <?= $oneauteur['nom'] ?></a></td>
                <td>

                    <a href="modifierauteur.php?id=<?=$oneauteur['idauteurs'] ?>"> Modifier</a>
                    <a href="supprimerauteur.php?id=<?=$oneauteur['idauteurs']?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="ajouterauteur.php?id=">Ajouter un nouvelle auteur</a> 