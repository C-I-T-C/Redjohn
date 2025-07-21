<?php

    $server = "localhost";
    $usernmae = "root";
    $password = "";
    $dbname = "project";

    global $pdo;

    try{

        $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);

        $pdo = new PDO("mysql:host=$server;dbname=$dbname",$usernmae,$password,$option);

        return $pdo;

    }catch(PDOException $e){
        echo "Error : " . $e->getmessage();
        exit;
    }


?>