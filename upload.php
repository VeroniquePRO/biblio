<?php
include "header.php";

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');
$img = "";
if (isset($_POST["ajouter"])) {
    $nom = $_POST["nom"];
    $description = $_POST["descripstion"];
}

$img = $_FILES["img"]["name"];
$upload = "./image/" .$img;
move_uploaded_file($_FILES)["img"][tmp]