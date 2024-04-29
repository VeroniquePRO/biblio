<?php
include "header.php";
$id = $_GET['id'];
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

?>

<body>

  <div class="cardcontainer">
    <div class="card" style="width: 18rem;">
      <img src=<?= $livres['cover'] ?> class="card-img-top" alt="fd.png">
    </div>
      <div class="card-body">
        <p class="card-title">Vous avez selectionné le livre &nbsp;<?= $livres['titre'] ?> de l'auteur <?= $livres['nom'] ?>&nbsp;
        pour la catégorie <?= $livres['genre'] ?> &nbsp;</p>
        <p class="synopsis">Synopsis :<br><?= $livres['synopsis'] ?></p>
      </div>
  </div>
</body>