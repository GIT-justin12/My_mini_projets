<?php
    session_start();
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

        include "../connect.php";

        #check if author name is submit
        if (isset($_POST['author_name'])) {
            $name = $_POST['author_name'];
            if (empty($name)) {
                $em = "Veuillez entrer le nom de l'auteur";
                header("Location: ../add-author.php?error=$em");
                exit;
            } else {
                #Insection  dans la base
                $sql = "INSERT INTO author(name) VALUES(?)";
                $stmt = $con->prepare($sql);
                $res = $stmt->execute([$name]);

                #Si y a pas error alors inssertion dans la base
                if ($res) {
                    # Message de sucess
                    $sm = "Créer avec sucèss";
                    header("Location: ../add-author.php?success=$sm");
                } else {
                    $em = "Une erreur s'est produit !";
                    header("Location: ../add-author.php?error=$em");
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