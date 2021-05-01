<?php
session_start();
date_default_timezone_set('Europe/Rome');

if(!isset($_SESSION["language"])){
    $_SESSION["language"] = "it";
}
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
        <?php include "CSS/mainCSS.css" ?>body {
            overflow: hidden;
        }

        .image1 {
            position: relative;
            top: -30px;
            left: 0;
        }

        .image2 {
            position: absolute;
            top: -10px;
            left: 147px;
            transform: perspective(800px) rotateY(8deg);
        }
    </style>

    <title>Libro</title>
</head>

<body>

    <?php
    include "PHP\connection.php";
    $conn = connection("biblioteca");

    //query
    $SQLbook = "SELECT libro.*, autore.Nome as Nome_autore, autore.Cognome as Cognome_autore, editore.Nome as Nome_editore
                    FROM libro, autore, editore
                    WHERE libro.ID = " . $_GET['ID'] . "
                    AND libro.ID_Autore = autore.ID
                    AND libro.Codice_Editore = editore.Codice
                ";

    //navbar
    include "./PHP/Navbar.php";

    //login form riutilizzabile
    include "loginForm.html";
    ?>
    <script src="scripts.js"></script>

    <?php
    if (isset($_SESSION["email"])) {
        $stmt = $conn->prepare("SELECT Data_Riconsegna FROM prestare WHERE ID_Libro = ? AND Email_Utente = ? AND Data_Prestito = (SELECT MAX(Data_Prestito) FROM prestare WHERE ID_Libro = ? AND Email_Utente = ?)");
        $stmt->bind_param("isis", $_GET["ID"], $_SESSION["email"], $_GET["ID"], $_SESSION["email"]);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($ReturnDate);
        $stmt->fetch();
        $stmt->close();

        //controllo se la data di riconsegna esiste o meno
        if ($ReturnDate != NULL) {
            $stmt = $conn->prepare("SELECT EXISTS(SELECT * FROM prestare WHERE ID_Libro = ? AND Email_Utente = ? AND ? NOT BETWEEN Data_Prestito and Data_Riconsegna)");
            $current_date = date('Y-m-d h:i:s');
            $stmt->bind_param("iss", $_GET["ID"], $_SESSION["email"], $currentDate);
        } else {
            $stmt = $conn->prepare("SELECT EXISTS(SELECT * FROM prestare WHERE ID_Libro = ? AND Email_Utente = ?)");
            $stmt->bind_param("is", $_GET["ID"], $_SESSION["email"]);
        }

        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($isBooked);
        $stmt->fetch();
        $stmt->close();
    } else {
        $isBooked = false;
    }

    ?>

    <!-- Featured book -->
    <div class="d-flex justify-content-left mt-5" style="background-color: #F7F7F7; height: 569px;">

        <!-- immagine -->
        <?php
        $result = $conn->query($SQLbook);
        $row = $result->fetch_assoc();

        $catSql = "SELECT categoria.Nome, categoria.colore 
                            FROM categoria, appartiene 
                            WHERE " . $row['ID'] . " = appartiene.ID_Libro
                            AND appartiene.Nome_Categoria = categoria.Nome";
        $catResult = $conn->query($catSql);
        ?>

        <div class="parent mr-5">
            <img class="image1" src="resources\bookCover.png" alt="copertina libro" width="698px" height="925px">
            <img class="image2" src="img\<?php echo $row['Immagine'] ?>" alt="copertina libro" width="500px" height="834px">
        </div>

        <div class="d-flex flex-column">
            <!-- testo -->
            <div class="d-flex flex-column align-self-start">
                <p class="mb-0" id="BestsellerTitle"> <?php echo $row["Titolo"] ?> </p>
                <!-- categorie -->
                <p class="text-truncate R-textSmall"> 

                <div class="d-flex flex-row">
                    <?php
                    if ($catResult->num_rows > 0) {
                        while ($catRow = $catResult->fetch_assoc()) {
                            echo "
                            <div class='d-flex flex-row mr-2'>
                                <div class='d-inline-flex pr-1 pl-1' style=' background-color: " . $catRow['colore'] . "; border-radius: 5px;'>
                                    <a class='R-noMP R-tagLink' style='color: white; margin-right: 5px;' href='genere.php?genere=" . $catRow['Nome'] . "'>" . $catRow['Nome'] . "</a>
                                </div>
                                <div class='pointer' style='border-left-color: " . $catRow['colore'] . ";'></div>
                            </div>
                            ";
                        }
                    } else {
                        echo "Undefined";
                    }
                    ?>
                </div>
                </p> 
                <div>
                    <!--Qui ci vanno le Stelle se le facciamo-->
                    <!-- Nome autore -->
                    <p class="text-truncate R-textSmall R-noMP" style="font: normal normal 300 20px/27px Segoe UI;">By: <?php echo $row["Nome_autore"] . " " . $row["Cognome_autore"] ?> </p>

                    <!-- Nome Editore -->
                    <p class="text-truncate R-textSmall R-noMP" style="font: normal normal 300 20px/27px Segoe UI;"> <?php if($_SESSION["language"] == "it"){ echo "Editore:"; }else{ echo "Publisher:"; } ?> <?php echo $row["Nome_editore"] ?> </p>

                    <!-- Descrizione -->
                    <p class=" R-textMedium R-noMP" style="font: italic normal bold 20px/27px Segoe UI; width: 822px;"><?php echo $row["Descrizione"] ?> </p>
                </div>
            </div>

            <!-- Bottoni -->
            <div id="buttons" class="d-flex d-row align-items-center mt-auto mb-3" style="height: 50px;">
                <!-- Copie disponibili -->
                <p class="R-textSmall R-noMP" style="font: normal normal 300 20px/27px Segoe UI;">Disponibili:</p>
                <div class="d-flex justify-content-center align-items-center fakeBtn mr-2" style="width: 49px; height: 47px;">
                    <p class="R-TextSpecial mb-1"><?php echo $row["Numero_Copie"] ?></p>
                </div>

                <?php
                if (isset($_SESSION["logged"])) {
                    $text = "";
                    if ($isBooked || $row["Numero_Copie"] == 0) {
                        $text = "disabled";
                    }
                    echo '
                        <form action="action.php" method="POST">
                            <button type="submit" name="method" class="R-btn btn mr-2" value="3" ' . $text . '>
                                <span class="iconify icona_libro mr-2" data-icon="icomoon-free:books" data-inline="false" style="color: white;"></span>';
                                
                                if($_SESSION["language"] == "it"){ echo "Aggiungi alla libreria"; }else{ echo "Add to library"; } 
                                
                                echo '
                            </button>
                            <input type="hidden" name="ID" value="' . $_GET["ID"] . '">
                        </form>      
                        ';
                } else {
                    echo '
                        <form id="noReload">
                            <button type="submit" name="method" class="R-btn btn mr-2" value="3" onclick="Form()">
                                <span class="iconify icona_libro mr-2" data-icon="icomoon-free:books" data-inline="false" style="color: white;"></span>';

                                if($_SESSION["language"] == "it"){ echo "Aggiungi alla libreria"; }else{ echo "Add to library"; } 

                                echo '
                            </button>
                        </form>      
                        ';
                }
                ?>

                <form action="action.php" method="POST">
                    <button type="submit" name="method" class="R-btn btn mr-2" value="4" <?php if (!$isBooked) {echo "disabled";} ?>>
                        <img class="mb-1" style="width:37px; height:17px;" src="resources\HandImage.png" alt="handImage.img"> <?php if($_SESSION["language"] == "it"){ echo "Restituisci"; }else{ echo "Return"; } ?>
                    </button>
                    <input type="hidden" name="ID" value="<?php echo $_GET["ID"] ?>">
                </form>

                <?php
                    if(isset($_SESSION["admin"])){
                        echo '
                        <form action="modifica_inserimento.php" method="POST">
                            <button type="submit" name="method" class="R-btn btn mr-2" value="3">
                                <span class="iconify icona_libro mr-2" data-icon="fa-solid:pencil-ruler" data-inline="false" style="color: white;"></span>';

                                if($_SESSION["language"] == "it"){ echo "Modifica"; }else{ echo "Modify"; }

                                echo '
                            </button>
                            <input type="hidden" name="ID" value="' . $_GET["ID"] . '">
                        </form>  

                        <form action="grafici.php?ID=4&IDBOOK='. $_GET["ID"] .'" method="POST">
                            <button type="submit" name="method" class="R-btn btn mr-2" value="3">
                                <span class="iconify icona_libro mr-2" data-icon="oi:graph" data-inline="false" style="color: white;"></span>';

                                if($_SESSION["language"] == "it"){ echo "Statistiche"; }else{ echo "Statistics"; }

                                echo '
                            </button>
                        </form>  
                        ';
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        var SubmitForm = document.getElementById("noReload");

        function handleForm(event) {
            event.preventDefault();
        }
        SubmitForm.addEventListener('submit', handleForm);
    </script>
</body>

</html>