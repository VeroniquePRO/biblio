<?php 
include "home.php";
$id= $_GET['id'];
?>
<?php
$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');
$statement = $pdo->prepare("SELECT livres.*, auteurs.nom, categories.genre
FROM livres
JOIN auteurs
ON livres.idauteurs = auteurs.idauteurs
JOIN categories
ON livres.idcategories = categories.idcategories
WHERE idlivres = :id");

$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();
$livres = $statement->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($livres);
echo "</pre>";
?>

Vous avez cliqué sur le livre
<?=$id?>
 Nom : 
<?=$livres['titre']?>
&nbsp;
de l'auteur:
<?=$livres['nom']?>
&nbsp;

pour la catégorie:
<?=$livres['genre']?>
&nbsp;

Sommaire :
<?=$livres['sommaire']?>
</body>

