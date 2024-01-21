<?php
include 'db-connection.php';
global $db;
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $query = $db->prepare('SELECT * FROM cars WHERE id = :id');
    $query->bindParam('id', $id);
    $query->execute();
    $car = $query->fetch(PDO::FETCH_ASSOC);
} else {
    die("Error: id is not correct");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />

    <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Car Details</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <table class="table border">
                <thead class="table-dark">
                    <tr>
                        <th scope="row">Artikel numer</th>
                        <th scope="rows">Name</th>
                        <th scope="row">Prijs</th>
                        <th scope="rows">Model</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <?= $car["id"] ?>
                        </th>
                        <th>
                            <?= $car["name"] ?>
                        </th>
                        <th>
                            <?= $car["price"] ?>
                        </th>
                        <th>
                            <?= $car["Model"] ?>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mx-0">
            <a href="index.php" class="btn btn-primary d-block-inline">ga terug</a>
        </div>
    </div>
</body>

</html>