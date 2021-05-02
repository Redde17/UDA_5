<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="shortcut icon" href="resources/favicon.ico" type="image/x-icon">
    <!--
    <link ref="Custom stylesheet" href="CSS/mainCSS.css">
    -->
    <title>Generi</title>
</head>
<body>
    <style>
        <?php include "CSS/mainCSS.css" ?>
        .image1 {
            position: relative;
            top: 0;
            left: 0;
        }

        .image2 {
            position: absolute;
            top: 10px;
            left: 80px;
            transform: perspective(400px) rotateY(10deg);
        }

        .divider{
            height: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
        }
        .intro{
            height: 50px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            color: #B0B0B0;
        }
    </style>

    <?php
        //Connessione Database
        include "./PHP/connection.php";
        $conn = connection("biblioteca");

        //Preleviamo Genere
        $Genere = $_GET["genere"];
        
        //Query
        $DQL_libri = "";

        if($Genere == "Nuovi" ){
            $DQL_libri .= "SELECT libro.ID, libro.Titolo,libro.Numero_Copie, libro.Immagine, autore.Nome, autore.Cognome, editore.Nome AS editore
                            FROM libro, autore,editore
                            WHERE libro.ID_Autore = autore.ID
                                AND libro.Codice_Editore = editore.Codice
                            ORDER BY libro.ID DESC
                            LIMIT 10";
        }else {
            $DQL_libri .= " SELECT libro.ID, libro.Titolo,libro.Numero_Copie, libro.Immagine, autore.Nome, autore.Cognome, editore.Nome AS editore
                            FROM libro, autore, appartiene, editore
                            WHERE libro.ID_Autore = autore.ID
                                AND libro.Codice_Editore = editore.Codice
                                AND libro.ID = appartiene.ID_Libro
                                AND appartiene.Nome_Categoria = '".$Genere."'
                            ORDER BY libro.Titolo DESC";
        }


        $result = $conn->query($DQL_libri);


        //Navbar
        include "./PHP/Navbar.php";

        //Login Form
        include "loginForm.html";
    ?>

    <div class="container">

        <div class=" intro">
                <div>
                    <h1><?php echo $Genere;?></h1>
                    
                </div>
            </div>
        
        
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
        <div class="row d-flex justify-content-md-center">
    
            <div class="col-4 parent overflow-hidden">
                <img class="image1" src="resources\bookCover.png" alt="copertina libro" width="306px" height="407px">
                <img class="image2" src="img\<?php echo $row['Immagine'] ?>" alt="copertina libro" width="220px" height="365px">
            </div>

            

            <!-- testo -->
            <div class="col-8 overflow-hidden">
                <p class="mb-0" id="BestsellerTitle"> <?php echo $row["Titolo"] ?> </p>
                
                <p class="text-truncate R-textSmall R-noMP" style="font: normal normal 300 20px/27px Segoe UI;">By: <?php echo $row["Nome"] . " " . $row["Cognome"] ?> </p>

                <p class="text-truncate R-textSmall R-noMP" style="font: normal normal 300 20px/27px Segoe UI;">Editore: <?php echo $row["editore"] ?> </p>
                
                <!--Qui ci vanno le Stelle se le facciamo-->
                <div class="d-flex d-row align-items-center mt-5 " style="height: 50px;">
                    <p class="R-textSmall R-noMP" style="font: normal normal 300 20px/27px Segoe UI;">Disponibili:</p>
                    <div class="d-flex justify-content-center align-items-center fakeBtn mr-2 ml-1" style="width: 49px; height: 47px;">
                        <p class="R-TextSpecial mb-1"><?php echo $row["Numero_Copie"] ?></p>
                    </div>
                    <form action="book.php" method="GET">
                        <input type="hidden" name="ID" value="<?php echo $row['ID'] ?>">
                        <button type="submit" class="R-btn" ><span class="iconify icona_invio" data-icon="icomoon-free:books" data-inline="false" style="color: white;"></span> Vai alla pagina del libro</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        
        <?php
                }
            }else{
        ?>
            <div>
                    <h1 style="text-align: center;">
                        <?php
                            if($_SESSION["language"] == "it"){
                                 echo "Non sono presenti libri per questo genere"; 
                            }else{
                                echo "There are no books for this literary genre"; 
                            }
                        ?>
                    </h1>     
            </div>
        <?php
            }
        ?>
    </div>

    <script src="scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>