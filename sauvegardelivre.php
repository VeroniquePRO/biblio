<?php
include "home.php";

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
if (empty($_POST['titre']) || empty($_POST['auteurs']) || empty($_POST['categories'])) {
    echo "Tous les champs doivent être remplis";
    exit;
}

    $titre = $_POST['titre'];
    $idauteurs = $_POST['auteurs'];
    $idcategories = $_POST['categories'];
    $sommaire = $_POST['sommaire'];
 

    // Préparation de la requête pour vérifier l'existence d'un enregistrement similaire
    $checkStmt = $pdo->prepare("SELECT * FROM livres WHERE titre = :titre AND idauteurs = :idauteurs");
    $checkStmt->bindParam(':titre', $titre);
    $checkStmt->bindParam(':idauteurs', $idauteurs);
    $checkStmt->execute();

// Si un enregistrement existe déjà, informer l'utilisateur
if ($checkStmt->fetch()) {
    echo "Le livre existe déjà dans la base de données";
    exit;
}

// Si aucun enregistrement similaire n'est trouvé, procéder à l'insertion
    $statement = $pdo->prepare("INSERT INTO livres (titre, idauteurs, idcategories, sommaire) VALUES (:titre, :idauteurs, :idcategories, :sommaire)");
    $statement->bindValue(':titre', $titre, \PDO::PARAM_STR);
    $statement->bindValue(':idauteurs', $idauteurs, \PDO::PARAM_INT);
    $statement->bindValue(':idcategories', $idcategories, \PDO::PARAM_INT);
    $statement->bindValue(':sommaire', $sommaire, \PDO::PARAM_STR);

if ($statement->execute()) {
    echo "livre ajouté avec succès.";
}

header("location:listelivre.php");
?>


