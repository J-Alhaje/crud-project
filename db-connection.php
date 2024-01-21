<?php


try {

    $db = new PDO("mysql:host=localhost;dbname=oefenen-crud;", 'root', '');
} catch (PDOException $e) {
    die("Erorr :" . $e->getMessage());
}


