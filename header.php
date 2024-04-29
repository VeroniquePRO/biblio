<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Library</title>
    <title>Library</title>
    <link href="style.css" rel="stylesheet" />

    <title>Document</title>
</head>

<body>
    <header>
        <div= navbar>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="biblio.php">Biblio</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="listecategorie.php">Catégories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="listelivre.php">Livres</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="listeauteur.php">Auteurs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="listeuser.php">Utilisateurs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="inscription.php">
                                    <i class="fa-solid fa-user-plus"></i>
                                   Inscription</a>
                            </li>
                            <?php
                            if (isset($_SESSION['users'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="deconnexion.php">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        Deconnexion</a>
                                </li>

                            <?php
                            }

                            ?>
                        </ul>
                    </div>

                    <form action="search.php" method="GET" class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Rechercher un livre" aria-label="search" name="search">
                        <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                    </form>

                    <button>
                        <a href="index.php">Se connecter</a>
                    </button>

            </nav>
            </div>

    </header>
</body>

</html>