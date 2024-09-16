<?php
    session_start();
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    
        include "connect.php";

        include "php/func-book.php";
        $books = get_all_books($con);

        include "php/func-author.php";
        $authors = get_all_author($con);

        include "php/func-category.php";
        $categories = get_all_categories($con);

        //print_r($categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-light"> 
            <div class="container-fluid">
                <a class="navbar-brand active" href="admin.php">Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-book.php">Ajouter Livre</a>
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
        <?php if ($books == 0) { ?>
            empty
        <?php } else {?>
        <h4>Livres</h4>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                    <th>Categorie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!--List all books-->
                <?php
                    $i = 0;
                    foreach ($books as $book) {
                        $i++;
                    ?>
                <tr>
                    <td><?=$i ?></td>
                    <td>
                        <img src="uploads/cover/<?=$book['cover']?>" alt="" width="100">
                        <a class="link-dark d-block text-center" href="uploads/file/<?=$book['file'] ?>">
                            <?=$book['title'] ?>
                        </a>
                    </td>
                    <td>
                        <?php if ($authors == 0){
                            echo "Pas d'auteur";
                            } else {
                                foreach ($authors as $author) {
                                    if ($author['id'] == $book['author_id']) {
                                        # code...
                                        echo $author['name'];
                                    }
                                }
                            }
                        ?>
                    </td>
                    <td><?=$book['description'] ?></td>
                    <td>
                    <?php if ($categories == 0){
                            echo "Pas de categorie";
                            } else {
                                foreach ($categories as $categorie) {
                                    if ($categorie['id'] == $book['category_id']) {
                                        # code...
                                        echo $categorie['name'];
                                    }
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <a href="#" class="btn btn-warning">Editer</a>
                        <a href="#" class="btn btn-danger">Retirer</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
        <?php if ($categories == 0) { ?>
            empty
        <?php } else {?>
        <!--List all categories-->
        <h4 class="mt-5">Tous les categories</h4>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Categories</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $j = 0;
                    foreach ($categories as $categorie) {
                    $j++;
                ?>
                <tr>
                    <td><?=$j ?></td>
                    <td><?=$categorie['name'] ?></td>
                    <td>
                        <a href="#" class="btn btn-warning">Editer</a>
                        <a href="#" class="btn btn-danger">Retirer</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php }?>
        <!--All authors-->
        <?php if ($authors == 0) { ?>
            empty
        <?php } else {?>
            <h4 class="mt-5">Tous les auteurs</h4>
            <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Auteurs</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $k = 0;
                    foreach ($authors as $author) {
                    $k++;
                ?>
                <tr>
                    <td><?=$k ?></td>
                    <td><?=$author['name'] ?></td>
                    <td>
                        <a href="#" class="btn btn-warning">Editer</a>
                        <a href="#" class="btn btn-danger">Retirer</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php }?>
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