<table class="table">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($book as $onebook) { ?>
            <tr>
                <td><?= $onebook['title'] ?></td>
                <td>
                    <?php
                    foreach ($author as $oneauthor) {
                        if ($oneauthor['idauthor'] === $onebook['idauthor']) {
                            echo $oneauthor['name'];
                            break;
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($category as $onecategory) {
                        if ($onecategory['idcategory'] === $onebook['idcategory']) {
                            echo $onecategory['genre'];
                            break;
                        }
                    }
                    ?>
                </td>
                <td>
                    <a href="detailbook.php?id=<?= $onebook['idbook'] ?>">Détails</a>
                    <a href="deletebook.php?id=<?= $onebook['idbook'] ?>">Supprimer</a>
                    <a href="modifybook.php?id=<?= $onebook['idbook'] ?>">Modifier</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>