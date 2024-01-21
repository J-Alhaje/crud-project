<?php
session_start();
include 'db-connection.php';
global $db;
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $query = $db->prepare('DELETE FROM cars WHERE id = :id');
    $query->bindParam('id', $id);
    if ($query->execute()) {
        $_SESSION['UserMessage'] = "<div class='alert alert-danger alert-dismissible fade show fs-4 fw-bold' role='alert'>De car is verwijderd</div>";
    } else {
        $_SESSION['UserMessage'] = "Er is iets mis gegaan";
    }
    header("Location: index.php");
} else {
    die("Error: id is not correct");
}


