<?php
session_start();

if (!isset($_SESSION["logged"])) {
    header('Location: index.php');
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
        <?php include "CSS/mainCSS.css" ?>
    </style>

    <title>Utente</title>
</head>

<body>
    <?php
    include "PHP\connection.php";
    $conn = connection("biblioteca");

    //query

    //temp query
    $SQLutente = "SELECT nome, cognome, telefono
                        FROM utente
                        WHERE email = '" . $_SESSION["email"] . "'";

    $SQLprestiti = "SELECT DISTINCT libro.ID, libro.Titolo, libro.Immagine, autore.Nome, autore.Cognome
                        FROM libro, autore, prestare 
                        WHERE '" . $_SESSION["email"] . "' = prestare.Email_Utente
                        AND prestare.ID_Libro = libro.ID
                        AND  libro.ID_Autore = autore.ID
                        AND prestare.Data_Riconsegna IS NULL";

     $SQLrestituiti = "SELECT DISTINCT libro.ID, libro.Titolo, libro.Immagine, autore.Nome, autore.Cognome
                         FROM libro, autore, prestare 
                         WHERE '" . $_SESSION["email"] . "' = prestare.Email_Utente
                         AND prestare.ID_Libro = libro.ID
                         AND  libro.ID_Autore = autore.ID
                         AND prestare.Data_Riconsegna IS NOT NULL";

    ?>

    <!-- NavBar temporanea -->
    <div class="d-flex" style="background-color: #77B748; border: 1px solid #5F923A; height: 50px; width: 100%; margin: 0px; padding:0px;">
        <div class="ml-5"><a href="index.php">LOGO</a></div>
    </div>

    <!-- Utente -->
    <div class="d-flex justify-content-center align-items-center mt-5" style="background-color: #F7F7F7; height: auto;">
        <div id="userImg" class="d-flex justify-content-center align-items-center">
            <span id="userIcon" class="iconify ml-4" data-icon="fa-solid:user-alt" data-inline="false" style="color: white;"></span>
            <span class="iconify align-self-end" data-icon="majesticons:pencil-alt-line" data-inline="false" style="color: white; height: 30px; width: 30px; cursor: pointer;" onclick="OpenModify()"></span>
        </div>

        <?php
        $result = $conn->query($SQLutente);

        $row = $result->fetch_assoc();

        function ifEmpty($text)
        {
            if ($text == "") {
                echo "Vuoto";
            } else {
                echo $text;
            }
        }

        $_SESSION["nome"] = $row["nome"];
        $_SESSION["cognome"] = $row["cognome"];
        $_SESSION["telefono"]  = $row["telefono"];
        ?>

        <div id="userDisplay" class="ml-4 d-flex flex-column">
            <div>
                <p class="userLabel R-textVerySmall m-0 ">nome utente:</p>
                <p class="userText R-textLarge mb-1"><?php echo ifEmpty($_SESSION["nome"]) ?></p>
            </div>

            <p class="userLabel R-textVerySmall m-0 mt-3">nome e cognome:</p>
            <div class="d-flex flex-row">
                <p class="userText R-textLarge mb-1"><?php echo ifEmpty($_SESSION["nome"]) ?></p>
                <p class="userText R-textLarge mb-1 ml-2"><?php echo ifEmpty($_SESSION["cognome"]) ?></p>
            </div>

            <div class="mt-3">
                <p class="userLabel R-textVerySmall m-0">Email:</p>
                <p class="userText R-textLarge mb-1"><?php echo ifEmpty($_SESSION["email"]) ?></p>
            </div>

            <div class="mt-3">
                <p class="userLabel R-textVerySmall m-0">Telefono:</p>
                <p class="userText R-textLarge mb-1"><?php echo ifEmpty($_SESSION["telefono"]) ?></p>
            </div>
        </div>


        <div id="userModify" class="ml-4 d-flex flex-column w" style="display: none !important;">
            <form id="SubmitModify">
                <div>
                    <p class="userLabel R-textVerySmall m-0 ">nome utente:</p>
                    <!-- <p class="userText R-textLarge mb-1">a</p> -->
                    <input id="modifyNomeUtente" class="userText R-textLarge mb-1 modifyInput" type="text" placeholder="Nome utente" value="<?php echo $_SESSION['nome'] ?>">
                </div>

                <p class="userLabel R-textVerySmall m-0 mt-1">nome e cognome:</p>
                <div class="d-flex flex-row">
                    <!-- <p class="userText R-textLarge mb-1">a</p> -->
                    <input id="modifyNome" class="userText R-textLarge mb-1 modifyInput" type="text" placeholder="Nome" value="<?php echo $_SESSION['nome'] ?>">
                    <!-- <p class="userText R-textLarge mb-1 ml-2">a</p> -->
                    <input id="modifyCognome" class="userText R-textLarge mb-1 ml-2 modifyInput" type="text" placeholder="Cognome" value="<?php echo $_SESSION['cognome'] ?>">
                </div>

                <div class="mt-1">
                    <p class="userLabel R-textVerySmall m-0">Email:</p>
                    <!-- <p class="userText R-textLarge mb-1">a</p> -->
                    <input id="modifyEmail" class="userText R-textLarge mb-1 modifyInput" type="text" placeholder="Email" value="<?php echo $_SESSION['email'] ?>" disabled>
                </div>

                <div class="mt-1">
                    <p class="userLabel R-textVerySmall m-0">Telefono:</p>
                    <!-- <p class="userText R-textLarge mb-1">a</p> -->
                    <input id="modifyTelefono" class="userText R-textLarge mb-1 modifyInput" type="tel" placeholder="Telefono" value="<?php echo $_SESSION['telefono'] ?>">
                </div>

                <input type="submit" class="submitBtn RB-btn btn-lg mt-3 mb-4" value="Modifica" onclick="modifyUtente()">
            </form>
        </div>
    </div>


    <!-- Aggiunti di recente -->
    <!-- riga dei libri-->
    <div class="divBook mt-5">
        <div style="width: 100%; height: 50px;">
            <!-- Scritta categoria -->
            <h4 class="float-left divBookTitolo">In prestito</h4>

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
            $result = $conn->query($SQLprestiti);

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
                                <img src="./img/' . $row['Immagine'] . '" alt="FotoLibro" width="167" height="233">';

                    echo        '<!-- categorie -->
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
                echo '
                        <div id="content" class="d-flex justify-content-center align-items-center p-0 m-0 ml-4" style="height: 233px; width: 100%;"> 
                                <h2>Non hai libri in questa categoria</h2>
                        </div>
                    ';
            }

            ?>

            <br>
        </div>

        <!-- In prestito -->
        <!-- riga dei libri-->
        <div class="divBook mt-5">
            <div style="width: 100%; height: 50px;">
                <!-- Scritta categoria -->
                <h4 class="float-left divBookTitolo">Libri letti</h4>

                <!-- Tasti per lo scroll -->
                <div class="float-right" style="margin-right: 10px;">
                    <button class="round-btn" id="slideBack" type="button" onclick="atc('LT', 'Prestito')">
                        <span class="iconify R-grey R-Hwhite arrowButton" data-icon="eva-arrow-ios-back-fill" data-inline="false"></span>
                    </button>
                    <button class="round-btn" id="slide" type="button" onclick="atc('RX', 'Prestito')">
                        <span class="iconify R-grey R-Hwhite arrowButton" data-icon="eva-arrow-ios-forward-fill" data-inline="false"></span>
                    </button>
                </div>
            </div>

            <!-- Riga di spacco -->
            <div class="brk" style="margin-bottom: 20px;"></div>

            <!-- Libri -->
            <div id='Prestito' class="d-flex flex-row R-flowRow" style="width: 100%;">
                <?php
                $result = $conn->query($SQLrestituiti);

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
                    //echo 'nessuna riga trovata';
                    echo '
                        <div id="content" class="d-flex justify-content-center align-items-center p-0 m-0 ml-4" style="height: 233px; width: 100%;"> 
                                <h2>Non hai libri in questa categoria</h2>
                        </div>
                    ';
                }

                ?>

                <br>
            </div>
        </div>
        
                <!-- footer -->
                <footer>
                    <div class="container-fluid mt-5 p-0" style="height: 180px; background-color: #F7F7F7; border-top: 2px solid #77B748;">
                        <div class="container-fluid mt-4" style="height: 160px; background-color: #484848;">
                        </div>
                    </div>
                </footer>
            </div>

            <script src="scripts.js"></script>

            <script>
                //fa si che il tasto submit non aggiorna la pagina
                var SubmitForm = document.getElementById("SubmitModify");

                function handleForm(event) {
                    event.preventDefault();
                }
                SubmitForm.addEventListener('submit', handleForm);

                function modifyUtente() {
                    console.log("modifyUtente called")

                    var nomeUtente = document.getElementById("modifyNomeUtente").value;
                    var nome = document.getElementById("modifyNome").value;
                    var cognome = document.getElementById("modifyCognome").value;
                    var telefono = document.getElementById("modifyTelefono").value;


                    var xhttp;
                    xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            location.reload();
                        }
                    }

                    xhttp.open("POST", "action.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("nomeUtente=" + nomeUtente + "&nome=" + nome + "&cognome=" + cognome + "&telefono=" + telefono + "&method=2");
                }
            </script>
</body>

</html>