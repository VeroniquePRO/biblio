<?php
include "home.php";
$id=$_GET['id']; 
$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
$statement = $pdo->prepare("DELETE FROM categories WHERE idcategories = :id");
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();
$categories = $statement->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
var_dump($categories);
echo "</pre>";

header("location:listecategorie.php");
?>
