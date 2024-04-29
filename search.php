<?php
include "header.php";


$pdo = new \PDO('mysql:host=localhost;dbname=biblio', 'root','Masgroovy_06');


$statement = $pdo->prepare("SELECT * FROM auteurs");
$statement->execute();
$auteurs = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);


        if (isset($_GET['search'])) {
            $search = htmlspecialchars($_GET['search']);

            $pdo = new PDO('mysql:host=localhost;dbname=biblio', 'root', 'Masgroovy_06');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $statement = $pdo->prepare("SELECT * FROM livres WHERE titre LIKE :search");
            $statement->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $statement->execute();

            $livres = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (count($livres) > 0) {
                echo "Résultats de la recherche pour '$search' : ";
                foreach ($livres as $onelivre) { ?>
                    <br>
                    <?php foreach ($livres as $onelivre) { ?>
                        <img src=<?= $onelivre['cover'] ?> class="card-img-top" style="max-width: 200px" ;>
                        <tr><br>
                            <td><a href="detaillivre.php?id=<?= $onelivre['idlivres'] ?>">
                                    <?= $onelivre['titre'] ?></a></td>
                            <td>
                            <?php
                            foreach ($auteurs as $oneauteur) {
                                if ($oneauteur['idauteurs'] === $onelivre['idauteurs']) {
                                    echo $oneauteur['nom'];
                                    break;
                                }
                            }
                        }
                            ?>
                <?php }
            } else {
                echo "Aucun résultat trouvé pour '$search'.";
            }
        } else {
            echo "Veuillez saisir un terme de recherche.";
        }
                ?>
</div>