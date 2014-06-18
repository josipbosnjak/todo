<?php

include("db.php");

$name = $_POST['name'];

$sql = "SELECT * FROM todo.items WHERE name == :name";

try {
    $q = $dbh->prepare($sql);
    $q->execute(array(
        ':name' => $name
    ));
    $count = $q->rowCount();
    
    echo json_encode($count);
} catch (PDOException $e) {
    echo '\nQuery failed: ' . $e->getMessage();
}