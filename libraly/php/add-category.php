<?php
    session_start();
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

        include "../connect.php";

        #check if categoryr name is submit
        if (isset($_POST['category_name'])) {
            $name = $_POST['category_name'];
            if (empty($name)) {
                $em = "Veuillez entrer le nom de la categorie";
                header("Location: ../add-category.php?error=$em");
                exit;
            } else {
                #Insection  dans la base
                $sql = "INSERT INTO categorie(name) VALUES(?)";
                $stmt = $con->prepare($sql);
                $res = $stmt->execute([$name]);

                #Si y a pas error alors inssertion dans la base
                if ($res) {
                    # Message de sucess
                    $sm = "Créer avec sucèss";
                    header("Location: ../add-category.php?success=$sm");
                } else {
                    $em = "Une erreur s'est produit !";
                    header("Location: ../add-category.php?error=$em");
                    exit;
                }
            }
        } else {
            header("Location: ../admin.php");
            exit;
        }
    } else {
    header("Location: login.php");
    exit;
}
?>