<?php
session_start();
include 'db-connection.php';

global $db;

$query = $db->prepare('SELECT * FROM categories');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);



if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['category'])) {
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        if (!$price) {
            $alert = "Vul een geldige nummer in";
        } else {
            $query = $db->prepare("INSERT INTO cars (name,price,Model) values (:name,:price,:Model_car)");
            $query->bindParam('name', $_POST['name']);
            $query->bindParam('price', $price);
            $query->bindParam('Model_car', $_POST['category']);
            if ($query->execute()) {
                header("location: index.php");
                $_SESSION['UserMessage'] = "<div class='alert alert-primary text-danger fw-bold alert-dismissible fade show' role='alert'>U heeft een nieuwe artikel toegevoegd</div>";
            } else {
                $alert = "Er is iets mis gegaan!";
            }
        }
    } else {
        $alert = "Vul alle velden in!";
    }
} else {
    $alert = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />

    <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <title>Toevoegen pagina</title>
</head>

<body>

    <form method="post">

        <div class="m-3">
            <label for="name">Name: </label>
            <input type="text" name="name" id="name">
        </div>
        <div class="m-3">
            <label for="price">Prijs: </label>
            <input type="number" name="price" id="price" step="0.01">
        </div>
        <div class="m-3">
            <label for="category">Categorie</label>
            <input type="text" name="category" id="category">
        </div>


        <button type="submit" name="submit" class="btn btn-primary">Verzenden</button>
    </form>
    <?php
    if ($alert) {
        echo "<div class='alert alert-danger alert-dismissible' role='alert'>$alert</div>";
    } ?>






    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>

</html>