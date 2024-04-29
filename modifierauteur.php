<?php
include "header.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];

    $statement = $pdo->prepare("UPDATE auteurs SET nom = :nom WHERE idauteurs = :id");
    $statement->bindValue(':nom', $nom, \PDO::PARAM_STR);
    $statement->bindValue(':id', $id, \PDO::PARAM_INT);

    if ($statement->execute()) {
        echo "Auteur mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de la partie auteur.";
    }
}

$statement = $pdo->prepare("SELECT * FROM auteurs WHERE idauteurs = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();

$auteurs = $statement->fetch(PDO::FETCH_ASSOC);

var_dump($id);
?>
<form action="modifierauteur.php?id=<?= $id ?>" method="POST">
    <input name="nom" type="text" value="<?= $auteurs['nom'] ?>">

    <input type="submit" value="Modifier">
</form>