<?php
include "home.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');

$statement = $pdo->prepare("SELECT livres.*, auteurs.nom, categories.genre
FROM livres
JOIN auteurs
ON livres.idauteurs = auteurs.idauteurs
JOIN categories
ON livres.idcategories = categories.idcategories
WHERE idlivres = :id");

$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

$livres = $statement->fetch(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM auteurs");
$statement->execute();
$auteurs = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $idauteurs = $_POST['auteurs'];
    $idcategories = $_POST['categories'];
    $sommaire = $_POST['sommaire'];

    $statement = $pdo->prepare("UPDATE livres SET titre = :titre, idauteurs = :idauteurs, 
    idcategories = :idcategories, sommaire = :sommaire WHERE idlivres = :id");
    $statement->bindValue(':titre', $titre, \PDO::PARAM_STR);
    $statement->bindValue(':idauteurs', $idauteurs, \PDO::PARAM_INT);
    $statement->bindValue(':idcategories', $idcategories, \PDO::PARAM_INT);
    $statement->bindValue(':id', $id, \PDO::PARAM_INT);
    $statement->bindValue(':sommaire', $sommaire, \PDO::PARAM_STR);


    if ($statement->execute()) {
        echo "Livre mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du livre.";
    }
}
?>

<form action="modifierlivre.php?id=<?= $id ?>" method="POST">
    Titre : 
    <input name="titre" type="text" value="<?= $livres['titre'] ?>"><br>

    Auteur :
    <select class="form-label" name="auteurs" id="auteurs" required>
        <?php foreach ($auteurs as $oneauteur) { ?>
            <option value="<?= $oneauteur['idauteurs'] ?>" <?= $livres['nom'] === $oneauteur['nom'] ? 'selected' : '' ?>>
                <?= $oneauteur['nom'] ?>
            </option>
        <?php } ?>
    </select><br>

    Catégorie :
    <select class="form-label" name="categories" id="categories" required>
        <?php foreach ($categories as $onecategorie) { ?>
            <option value="<?= $onecategorie['idcategories'] ?>" <?= $livres['genre'] === $onecategorie['genre'] ? 'selected' : '' ?>>
                <?= $onecategorie['genre'] ?>
            </option>
        <?php } ?>
    </select><br>
    <br>
    Sommaire : <br>
    <textarea id="sommaire" name="sommaire" rows="10" cols="50"></textarea>
<br>

    <input type="submit" value="Modifier">
</form>
