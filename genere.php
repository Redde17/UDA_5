<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- iconify -->
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Carica il CSS, in futuro da cambiare con un semplice <link ref="stylesheet" href="CSS/mainCSS.css"> -->
    <style>
        <?php include "CSS/mainCSS.css" ?>
    </style>

    <title>Libro</title>
</head>

<body>
    <?php
        include "navbar.php"
    ?>

    <?php
        echo $_GET["genere"];
    ?>
</body>
</html>