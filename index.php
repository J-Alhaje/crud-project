<?php
session_start();

include 'db-connection.php';
global $db;

$query = $db->query("SELECT * FROM cars");
$query->execute();
$cars = $query->fetchAll(PDO::FETCH_ASSOC);
?>

</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />

    <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <title>Crud toets oefenen</title>
</head>

<body>
    <!-- <img class="d-flex justify-content-center" src="https://miro.medium.com/v2/resize:fit:1400/1*2eBdh0vLZjUyCDF6x1EqvQ.png" alt=""> -->
    <?php
    if (isset($_SESSION['UserMessage'])) {
        echo $_SESSION['UserMessage'] . "<br>";
        unset($_SESSION['UserMessage']);
    } ?>
    <div class="container">
        <div class="row">
            <img src="https://miro.medium.com/v2/resize:fit:1400/1*DI5wwLcQV-b3erfLIbvfFQ.jpeg" alt="" srcset="">
            <table class="table border text-center mt-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nummer</th>
                        <th scope="col">Name</th>
                        <th scope="col">Prijs</th>
                        <th scope="col">Model</th>
                        <th scope="col">Edit</th>
                        <th scope="col">details</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($cars as $car): ?>
                        <tr>
                            <th>
                                <?= $car['id'] ?>
                            </th>
                            <th>
                                <?= $car['name'] ?>
                            </th>
                            <th>
                                <?= $car['price'] ?>
                            </th>
                            <th>
                                <?= $car['Model'] ?>
                            </th>
                            <td><a class="btn btn-warning" href="edit.php?id=<?= $car['id'] ?>"><i
                                        class="bi bi-pencil-square"></i> Edit</td>
                            <td><a class="btn btn-success" href="details.php?id=<?= $car['id'] ?>">
                                    <i class="bi bi-search-heart-fill"> Details</a></i></td>
                            <td><a class="btn btn-danger" href="delete.php?id=<?= $car['id'] ?>"><i
                                        class="bi bi-file-earmark-x"> delete</a></i></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col">
                    <a href="insert.php"><button type="button" class="btn btn-primary"><i
                                class="bi bi-file-plus">Toevoegen</button></i></a>
                </div>
            </div>
        </div>
    </div>










    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>

</html>