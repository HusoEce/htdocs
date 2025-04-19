<?php
    $host = "localhost";
    $dbname = "tekno";
    $username = "root";
    $password = "";

    try {
        $db = new PDO("mysql:host=$host; port=3307; dbname=$dbname;", $username, $password);
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){}
?>