<?php
include "home.php";

$nom=$_POST['nom'];
var_dump($_POST);

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
$statement=$pdo->prepare("INSERT INTO auteurs(nom) VALUES (:nom)");
$statement->bindValue(':nom',$nom, \PDO::PARAM_STR);
$statement->execute();
header("location:listeauteur.php");
?><hr>
