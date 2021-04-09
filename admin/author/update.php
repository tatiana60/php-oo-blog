<!-- Require bootstrap -->
<?php require '../../bootstrap.php';


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

if(isset($_POST['author_create'])) {
    $author->setName($_POST['name']);
    $info = $repository->update($author);

    if($info == 1) {
        header('Location: /admin/author/read.php?id='.$id);
    } else {
        http_response_code(403);
        exit();
    }
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
            <div class="pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Tableau de bord</h1>
            </div>

            <!-- TODO Add content -->
            <form method="POST" action="/admin/author/update.php?id=<?= $author->getId() ?>">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $author->getName() ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button name="author_create" type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>

        </main>
    </div>
</div>

<!-- Scripts -->
<?php include PROJECT_ROOT . '/admin/includes/scripts.php'; ?>
</html>
<?php
