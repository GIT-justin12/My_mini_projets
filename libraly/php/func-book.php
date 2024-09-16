<?php
#Get all books function
function get_all_books($con) {
    $sql = "SELECT * FROM book ORDER BY id DESC";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $books = $stmt->fetchAll();
    } else {
        $books = 0;
    }

    return $books;
}
?>