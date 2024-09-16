<?php
session_start();
    if (isset($_POST['email']) && isset($_POST['password'])) {

        include "../connect.php";

        include "func-validation.php";

        $email = $_POST['email'];
        $password = $_POST['password'];

        #simle from validation
        $text = "Email";
        $location = "../login.php";
        $ms = "error";

        is_empty($email, $text, $location, $ms, "");

        $text = "Password";
        $location = "../login.php";
        $ms = "error";
        is_empty($password, $text, $location, $ms, "");

        # Search for email
        $sql = "SELECT * FROM admin WHERE email =?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$email]);

        #if the email exist
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();

            $user_id = $user['id'];
            $user_email = $user['email'];
            $user_password = $user['password'];

            if ($email === $user_email) {
                if (password_verify($password, $user_password)) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                    header("Location: ../admin.php");
                } else {
                    $em = "Mot de passe ou email incorrecte";
                    header("Location: ../login.php?error=$em");
                }

            } else {
                $em = "Mot de passe ou email incorrecte";
                header("Location: ../login.php?error=$em");
            }
        } else {
            $em = "Mot de passe ou email incorrecte";
            header("Location: ../login.php?error=$em");
        }

    } else {
        header("Location: ../login.php");
    }
?>