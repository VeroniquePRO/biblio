<?php
include "header.php";
$id= $_GET['id'];


$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');



$statement = $pdo->prepare("SELECT * FROM livres");
$statement->execute();
$livres = $statement->fetchAll(PDO::FETCH_ASSOC);


$statement = $pdo->prepare("SELECT * FROM auteurs");
$statement->execute();
$auteurs = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
Nouveau livre 
<hr>

<form action="sauvegardelivre.php" method="POST" enctype="multipart/form-data">>
   Titre : 
<input name="titre" type="text" /><br>


Auteur :
    <select class="form-label" name="auteurs" id="idauteurs" required>
        <option disabled selected>Choisissez un auteur</option>
        <?php foreach ($auteurs as $oneauteur) { ?>
            <option value="<?= $oneauteur['idauteurs'] ?>"><?= $oneauteur['nom'] ?></option>
        <?php } ?>
    </select><br>
    <div class="form-label">Si l'auteur n'existe pas, 
       <a href="ajouterauteur.php">ajouter un nouvel auteur
       </a>avant de saisir votre nouveau livre.
    </div>
 

    Category :
    <select class="form-label" name="categories" id="idcategories" required>
        <option disabled selected>Choisissez une catégorie</option>
        <?php foreach ($categories as $onecategorie) { ?>
            <option value="<?= $onecategorie['idcategories'] ?>"><?= $onecategorie['genre'] ?>
            </option>
        <?php } ?>
    </select>

    <div class="form-label">Si la catégorie n'existe pas, 
       <a href="ajouterauteur.php">ajouter une nouvelle catégorie
       </a>avant de saisir votre nouveau livre.
    </div> 
<br>
    Synopsis : <br>
    <textarea id="synopsis" name="synopsis" rows="10" cols="50"></textarea>
<br>
<label for="upload">Envoyer une image</label>
    <input type="file" name="cover" id="upload"><br>
   <input type="submit" value = "ajouter">
</form>