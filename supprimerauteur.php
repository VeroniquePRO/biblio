<?php
include "home.php";
$id=$_GET['id']; 
$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
$statement = $pdo->prepare("DELETE FROM auteurs WHERE idauteurs = :id");
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();
$auteurs = $statement->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
var_dump($auteurs);
echo "</pre>";

header("location:listeauteur.php");
?>