<?php
    $sName = "localhost";
    $uName = "root";
    $pass = "";
    $db = "library";

    try{
        $con = new PDO("mysql:host=$sName;dbname=$db", $uName, $pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection échouée: ". $e->getMessage();
    }
?>