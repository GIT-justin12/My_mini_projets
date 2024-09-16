<?php
    #File upload helper function
    function upload_file($files, $allowed_exs, $path) {
        #get data and store them in var
        $file_name = $files['name'];
        $tmp_name = $files['tmp_name'];
        $error = $files['error'];

        #if there is no error occured while uploading
        if ($error === 0) {
            #Get file extension store it in var
            $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);

            #Convert the file extension into lower case and store it in var
            $file_ex_lc = strtolower($file_ex);

            #Check if the file extension exist in $allowed_exs array
            if (in_array($file_ex_lc, $allowed_exs)) {
                #Renaming the file with random strings
                $new_file_name = uniqid("",true).'.'.$file_ex_lc;

                #Assigning upload path
                $file_upload_path = '../uploads/'.$path.'/'.$new_file_name;
                
                #Moving uploaded file to root directory upload/$path folder
                move_uploaded_file($tmp_name, $file_upload_path);

                #Creating success message associative array with named keys status and data
                $sm['status'] = 'Success';
                $sm['data'] = $new_file_name;

                #Return the em array
                return $sm;

            } else {
                 /* Creating error message associative array with named keys status and data */
                $em['status'] = 'error';
                $em['data'] = "Vous ne pouvez pas télécharger le fichier en se type.";


                #Return the em array
                return $em;
            }
        } else {
            /* Creating error message associative array with named keys status and data */
            $em['status'] = 'error';
            $em['data'] = "Une erreur s'est produit.";

            #Return the em array
            return $em;
        }
    }
?>