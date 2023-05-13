<?php
try  {
    require "dbconfig.php"; //database access details

    $connection = new PDO($dsn, $username, $password, $options); //create database connection and get handler

} catch(PDOException $error) {
    //if connection failed, print error and exit;
    echo "Database connection error: " . $error->getMessage() . "<BR>";
    die;
}
?>
