<?php

include("db.php");

$deleteId = $_POST['deleteId'];

$sql = "DELETE FROM todo.items WHERE id = :deleteId";

try {
    //$dbh->beginTransaction();
    $q = $dbh->prepare($sql);
    $q->bindParam(':deleteId', $_POST['deleteId']);
    $q->execute();
} catch (PDOException $e) {
    echo '\nQuery failed: ' . $e->getMessage();
}