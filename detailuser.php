<?php 
include "home.php";
$id= $_GET['id'];

?>
<?php
$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');
$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root');
$statement=$pdo->query("select * from users WHERE idusers=$id");
$users = $statement->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($users);
echo "</pre>";
?>

Vous avez cliqué sur l'utilisateur
<?=$id?>
 Nom : 
<?=$users['nom']?>
</body>