<?php
    session_start();
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

        include "../connect.php";

        include  "func-validation.php";

        #File upload helper function
        include  "func-file-upload.php";

        #check if author name is submit
            if (isset($_POST['book_title']) && isset($_POST['book_description']) && isset($_POST['book_category']) && isset($_POST['book_author']) 
            && isset($_FILES['book_cover']) && isset($_FILES['file'])) {
                $title = $_POST['book_title'];
                $description = $_POST['book_description'];
                $category = $_POST['book_category'];
                $author = $_POST['book_author'];
                //$cover = $_FILES['book_cover'];
                //$file = $_FILES['file'];

                #Making URL data format
                $user_input = 'title='.$title.'&category='.$category.'&desc='.$description;

                #Simple form validation
                $text = "titre du livre";
                $location = "../add-book.php";
                $ms = "error";

                is_empty($title, $text, $location, $ms, $user_input);

                #Simple form validation
                $text = "description";
                $location = "../add-book.php";
                $ms = "error";

                is_empty($description, $text, $location, $ms, $user_input);

                #Simple form validation
                $text = "auteur du livre";
                $location = "../add-book.php";
                $ms = "error";
    
                is_empty($author, $text, $location, $ms, $user_input);

                #Simple form validation
                $text = "categorie du livre";
                $location = "../add-book.php";
                $ms = "error";
    
                is_empty($category, $text, $location, $ms, $user_input);

                # Book cover uploading
                $allowed_image_exs = array("jpg", "jpeg", "png");
                $path = "cover";
                $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

                #If error occurred while uploading the book cover
                if ($book_cover['status'] == "error") {
                    $em = $book_cover['data'];
                    #Redirect to '../add-book.php' and passing error message & user_input
                    header("Location: ../add-book.php?error=$em&$user_input");
                    exit;
                } else {
                    # File uploading
                    $allowed_file_exs = array("pdf", "docx", "pptx");
                    $path = "file";
                    $file = upload_file($_FILES['file'], $allowed_file_exs, $path);
                    #If error occurred while uploading the file
                    if ($file['status'] == "error") {
                        $em = $file['data'];
                        #Redirect to '../add-book.php' and passing error message & user_input
                        header("Location: ../add-book.php?error=$em&$user_input");
                        exit;
                    } else {
                        #Getting the new file and cover name
                        $file_URL = $file['data'];
                        $book_cover_URL = $book_cover['data'];

                        #Insert the data into database
                        $sql = "INSERT INTO book(title, author_id, description, category_id, cover, file) VALUES(?, ?, ?, ?, ?, ?)";

                        $stmt = $con->prepare($sql);
                        $res = $stmt->execute([$title, $author, $description, $category, $book_cover_URL, $file_URL]);
        
                        #Si y a pas error alors inssertion dans la base
                        if ($res) {
                            # Message de sucess
                            $sm = "Le livre est ajoutée avec sucèss";
                            header("Location: ../add-book.php?success=$sm");
                        } else {
                            $em = "Une erreur s'est produit !";
                            header("Location: ../add-book.php?error=$em");
                            exit;
                        }
                    }
                }
                
                //echo "<pre>";
                //print_r($_FILES['book_cover']);
            } else {
                header("Location: ../admin.php");
                exit;
            }    
    } else {
    header("Location: login.php");
    exit;
}?>