<?php
include "header.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare("SELECT livres.*, auteurs.nom, categories.genre
FROM livres 
JOIN auteurs ON livres.idauteurs = auteurs.idauteurs
JOIN categories ON livres.idcategories = categories.idcategories  
WHERE idlivres = :id");


$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();
$livres = $statement->fetch(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM auteurs");
$statement->execute();
$auteurs = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);



var_dump($id);
?>

<form action="modifierlivre.php?id=<?= $id ?>" method="POST"enctype="multipart/form-data">>
    Titre : 
    <input class="form-label" name="titre" type="text" value="<?= $livres['titre'] ?>"><br>
    
    Auteur :
    <select name="auteurs" id="auteurs">
        <option><?= $livres['nom'] ?></option>
        <?php foreach ($auteurs as $oneauteur) {
        echo '<option value="' . $oneauteur['idauteurs'] . '"' . ($oneauteur['idauteurs'] == $livres['idauteurs'] ? ' selected' : '') . '>' . $oneauteur['nom'] . '</option>';
    } ?>
    </select><br>

    Categories :
    <select class="form-label" name="categories" id="categories">
        <option><?= $livres['genre'] ?></option>
        <?php foreach ($categories as $onecategorie) {
        echo '<option value="' . $onecategorie['idcategories'] . '"' . ($onecategorie['idcategories'] == $livres['idcategories'] ? ' selected' : '') . '>' . $onecategorie['genre'] . '</option>';
    } ?>
    </select><br>

    Synopsis :<br>
    <textarea class="form-label" name="synopsis" type="text" 
    rows="10" cols="80"><?= $livres['synopsis'] ?></textarea>

    <br>

    <label for="upload">Envoyer une image</label><br>
    <img src="<?= $livres['cover'] ?>" style="max-width: 200px;">
    <input type="file" name="cover" id="upload"><br>

   

<input type="submit" value="Modifier">

</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updates = [];
    $params = ['id' => $id]; 

    if (!empty($_POST['titre']) && $_POST['titre'] != $livres['titre']) {
        $updates[] = "titre = :titre";
        $params['titre'] = $_POST['titre'];
    }
    
    if (!empty($_POST['auteurs']) && $_POST['auteurs'] != $livres['idauteurs']) {
        $updates[] = "idauteurs = :idauteurs";
        $params['idauteurs'] = $_POST['auteurs'];
    }

    if (!empty($_POST['categories']) && $_POST['categories'] != $livres['idcategories']) {
        $updates[] = "idcategories = :idcategories";
        $params['idcategories'] = $_POST['categories'];
    }

    if (!empty($_POST['synopsis']) && $_POST['synopsis'] != $livres['synopsis']) {
        $updates[] = "synopsis = :synopsis";
        $params['synopsis'] = $_POST['synopsis'];
    }
  

    if (!empty($_FILES['cover']['name'])) {
        $newFilename = uniqid() . '_' . basename($_FILES['cover']['name']);
        $dossierTempo = $_FILES['cover']['tmp_name'];
        $dossierSite = 'uploads/' . $newFilename;
        if (move_uploaded_file($dossierTempo, $dossierSite)) {
            $updates[] = "cover = :cover";
            $params['cover'] = $dossierSite;
        }
    }

    if (!empty($updates)) {
        $sql = "UPDATE livres SET " . implode(', ', $updates) . " WHERE idlivres = :id";
        $statement = $pdo->prepare($sql);
        foreach ($params as $key => &$val) {
            $statement->bindParam($key, $val);
        }
        if ($statement->execute()) {
            header("location:listelivre.php");
            exit;
        } else {
            echo "Erreur lors de la mise à jour du livre.";
        }
    }
}