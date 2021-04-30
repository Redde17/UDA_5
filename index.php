<?php
session_start();

if(!isset($_SESSION["language"])){
    $_SESSION["language"] = "it";
}

//test variable
$_SESSION["language"] = "eng";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    

    <!-- iconify -->
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Carica il CSS, in futuro da cambiare con un semplice <link ref="stylesheet" href="CSS/mainCSS.css"> -->
    <style>
        <?php include "CSS/mainCSS.css" ?>
    </style>

    <title>MainPage</title>
</head>

<body>
    <?php
    include "PHP/connection.php";
    $conn = connection("biblioteca");
    
    //query

    $SQLfeatured = "SELECT libro.ID, libro.Immagine, libro.Titolo, autore.Nome, autore.Cognome
                        FROM libro, autore
                        WHERE Libro.ID = (SELECT ID_Libro
                                            FROM prestare
                                            GROUP BY ID_Libro
                                            ORDER BY COUNT(*) DESC
                                            LIMIT 1
                                        ) 
                        AND libro.ID_Autore = autore.ID";

    //temp query
    $SQLVari = "SELECT libro.ID, libro.Titolo, libro.Immagine, autore.Nome, autore.Cognome 
                            FROM libro, autore
                            WHERE libro.ID_Autore = autore.ID
                            ORDER BY RAND()";

    $SQLrecenti = "SELECT libro.ID, libro.Titolo, libro.Immagine, autore.Nome, autore.Cognome 
                        FROM libro, autore 
                        WHERE libro.ID_Autore = autore.ID
                        ORDER BY libro.ID DESC";

    $SQLconsigliati = "SELECT libro.ID, libro.Titolo, libro.Immagine, autore.Nome, autore.Cognome 
                            FROM libro, autore 
                            WHERE libro.ID_Autore = autore.ID";


    //navbar
    include "./PHP/Navbar.php";

    //Login form riutilizzabile
    include "loginForm.html";
    ?>

    <!-- Featured book -->
    <div class="d-flex justify-content-center align-items-center mt-5" style="background-color: #F7F7F7; height: 342px;">
        <!-- immagine -->
        <?php
        $result = $conn->query($SQLfeatured);
        $row = $result->fetch_assoc();
        ?>
        <div class="parent">
            <img class="image1" src="resources\bookCover.png" alt="copertina libro" width="306px" height="407px">
            <img class="image2" src="img\<?php echo $row['Immagine'] ?>" alt="copertina libro" width="220px" height="365px">
        </div>

        <?php echo "<script> console.log('" . $row['ID'] . "')</script>" ?>

        <!-- testo -->
        <div>
            <p class="mb-0" id="BestsellerTitle"> <?php echo $row["Titolo"] ?> </p>
            <p class="text-truncate R-textSmall" style="font-size: 20px;">By: <?php echo $row["Nome"] . " " . $row["Cognome"] ?> </p>
            <!--Qui ci vanno le Stelle se le facciamo-->
            <form action="book.php" method="GET">
                <input type="hidden" name="ID" value="<?php echo $row['ID'] ?>">
                <button type="submit" class="R-btn" style="margin-top: 50px;"><span class="iconify icona_invio" data-icon="icomoon-free:books" data-inline="false" style="color: white;"></span><?php if($_SESSION["language"] == "it"){ echo "Vai alla pagine del libro"; }else{ echo "Visit the book page"; } ?></button>
            </form>
        </div>
    </div>

    <!-- Fila delle categorie -->
    <div class="d-flex flex-row mt-5 justify-content-center align-items-center" style="height: 75px; background-color: #F7F8FC;">
        <!-- Genere1 -->
        <div class="col-sm d-flex justify-content-center align-items-center">
            <div class="categoryBall d-flex justify-content-center align-items-center" style="background-color: #93648D;">
                <span class="iconify categoryIcon" data-icon="mdi:feather" data-inline="false" style="color: white;"></span>
            </div>
            <a href="genere.php?genere=Romanzi" id="aRomanzi">
                <p class="categoryText" style="color: #93648D;"><?php if($_SESSION["language"] == "it"){ echo "Romanzi"; }else{ echo "Novels"; } ?></p>
            </a>
        </div>
        <div class="vl float-right ml-5"></div>
        <!-- Genere2 -->
        <div class="col-sm d-flex justify-content-center align-items-center">
            <div class="categoryBall d-flex justify-content-center align-items-center" style="background-color: #4CC3D9;">
                <span class="iconify categoryIcon" data-icon="raphael:wrench" data-inline="false" style="color: white;"></span>
            </div>
            <a href="genere.php?genere=Tecnica" id="aTecnica">
                <p class="categoryText" style="color: #4CC3D9;"><?php if($_SESSION["language"] == "it"){ echo "Tecnica"; }else{ echo "Technology"; } ?></p>
            </a>
        </div>
        <div class="vl float-right ml-5"></div>
        <!-- Genere3 -->
        <div class="col-sm d-flex justify-content-center align-items-center">
            <div class="categoryBall d-flex justify-content-center align-items-center" style="background-color: #7BC8A4;">
                <span class="iconify categoryIcon" data-icon="ph:pen-nib-fill" data-inline="false" style="color: white;"></span>
            </div>
            <a href="genere.php?genere=Poesie" id="aPoesie">
                <p class="categoryText" style="color: #7BC8A4;"><?php if($_SESSION["language"] == "it"){ echo "Poesia"; }else{ echo "Poetry"; } ?></p>
            </a>
        </div>
        <div class="vl float-right ml-5"></div>
        <!-- Genere4 -->
        <div class="col-sm d-flex justify-content-center align-items-center">
            <div class="categoryBall d-flex justify-content-center align-items-center" style="background-color: #F16745;">
                <span class="iconify categoryIcon" data-icon="wpf:mouse" data-inline="false" style="color: white;"></span>
            </div>
            <a href="genere.php?genere=Informatica" id="aInformatica">
                <p class="categoryText" style="color: #F16745;"><?php if($_SESSION["language"] == "it"){ echo "Informatica"; }else{ echo "IT"; } ?></p>
            </a>
        </div>
        <div class="vl float-right ml-5"></div>
        <!-- Genere5 -->
        <div class="col-sm d-flex justify-content-center align-items-center">
            <div class="categoryBall d-flex justify-content-center align-items-center" style="background-color: #E6E02F;">
                <span class="iconify categoryIcon" data-icon="fa-solid:dragon" data-inline="false" style="color: white;"></span>
            </div>
            <a href="genere.php?genere=Fantasy" id="aFantasy">
                <p class="categoryText" style="color: #E6E02F;">Fantasy</p>
            </a>
        </div>
        <div class="vl float-right ml-5"></div>
        <!-- Genere6 -->
        <div class="col-sm d-flex justify-content-center align-items-center">
            <div class="categoryBall d-flex justify-content-center align-items-center" style="background-color: #4949D2;">
                <span class="iconify categoryIcon" data-icon="ri:file-paper-2-line" data-inline="false" style="color: white;"></span>
            </div>
            <a href="genere.php?genere=Poema" id="aPoema">
                <p class="categoryText" style="color: #4949D2;"><?php if($_SESSION["language"] == "it"){ echo "Poema"; }else{ echo "Poem"; } ?></p>
            </a>
        </div>
        <div class="vl float-right ml-5"></div>
        <!-- Genere7 -->
        <div class="col-sm d-flex justify-content-center align-items-center">
            <div class="categoryBall d-flex justify-content-center align-items-center" style="background-color: #DF5EC5;">
                <span class="iconify categoryIcon" data-icon="bi:stars" data-inline="false" style="color: white;"></span>
            </div>
            <a href="genere.php?genere=Nuovi" id="aNuovi">
                <p class="categoryText" style="color: #DF5EC5;"><?php if($_SESSION["language"] == "it"){ echo "Nuovi"; }else{ echo "News"; } ?></p>
            </a>
        </div>
    </div>


    <!-- Bestsellers -->
    <!-- riga dei libri-->
    <div class="divBook mt-5">
        <div style="width: 100%; height: 50px;">
            <!-- Scritta categoria -->
            <h4 class="float-left divBookTitolo"><?php if($_SESSION["language"] == "it"){ echo "Scopri i nostri libri"; }else{ echo "Discover our books"; } ?></h4>

            <!-- Tasti per lo scroll -->
            <div class="float-right" style="margin-right: 10px;">
                <button class="round-btn" id="slideBack" type="button" onclick="atc('LT', 'Bestsellers')">
                    <span class="iconify R-grey R-Hwhite arrowButton" data-icon="eva-arrow-ios-back-fill" data-inline="false"></span>
                </button>
                <button class="round-btn" id="slide" type="button" onclick="atc('RX', 'Bestsellers')">
                    <span class="iconify R-grey R-Hwhite arrowButton" data-icon="eva-arrow-ios-forward-fill" data-inline="false"></span>
                </button>
            </div>
        </div>

        <!-- Riga di spacco -->
        <div class="brk" style="margin-bottom: 20px;"></div>

        <!-- Libri -->
        <div id='Bestsellers' class="d-flex flex-row R-flowRow" style="width: 100%;">
            <?php
            $result = $conn->query($SQLVari);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $catSql = "SELECT categoria.Nome 
                            FROM categoria, appartiene 
                            WHERE " . $row['ID'] . " = appartiene.ID_Libro
                            AND appartiene.Nome_Categoria = categoria.Nome";
                    $catResult = $conn->query($catSql);

                    echo '
                        <div id="content" class="container p-0 m-0 ml-4">
                            <div>
                                <!-- immagine -->
                                <img src="./img/' . $row['Immagine'] . '" alt="FotoLibro" width="167" height="233">
                        
                                <!-- categorie -->
                                <p class="text-truncate R-textSmall">';

                    if ($catResult->num_rows > 0) {
                        while ($catRow = $catResult->fetch_assoc()) {
                            echo $catRow["Nome"] . ", ";
                        }
                    } else {
                        echo "Undefined";
                    }

                    echo '</p>
                        
                                <!-- linea per separare -->
                                <div class="brk"></div>

                        
                                <!-- Titolo -->
                                <div> 
                                    <p class="text-truncate R-textMedium"><a href="book.php?ID=' . $row['ID'] . '">' . $row['Titolo'] . '</a></p>
                                </div>
                        
                                <!-- Autore -->
                                <div style="padding-bottom: 0px;">
                                    <p class="text-truncate R-textSmall">By: ' . $row['Nome'] . ' ' . $row['Cognome'] . '</p>
                                </div>
                            </div>      
                        </div>
                    ';
                }
            } else {
                echo 'nessuna riga trovata';
            }

            ?>

            <br>
        </div>
    </div>

    <!-- Aggiunti di recente -->
    <!-- riga dei libri -->
    <div class="divBook mt-5">
        <div style="width: 100%; height: 50px;">
            <!-- Scritta categoria -->
            <h4 class="float-left divBookTitolo"><?php if($_SESSION["language"] == "it"){ echo "Aggiunti di recente"; }else{ echo "Added recently"; } ?></h4>

            <!-- Tasti per lo scroll -->
            <div class="float-right" style="margin-right: 10px;">
                <button class="round-btn" id="slideBack" type="button" onclick="atc('LT', 'Recenti')">
                    <span class="iconify R-grey R-Hwhite arrowButton" data-icon="eva-arrow-ios-back-fill" data-inline="false"></span>
                </button>
                <button class="round-btn" id="slide" type="button" onclick="atc('RX', 'Recenti')">
                    <span class="iconify R-grey R-Hwhite arrowButton" data-icon="eva-arrow-ios-forward-fill" data-inline="false"></span>
                </button>
            </div>
        </div>

        <!-- Riga di spacco -->
        <div class="brk" style="margin-bottom: 20px;"></div>

        <!-- Libri -->
        <div id='Recenti' class="d-flex flex-row R-flowRow" style="width: 100%;">
            <?php

            $result = $conn->query($SQLrecenti);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $catSql = "SELECT categoria.Nome 
                            FROM categoria, appartiene 
                            WHERE " . $row['ID'] . " = appartiene.ID_Libro
                            AND appartiene.Nome_Categoria = categoria.Nome";
                    $catResult = $conn->query($catSql);

                    echo '
                        <div id="content" class="container p-0 m-0 ml-4">
                            <div>
                                <!-- immagine -->
                                <img src="./img/' . $row['Immagine'] . '" alt="FotoLibro" width="167" height="233">
                        
                                <!-- categorie -->
                                <p class="text-truncate R-textSmall">';

                    if ($catResult->num_rows > 0) {
                        while ($catRow = $catResult->fetch_assoc()) {
                            echo $catRow["Nome"] . ", ";
                        }
                    } else {
                        echo "Undefined";
                    }

                    echo '</p>
                        
                                <!-- linea per separare -->
                                <div class="brk"></div>

                        
                                <!-- Titolo -->
                                <div> 
                                    <p class="text-truncate R-textMedium"><a href="book.php?ID=' . $row['ID'] . '">' . $row['Titolo'] . '</a></p>
                                </div>
                        
                                <!-- Autore -->
                                <div style="padding-bottom: 0px;">
                                    <p class="text-truncate R-textSmall">By: ' . $row['Nome'] . ' ' . $row['Cognome'] . '</p>
                                </div>
                            </div>      
                        </div>
                    ';
                }
            } else {
                echo 'nessuna riga trovata';
            }

            ?>

            <br>
        </div>

        <!--
        PotrebberoPiacerti
        riga dei libri
        <div class="divBook mt-5">
            <div style="width: 100%; height: 50px;">
                Scritta categoria
                <h4 class="float-left divBookTitolo">Potrebbero piacerti</h4>

                Tasti per lo scroll
                <div class="float-right" style="margin-right: 10px;">
                    <button class="round-btn" id="slideBack" type="button" onclick="atc('LT', 'Consigliati')">
                        <span class="iconify R-grey R-Hwhite arrowButton" data-icon="eva-arrow-ios-back-fill" data-inline="false"></span>
                    </button>
                    <button class="round-btn" id="slide" type="button" onclick="atc('RX', 'Consigliati')">
                        <span class="iconify R-grey R-Hwhite arrowButton" data-icon="eva-arrow-ios-forward-fill" data-inline="false"></span>
                    </button>
                </div>
            </div>

            Riga di spacco
            <div class="brk" style="margin-bottom: 20px;"></div>

            Libri
            <div id='Consigliati' class="d-flex flex-row R-flowRow" style="width: 100%;">
                <?php

                // $result = $conn->query($SQLconsigliati);

                // if ($result->num_rows > 0) {
                //     while ($row = $result->fetch_assoc()) {

                //         $catSql = "SELECT categoria.Nome 
                //             FROM categoria, appartiene 
                //             WHERE " . $row['ID'] . " = appartiene.ID_Libro
                //             AND appartiene.Nome_Categoria = categoria.Nome";
                //         $catResult = $conn->query($catSql);

                //         echo '
                //         <div id="content" class="container p-0 m-0 ml-4">
                //             <div>
                //                 <!-- immagine -->
                //                 <img src="./img/' . $row['Immagine'] . '" alt="FotoLibro" width="167" height="233">
                        
                //                 <!-- categorie -->
                //                 <p class="text-truncate R-textSmall">';

                //         if ($catResult->num_rows > 0) {
                //             while ($catRow = $catResult->fetch_assoc()) {
                //                 echo $catRow["Nome"] . ", ";
                //             }
                //         } else {
                //             echo "Undefined";
                //         }

                //         echo '</p>
                        
                //                 <!-- linea per separare -->
                //                 <div class="brk"></div>

                        
                //                 <!-- Titolo -->
                //                 <div> 
                //                     <p class="text-truncate R-textMedium"><a href="book.php?ID=' . $row['ID'] . '">' . $row['Titolo'] . '</a></p>
                //                 </div>
                        
                //                 <!-- Autore -->
                //                 <div style="padding-bottom: 0px;">
                //                     <p class="text-truncate R-textSmall">By: ' . $row['Nome'] . ' ' . $row['Cognome'] . '</p>
                //                 </div>
                //             </div>      
                //         </div>
                //     ';
                //     }
                // } else {
                //     echo 'nessuna riga trovata';
                // }

                ?>

                <br>
            </div>
        </div>
    </div>
    -->
    
    <!-- footer -->
    <footer>
        <div class="container-fluid mt-5 p-0" style="height: 180px; background-color: #F7F7F7; border-top: 2px solid #77B748;">
            <div class="container-fluid mt-4" style="height: 160px; background-color: #484848;">
            </div>
        </div>
    </footer>

    <script src="scripts.js"></script>
   
    <style>
        .image1 {
            position: relative;
            top: 0;
            left: 0;
        }

        .image2 {
            position: absolute;
            top: 10px;
            left: 64px;
            transform: perspective(400px) rotateY(10deg);
        }
    </style>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>