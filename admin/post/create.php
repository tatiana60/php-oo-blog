<?php

// admin/post/create.php

require '../../bootstrap.php';
/** @var PDO $connection */

use Repository\CategoryRepository;
use Repository\AuthorRepository;
use Manager\PostManager;
use Entity\Post;

$categoryRepository = new CategoryRepository($connection);
$authorRepository = new AuthorRepository($connection);

$post = new Post();

if (isset($_POST['post_create'])) {
    $category = $categoryRepository->findOneById($_POST['category']);

    $author = $authorRepository->findOneById($_POST['author']);

    $date = new DateTime($_POST['date']);

    $post
        ->setCategory($category)
        ->setAuthor($author)
        ->setTitle($_POST['title'])
        ->setContent($_POST['content'])
        ->setDate($date);

    $manager = new PostManager($connection);
    $manager->insert($post);

    // Rediriger l'internaute
    header('Location: /admin/post/read.php?id=' . $post->getId());
    http_response_code(302);
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
                <h1 class="h2">Créer un nouvel article</h1>
            </div>

            <form action="/admin/post/create.php" method="post">
                
                <?php require __DIR__ . '/_form.php'; ?>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button name="post_create" type="submit" class="btn btn-primary">
                            Enregistrer
                        </button>
                        <a href="/admin/post" class="btn btn-light">
                            Annuler
                        </a>
                    </div>
                </div>
            </form>

        </main>
    </div>
</div>

<!-- Scripts -->
<?php include PROJECT_ROOT . '/admin/includes/scripts.php'; ?>
<script src="https://cdn.tiny.cloud/1/mrjmq4qadtxpbjbrzs3dhn0fqy6m7gj28f707yykznc8dr99/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        menubar: 'edit view format table'
    });
</script>
</html>
