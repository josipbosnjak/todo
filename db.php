<?php
$hostname = 'localhost';
$username = 'root';
$password = 'root';
try {
$dbh = new PDO("mysql:host=$hostname;dbname=todo", $username, $password);
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>

