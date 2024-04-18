<?php
include "home.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $genre = $_POST['genre'];

    $statement = $pdo->prepare("UPDATE categories SET genre = :genre WHERE idcategories = :id");
    $statement->bindValue(':genre', $genre, \PDO::PARAM_STR);
    $statement->bindValue(':id', $id, \PDO::PARAM_INT);

    if ($statement->execute()) {
        echo "Catégorie mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de la catégorie.";
    }
}

$statement = $pdo->prepare("SELECT * FROM categories WHERE idcategories = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();

$categories = $statement->fetch(PDO::FETCH_ASSOC);

var_dump($id);
?>
<form action="modifiercategorie.php?id=<?= $id ?>" method="POST">
    <input name="genre" type="text" value="<?= $categories['genre'] ?>">

    <input type="submit" value="Modifier">
</form>