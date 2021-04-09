<?php

// admin/author/read.php

require '../../bootstrap.php';

use Repository\AuthorRepository;

// Récupérer l'identifiant dans les paramètres d'URL ($_GET)
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    http_response_code(403);
    exit();
}

$repository = new AuthorRepository($connection);

$author = $repository->findOneById($id);
// Utiliser la méthode findOneById() de la classe AuthorRepository
// pour récupérer l'auteur correspondant à l'identifiant

?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Head -->
    <?php include PROJECT_ROOT . '/admin/includes/head.php'; ?>
    <title>Administration</title>
</head>
<body>
<!-- Top bar -->
<?php include PROJECT_ROOT . '/admin/includes/topbar.php'; ?>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar bar -->
        <?php include PROJECT_ROOT . '/admin/includes/sidebar.php'; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Détail de l'utilisateur</h1>
            </div>

            <p>
                <!-- Boutons Modifier / Supprimer -->
                <td class="text-right">
                    <a href="update.php?id=<?= $author->getId() ?>" class="btn btn-sm btn-warning">
                        Modifier
                    </a>
                    <a href="delete.php?id=<?= $author->getId() ?>" class="btn btn-sm btn-danger">
                        Supprimer
                    </a>
                </td>
            </p>

            <table>
                <tbody>
                <tr>
                    <th>ID</th>
                    <td>
                        #<?= $author->getId() ?>
                    </td>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td>
                        <?= $author->getName() ?>
                    </td>
                </tr>
                </tbody>
            </table>

        </main>
    </div>
</div>

<!-- Scripts -->
<?php include PROJECT_ROOT . '/admin/includes/scripts.php'; ?>
</html>