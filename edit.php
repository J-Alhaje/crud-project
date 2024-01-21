<?php
include 'db-connection.php';
global $db;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $query = $db->prepare('SELECT * FROM cars WHERE id = :id');
    $query->bindParam(':id', $id);
    $query->execute();
    $car = $query->fetch(PDO::FETCH_ASSOC);
} else {
    die("Error: id is not correct");
}

$query = $db->prepare('SELECT * FROM categories');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['category'])) {
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

        if (!$price) {
            $alert = "Vul geldige getallen in";
        } else {
            //TODO: update statement
            $query = $db->prepare("UPDATE cars SET name = :name, price = :price, model = :model WHERE id = :id");
            $query->bindParam(":name", $_POST['name']);
            $query->bindParam(":price", $price);
            $query->bindParam(":model", $_POST['category']);
            $query->bindParam(":id", $id);

            if ($query->execute()) {
                header('location: index.php');
            } else {
                $alert = "Er is iets mis gegaan";
            }
        }
    } else {
        $alert = "Vul alle velden in";
    }
} else {
    $alert = "";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />

    <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Document</title>
</head>

<body>
    <form method="post">

        <div class="m-3">
            <label for="name">Name: </label>
            <input type="text" name="name" size="30px" id="name" value="<?= $car['name'] ?>">
        </div>
        <div class="m-3">
            <label for="price">Prijs: </label>
            <input type="number" name="price" id="price" step="0.01" value="<?= $car['price'] ?>">
        </div>
        <div class="m-3">
            <label for="category">Categorie</label>
            <input type="text" name="category" size="27px" id="category" value="<?= $car['Model'] ?>">
        </div>
        <div class="m-3">
            <button type="submit" name="submit" class="btn btn-warning">Verzenden</button>
        </div>
    </form>
    <?= $alert ?>
</body>

</html>