<?php

// admin/post/index.php

require '../../bootstrap.php';
/** @var PDO $connection */
use Repository\PostRepository;
use Repository\AuthorRepository;
use Repository\CategoryRepository;

$categoryRepository = new CategoryRepository($connection);
$authorRepository = new AuthorRepository($connection);

$repository = new PostRepository(
    $connection,
    $categoryRepository,
    $authorRepository
);

if (null === $posts = $repository->findAll()) {
    http_response_code(404);
    exit;
}

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
                <h1 class="h2">Articles</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="/admin/post/create.php" class="btn btn-success">
                        Nouvel article
                    </a>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) {
                    ?>
                    <tr>
                        <td>
                            # <?= $post->getId() ?>
                        </td>
                        <td>
                            <a href="/admin/post/read.php?id=<?= $post->getId() ?>">
                                <?= $post->getTitle() ?>
                            </a>
                        </td>
                        <td>
                            <a href="/admin/category/read.php?id=<?= $post->getCategory()->getId() ?>">
                                 <?= $post->getCategory()->getTitle() ?>
                            </a>
                        </td>
                        <td>
                            <a href="/admin/author/read.php?id=<?= $post->getAuthor()->getId() ?>">
                                 <?= $post->getAuthor()->getName() ?>
                            </a>
                        </td>
                        <td>
                            <?= $post->getDate()->format('Y-m-d') ?>
                        </td>
                        <td class="text-right">
                            <a href="/admin/post/update.php?id=<?= $post->getId() ?>" class="btn btn-sm btn-warning">
                                Modifier
                            </a>
                            <a href="/admin/post/delete.php?id=<?= $post->getId() ?>" class="btn btn-sm btn-danger">
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
