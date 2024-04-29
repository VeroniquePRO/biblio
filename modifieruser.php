<?php
include "header.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];

    $statement = $pdo->prepare("UPDATE users SET nom = :nom WHERE idusers = :id");
    $statement->bindValue(':nom', $nom, \PDO::PARAM_STR);
    $statement->bindValue(':id', $id, \PDO::PARAM_INT);

    if ($statement->execute()) {
        echo "Utilisateur mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de l'utilisateur.";
    }
}

$statement = $pdo->prepare("SELECT * FROM users WHERE idusers = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();

$users = $statement->fetch(PDO::FETCH_ASSOC);

var_dump($id);
?>
<form action="modifieruser.php?id=<?= $id ?>" method="POST">
    <input name="user" type="text" value="<?= $users['nom'] ?>">

    <input type="submit" value="Modifier">
</form>