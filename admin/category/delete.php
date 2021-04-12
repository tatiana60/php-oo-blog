<?php

// admin/author/delete.php

require '../../bootstrap.php';
/** @var PDO $connection */
use Repository\CategoryRepository;
// Récupérer l'auteur d'après le paramètre d'URL
// Récupérer l'identifiant dans les paramètres d'URL ($_GET)
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    http_response_code(403);
    exit();
}

$repository = new CategoryRepository($connection);

$category = $repository->findOneById($id);


// Si le formulaire a été soumis et la case de confirmation est cochée
if (isset($_POST['category_delete']) && ($_POST['confirm'] === '1')) {
    // Supprimer l'auteur de la base de données
    $info = $repository->delete($category);
    // Rediriger l'internaute vers la page index
    if($info == 1) {
        header('Location: /admin/category/index.php');
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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Supprimer l'auteur</h1>
            </div>

            <form action="/admin/category/delete.php?id=<?= $category->getId() ?>" method="post"><!-- TODO action -->
                <div class="form-group row">
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="confirm" name="confirm" value="1">
                            <label class="form-check-label" for="confirm">
                                Confirmer la suppression ?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button name="category_delete" type="submit" class="btn btn-danger" value="1">
                            Supprimer
                        </button>
                    </div>
                </div>
            </form>

        </main>
    </div>
</div>

<!-- Scripts -->
<?php include PROJECT_ROOT . '/admin/includes/scripts.php'; ?>
</html>