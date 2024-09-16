<?php
    session_start();
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    
        include "connect.php";

        include "php/func-category.php";
        $categories = get_all_categories($con);

        include "php/func-author.php";
        $authors = get_all_author($con);

        if ($_GET['title']) {
            # code...
        }

        //print_r($categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter livres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-light"> 
            <div class="container-fluid">
                <a class="navbar-brand" href="admin.php">Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="add-book.php">Ajouter Livre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-category.php">Ajouter category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-author.php">Ajouter auteur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Se déconnecter</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <form action="php/add-book.php" method="post" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem;" 
        enctype="multipart/form-data">
            <h1 class="text-center pb-5 display-4 fs-3">Ajouter un nouveau livre</h1>
            <?php
                if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($_GET['error']); ?>
                    </div>
            <?php } ?>
            <?php
                if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= htmlspecialchars($_GET['success']); ?>
                    </div>
            <?php } ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Titre du livre</label>
                <input type="text" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp" name="book_title">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Description du livre</label>
                <input type="text" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp" name="book_description">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Auteur du livre</label>
                <select name="book_author" id="" class="form-control mb-3">
                    <option value="0">Sélection de l'auteur</option>
                    <?php
                        if ($authors == 0) {
                            # code...
                        } else {
                            foreach ( $authors as $author) { ?>
                            # code...
                            <option value="<?=$author['id']?>"><?=$author['name']?></option>
                    <?php } } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Categorie du livre</label>
                <select name="book_category" id="" class="form-control mb-3">
                    <option value="0">Sélection de categorie</option>
                    <?php
                        if ($categories == 0) {
                            # code...
                        } else {
                            foreach ( $categories as $categorie) { ?>
                            # code...
                            <option value="<?=$categorie['id']?>"><?=$categorie['name']?></option>
                    <?php } } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Couverture du livre</label>
                <input type="file" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp" name="book_cover">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fichier</label>
                <input type="file" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp" name="file">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter livre</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</body>
</html>

<?php
    } else {
        header("Location: login.php");
        exit;
    }
?>