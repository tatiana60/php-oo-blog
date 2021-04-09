<!-- Require bootstrap -->
<?php require '../../bootstrap.php';

use Repository\AuthorRepository;

$repository = new AuthorRepository($connection);

$authors = $repository->findAll();


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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Auteurs</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="/admin/author/create.php" class="btn btn-success">
                        Nouvel auteur
                    </a>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($authors as $author) {
                    ?>
                    <tr>
                        <td>
                            # <?= $author->getId() ?>
                        </td>
                        <td>
                            <a href="/admin/author/read.php?id=<?= $author->getId() ?>">
                                <?= $author->getName() ?>
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/admin/author/update.php?id=<?= $author->getId() ?>" class="btn btn-sm btn-warning">
                                Modifier
                            </a>
                            <a href="/admin/author/delete.php?id=<?= $author->getId() ?>" class="btn btn-sm btn-danger">
                                Supprimer
                            </a>
                        </td>
                    </tr>

                    <?php
                }
                ?>

                </tbody>
            </table>

        </main>
    </div>
</div>

<!-- Scripts -->
<?php include PROJECT_ROOT . '/admin/includes/scripts.php'; ?>
</html>
