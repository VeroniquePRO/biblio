<?php
include "home.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');

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

    $statement = $pdo->prepare("UPDATE livres SET titre = :titre WHERE idlivres = :id");
    $statement->bindValue(':titre', $titre, \PDO::PARAM_STR);
    $statement->bindValue(':id', $id, \PDO::PARAM_INT);

    if ($statement->execute()) {
        echo "Livre mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du livre.";
    }
}

$statement = $pdo->prepare("SELECT * FROM livres WHERE idlivres = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();

$livres = $statement->fetch(PDO::FETCH_ASSOC);

var_dump($id);
?>
<form action="modifierlivre.php?id=<?= $id ?>" method="POST">
    Titre : 
    <input name="titre" type="text" value="<?= $livres['titre'] ?>">
</form>

Auteur :

<select class="form-label" name="auteurs" id="auteurs" required>
    <option><?= $livres['nom'] ?></option>
    <?php foreach ($auteurs as $oneauteur) { ?>
        <option value="<?= $oneauteur['idauteurs'] ?>"><?= $oneauteur['nom'] ?></option>
    <?php } ?>
</select><br>

Categorie :

<select class="form-label" name="categories" id="categories" required>
    <option><?= $livres['genre'] ?></option>
    <?php foreach ($categories as $onecategorie) { ?>
        <option value="<?= $onecategorie['idcategories'] ?>"><?= $onecategorie['genre'] ?>
        </option>
    <?php } ?>
</select><br>

<input type="submit" value="Modifier">

</form>

