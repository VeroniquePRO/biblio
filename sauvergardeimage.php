<?php
include "header.php";
$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $pdo->beginTransaction();

    if (empty($_POST['titre']) || empty($_POST['auteurs']) || empty($_POST['categories']) || empty($_FILES['cover'])) {
        throw new Exception("Tous les champs et l'image doivent être remplis");
    }

    $titre = $_POST['titre'];
    $idauteurs = $_POST['auteurs'];
    $idcategories = $_POST['categories'];
    $synopsis = $_POST['synopsis'];

    
    $newFilename = uniqid() . '_' . basename($_FILES['cover']['name']);
    $dossierTempo = $_FILES['cover']['tmp_name'];
    $dossierSite = 'uploads/' . $newFilename;
    if (!move_uploaded_file($dossierTempo, $dossierSite)) {
        throw new Exception("Une erreur est survenue lors du téléchargement du fichier");
    }

    
    $statement = $pdo->prepare("INSERT INTO livres (titre, idauteurs, idcategories, synopsis, cover) VALUES (:titre, :idauteurs, :idcategories, :synopsis, :cover)");
    $statement->bindValue(':titre', $titre, PDO::PARAM_STR);
    $statement->bindValue(':idauteurs', $idauteurs, PDO::PARAM_INT);
    $statement->bindValue(':idcategories', $idcategories, PDO::PARAM_INT);
    $statement->bindValue(':synopsis', $synopsis, PDO::PARAM_STR);
    $statement->bindValue(':cover', $dossierSite, PDO::PARAM_STR);
    $statement->execute();

    $pdo->commit();
    echo "livre ajouté avec succès.";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Erreur : " . $e->getMessage();
}
