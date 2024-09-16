<?php
#Get all books function
function get_all_categories($con) {
    $sql = "SELECT * FROM categorie";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $categories = $stmt->fetchAll();
    } else {
        $categories = 0;
    }

    return $categories;
}
?>