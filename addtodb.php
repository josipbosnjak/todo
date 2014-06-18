<?php

include("db.php");

$name = $_POST['name'];
$price = $_POST['price'];


$sql = "INSERT INTO todo.items (name,price, category) VALUES (:name, :price, 'new')";
try {
    //$dbh->beginTransaction();
    $q = $dbh->prepare($sql);
    $q->execute(array(
        ':name' => $name,
        ':price' => $price));
    $result = array('id'=>$dbh->lastInsertId());
    echo json_encode($result);
} catch (PDOException $e) {
    echo '\nQuery failed: ' . $e->getMessage();
}