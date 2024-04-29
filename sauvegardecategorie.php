<?php
include "header.php";

$genre=$_POST['genre'];
var_dump($_POST);

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
$statement=$pdo->prepare("INSERT INTO categories (genre) VALUES (:genre)");
$statement->bindValue(':genre',$genre, \PDO::PARAM_STR);
$statement->execute();
header("location:listecategorie.php");
?><hr>
