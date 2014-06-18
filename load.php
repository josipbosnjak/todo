<?php

include("db.php");

$sql = "SELECT * FROM todo.items";

try {
    $q = $dbh->prepare($sql);
    $q->execute();
    $result = $q->fetchAll();
    echo json_encode($result, JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    echo '\nQuery failed: ' . $e->getMessage();
}