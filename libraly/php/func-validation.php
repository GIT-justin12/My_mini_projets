<?php
#Validation function
function is_empty($var, $text, $location, $ms, $data) {
    if (empty($var)) {
        $em = "Le champ ".$text." est requise !";
        header("location: $location?$ms=$em&$data");
        exit;
    }
    return 0;
}
?>