<?php

include("db.php");

$category = $_POST['category'];
$elementId = $_POST['elementId'];

$sql = "UPDATE todo.items SET category = :category WHERE id = :elementId";

try {
    $q = $dbh->prepare($sql);
    $q->execute(array(
        ':category' => $category,
        ':elementId' => $elementId
    ));
} catch (PDOException $e) {
    echo '\nQuery failed: ' . $e->getMessage();
}

