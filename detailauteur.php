<?php 
include "header.php";
$id= $_GET['id'];

?>
<?php
$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
$statement=$pdo->query("select * from auteurs WHERE idauteurs=$id");
$auteurs = $statement->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($auteurs);
echo "</pre>";
?>

Nom de l'auteur : 
<?=$auteurs['nom']?>
<br>
<?php
$statement = $pdo->prepare("SELECT * FROM livres WHERE idauteurs = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();
$livres = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
foreach ($livres as $onelivre){ ?>
    Nom : 
    <a href="detaillivre.php?id=<?=$onelivre['idlivres']?>">
        <?=$onelivre['titre']?>
    </a>
    <br>

<?php
}
?>