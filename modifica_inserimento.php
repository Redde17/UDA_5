<!-- TODO:
-->

<?php
    session_start();

    if(!isset($_SESSION["admin"])){
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- jquery 3.5.1 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Bootstrap 4.6 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- Fine Bootstrap-->
    <!--iconify -->
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <!-- fine iconify-->
    <!--Inizio CSS personalizzato-->
    <style>
        <?php include("css/style.css"); ?>
    </style>
    <!--fine CSS-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica</title>


    <?php
    //LETTURA dei generi già inseriti nel database
    include("php/get_generi.php");
    //Lettura dei generi già dati dal database
    @$iddato = $_POST['ID'];
    if (isset($iddato)) {
        $comando = "SELECT libro.id, libro.Titolo, editore.Nome as nomeeditore, libro.Descrizione, libro.Numero_Copie, libro.Immagine,autore.Nome as nomeautore,autore.Cognome as cognomeautore 
        FROM libro,autore,editore
        WHERE libro.id =" . $iddato . "
        AND libro.ID_Autore = autore.ID
        AND editore.Codice = libro.Codice_Editore";
        $querycontatto = mysqli_query($db_connection, $comando);
        while ($crow = mysqli_fetch_array($querycontatto)) {
            $id = $iddato;
            $titolo = $crow['Titolo'];
            $nomeeditore = $crow['nomeeditore'];
            $descrizione = $crow['Descrizione'];
            $num_copie = $crow['Numero_Copie'];
            if ($num_copie == NULL) {
                $num_copie = 0;
            }
            $path = $crow['Immagine'];
            $nomeautore = $crow['nomeautore'];
            $cognomeautore = $crow['cognomeautore'];
        }
        $sql = "SELECT categoria.Nome FROM categoria,appartiene,libro WHERE libro.ID = appartiene.ID_Libro AND appartiene.Nome_Categoria = categoria.Nome AND libro.ID = " . $iddato;
        $query = mysqli_query($db_connection, $sql);
        if ($query) {
            $generiattivati = $query->fetch_all(MYSQLI_ASSOC);
        } else {
        }
    } else {
        $id = "";
        $titolo = "";
        $nomeeditore = "";
        $descrizione = "";
        $num_copie = 0;
        $path = "";
        $nomeautore = "";
        $cognomeautore = "";
        $generiattivati = NULL;
    }
    ?>
</head>

<body style="overflow: hidden;">
    <?php
        //navbar
        include "./PHP/Navbar.php";
    ?>

    <div class="back d-flex justify-content-center mt-2">
        <form action="php/update.php" method="POST" name="inputlibri" id="inputlibri" enctype="multipart/form-data">
            <?php
            //se si sta modificando un libro 
            if (isset($iddato)) {
                echo '<input type="hidden" name="id" id="id" value="' . $iddato . '">';
            }
            ?>
            <div class="row">
                <!--Caricamento copertina libro-->
                <div class="col-4">
                    <div class="parent" id="immagine_carica">
                        <img class=" image1" src="resources/bookCover.png" alt="" height="926px" width="698px" style="bottom:500px;">
                        <img class="image_add" id="image_add" name="image_add" src="resources/add.png" alt="" onclick="upload()">
                        <img class="image2" id="image2" name="image2" src="resources/add.png" alt="" height="836px" width="500px" style="display: none;" onclick="upload()">
                        <input type="file" name="tag_carica" id="tag_carica" style="display: none;" />
                    </div>
                </div>

                <div class="col-5" style="margin-left: 130px; margin-top: 10px;">
                    <!--Caricamento titolo libro-->
                    <textarea class="titolo_text" name="nome" id="nome" cols="40" placeholder="Aggiungi titolo" style="resize: none; "><?php echo $titolo ?></textarea>
                    <!--Caricamento generi libro-->
                    <label for="color_genere" class="form-label">Aggiungi genere:</label>
                    <div class="input-container">
                        <input type="text" name="newgeneri" id="newgeneri" style="margin-top: 1px; margin-left: 1px; width: 77.5%;" autocomplete="off" placeholder="Nome genere">
                        <input type="color" class="form-control form-control-color" id="genericolor" value="#4949D2" title="Choose your color">
                        <button type="button" class="btn_invio btn_invio_generi" type="submit" id="invio_generi">
                            <img class="icona_invio" src="resources/add_genere.svg" alt="" srcset="">
                        </button>
                        </input>
                    </div>
        </form>


        <br>
        <div class="generi_input" id="generi_input" name="generi_input">
            <?php
            foreach ($row as $rows) {
                if (strlen($rows['Nome']) > 15) {
                    $fi = '<div class="pointer_large ' . 'pointer_' . str_replace(' ', '_', $rows['Nome']) . '" id="' . 'pointer_' . str_replace(' ', '_', $rows['Nome']) . '"> ';
                    print($fi);
                } else {
                    echo '<div class="pointer ' . 'pointer_' . str_replace(' ', '_', $rows['Nome']) . '" id="' . 'pointer_' . str_replace(' ', '_', $rows['Nome']) . '">';
                }
                echo '
                        <div class="cnt" id="cnt">
                            <input class="check" type="checkbox" name="categorie[]" id="' . str_replace(' ', '_', $rows['Nome']) . '[]")" value="' . $rows['Nome'] . '"/>
                            <label class="label_tag" for="' . str_replace(' ', '_', $rows['Nome']) . '">' . strtoupper($rows['Nome']) . '</label>
                        </div>
                    </div>';
            }


            ?>
        </div>
        <!--Fine inserimento generi-->

        <!--Inserimento autore -->
        <div class="casella">
            <label for="autore">By:</label>
            <input type="text" class="autore_text nomeautore" name="nomeautore" list="autorinome_lista" id="nomeautore" placeholder="Aggiungi nome autore" value="<?php echo $nomeautore ?>" required />
            <input type="text" class="autore_text cognomeautore" name="cognomeautore" list="autoricognome_lista" id="cognomeautore" placeholder="Aggiungi cognome autore" value="<?php echo $cognomeautore ?>">
            <datalist id="autorinome_lista">
                <?php
                $sql = "SELECT autore.Nome,autore.Cognome FROM autore";
                $query = mysqli_query($db_connection, $sql);
                foreach ($query as $riga) {
                    echo ' <option value="' . $riga['Nome'] . '"> ';
                }
                ?>
            </datalist>
            <datalist id="autoricognome_lista">
                <?php
                foreach ($query as $riga) {
                    echo ' <option value="' . $riga['Cognome'] . '"> ';
                }
                ?>
            </datalist>
        </div>
        <!--Fine inserimento autore -->

        <!--Inserimento Editore -->
        <div style="margin-bottom: -10px; margin-top: -5px">
            <label for="editore">Editor:</label><input type="text" class="editore_text" name="nomeeditore" list="editori_lista" id="nomeeditore" placeholder="Aggiungi nome editore" value="<?php echo $nomeeditore ?>" required>
            <datalist id="editori_lista">
                <!--TODO: Funzione in PHP che stampa tutti gli editori disponibili-->
                <?php
                $sql = "SELECT editore.Nome FROM editore";
                $query = mysqli_query($db_connection, $sql);
                foreach ($query as $riga) {
                    echo ' <option value="' . $riga['Nome'] . '"> ';
                }
                ?>
            </datalist>
        </div>
        <!--Fine inserimento Editore -->

        <!--Inserimento descrizione -->
        <div class="casella">
            <textarea class="descrizione_text" name="descrizione" id="descrizione" cols="40" placeholder="Aggiungi descrizione" style="resize: none;" required><?php echo $descrizione ?></textarea>
        </div>
        <!--Fine Inserimento descrizione -->

        <!--Inserimento libri disponibili-->
        <label for="countlib">Disponibili:</label>
        <div class="btn-group-vertical" id="countlib">
            <button type="button" class="btn freccia_su" onclick="inc()"></button>
            <input class=" numero_text " type="number" name="copie" id="copie" min="0" onkeyup="control()" value="<?php echo $num_copie ?>">
            <button type="button" class="btn freccia_giu" onclick="dec()"></button>
        </div>
        <!--Fine Inserimento libri disponibili -->

        <!--Bottone Invio -->
        <button type="submit" name="submit" value="submit" class="btn_invio">
            <span class="iconify icona_invio" style="color: #FFFFFF;" data-icon="ic:baseline-library-add" data-inline="false"></span>
            <?php if (isset($iddato)) {
                echo 'Aggiorna libro';
            } else {
                echo 'Aggiungi alla biblioteca';
            } ?>
        </button>
        <!--Fine Bottone Invio -->
        </form>
    </div>

</body>
<script>
    var puntatori = document.querySelectorAll("div.pointer_large, div.pointer"); //Tutti i puntatori
    var passedArray = <?php echo json_encode($row); ?>; //Generi, descrizioni e colori
    console.log(passedArray);

    //FUNZIONE CHE CREA IL PUNTATORE
    function set(ilnome, valore, colore) {
        console.log(ilnome + " " + valore + " " + colore);
        var div = document.getElementById("pointer_" + ilnome);
        var checkbox = document.getElementById(ilnome + "[]");
        var style = document.head.appendChild(document.createElement("style"));
        style.innerHTML = ".pointer_" + ilnome + ":before {border-left: 1.25em solid " + colore + ";}.pointer_" + ilnome + "{background: " + colore + ";}";
        checkbox.checked = valore;
        if (checkbox.checked == true) {
            div.style.opacity = 1;
            //alert(checkbox.checked);
        } else {
            div.style.opacity = 0.5;
            //alert(checkbox.checked);
        }
    }

    /*INIZIO INPUT GENERI*/
    $("#invio_generi").click(function(event) {
        var ng = document.getElementById("newgeneri").value.toLowerCase();
        ng = ng.charAt(0).toUpperCase() + ng.slice(1);
        if (ng.length >= 19) {
            alert("Massimo caratteri consentiti: 18");
        } else {
            var gcolor = document.getElementById("genericolor").value.toUpperCase();
            // Serialize the data in the form
            var serializedData = "nuovogenere=" + ng + "&colore=" + gcolor;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "exist") {
                        alert("Errore! Genere già esistente");
                    } else if (this.responseText == "") {
                        var io = document.getElementById("generi_input");
                        if (ng.length > 15) {
                            io.innerHTML += '<div class="pointer_large pointer_' + ng.replaceAll(' ', '_') + '" id= "pointer_' + ng.replaceAll(' ', '_') + '"><div class="cnt" id="cnt"><input class="check" type="checkbox" name="categorie[]" id="' + ng.replaceAll(' ', '_') + '[]")" value="' + ng + '"/><label class="label_tag" for="' + ng.replaceAll(' ', '_') + '">' + ng.toUpperCase() + '</label></div></div>';
                        } else {
                            io.innerHTML += '<div class="pointer pointer_' + ng.replaceAll(' ', '_') + '" id= "pointer_' + ng.replaceAll(' ', '_') + '"><div class="cnt" id="cnt"><input class="check" type="checkbox" name="categorie[]" id="' + ng.replaceAll(' ', '_') + '[]")" value="' + ng + '"/><label class="label_tag" for="' + ng.replaceAll(' ', '_') + '">' + ng.toUpperCase() + '</label></div></div>';
                        }
                        puntatori = document.querySelectorAll("div.pointer_large, div.pointer");
                        passedArray.push({
                            "Nome": ng,
                            "Descrizione": null,
                            "Colore": gcolor
                        });
                        console.log(passedArray);
                        set(ng.replaceAll(' ', '_'), false, gcolor);
                        provaclick();
                    }
                }
            };


            xhttp.open("POST", "php/add_generi.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(serializedData);
        }
    });
    /*FINE INPUT GENERI*/

    function sett(ilnome, valore) {
        var div = document.getElementById("pointer_" + ilnome);
        var checkbox = document.getElementById(ilnome + "[]");
        checkbox.checked = valore;
        if (checkbox.checked == true) {
            div.style.opacity = 1;
        } else {
            div.style.opacity = 0.5;
        }
    }



    //SET delle checkbox a FALSE e nel caso di passaggio di paramentri, SET a TRUE quelle già attive
    var generiattivati = <?php echo json_encode($generiattivati); ?>;
    if (generiattivati != null) {
        for (var j = 0; j < passedArray.length; j++) {
            for (var i = 0; i < generiattivati.length; i++) {
                console.log("Nome attivato: " + generiattivati[i].Nome + " i=" + i + " Valore passato: " + passedArray[j].Nome + " j=" + j + " Colore: " + passedArray[j].Colore);
                if (generiattivati[i].Nome.localeCompare(passedArray[j].Nome) == 0) {
                    //                        console.log("Sono in set TRUE");
                    set(passedArray[j].Nome.replace(/\s/g, '_'), true, passedArray[j].Colore);
                    break;
                } else {
                    //         console.log("Sono in set FALSE");

                    set(passedArray[j].Nome.replace(/\s/g, '_'), false, passedArray[j].Colore);
                }
            }
        }
    } else {
        for (var j = 0; j < passedArray.length; j++) {
            set(passedArray[j].Nome.replace(/\s/g, '_'), false, passedArray[j].Colore);
        }
    }



    //TOOGLE al click e controllo se ci sono più di 8 elementi
    var i = 0;
    var checkedcount = 1;
    var limit = 8;

    function provaclick() {
        i = 0;
        puntatori = document.querySelectorAll("div.pointer_large, div.pointer");
        console.log(document.querySelectorAll("div.pointer_large, div.pointer").length + " lunghezza pointer");
        puntatori.forEach(function(elem) {
            console.log(passedArray[i].Nome + " " + i);
            var prova = passedArray[i].Nome.replace(/\s/g, '_');
            elem.addEventListener("click", function() {
                checkedcount = 1;
                var checkBoxGroup = document.getElementsByName("categorie[]");
                for (var i = 0; i < checkBoxGroup.length; i++) {
                    checkedcount += (checkBoxGroup[i].checked) ? 1 : 0;
                }
                console.log(checkedcount);
                if (checkedcount > limit) {
                    sett(prova, false);
                } else {
                    toogle(prova);
                }
            });
            i++;
        });
    }




    function toogle(ilnome) {
        var div = document.getElementById("pointer_" + ilnome);
        var checkbox = document.getElementById(ilnome + "[]");
        checkbox.checked = !checkbox.checked;
        if (checkbox.checked == true) {
            div.style.opacity = 1;
        } else {
            div.style.opacity = 0.5;
        }
    }
    //FINE FUNZIONE TOOGLE al click

    //FUNZIONI FUNZIONANTI

    function inc() {
        var num = document.inputlibri.copie.value;
        if (num != 99) {
            num++;
            document.inputlibri.copie.value = num;
        }
    }

    function dec() {
        var num = document.inputlibri.copie.value;
        if (num != 0) {
            num--;
            document.inputlibri.copie.value = num;
        }
    }

    function control() {
        var num = document.inputlibri.copie.value;
        if (num > 99) {
            document.inputlibri.copie.value = 99;
        } else if (num < 0) {
            document.inputlibri.copie.value = 0;
        }

    }

    function upload() {
        var fileInp = document.getElementById('tag_carica');
        fileInp.click();
    }

    function caricada(path) {
        if (path == null || path == "") {

        } else {
            document.getElementById("image2").src = 'img/' + path;
            document.getElementById('image_add').style.display = "none";
            document.getElementById('image2').style.display = "block";
        }

    }
    caricada("<?php echo $path ?>");

    //PREWIEW IMMAGINE
    window.addEventListener('load', function() {
        document.querySelector('input[type="file"]').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                //var img = document.querySelector('img');
                var img = document.getElementById('image2');
                img.onload = () => {
                    URL.revokeObjectURL(img.src); // no longer needed, free memory
                }

                img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                document.getElementById('image_add').style.display = "none";
                document.getElementById('image2').style.display = "block";
            }
        });
    });
    //FINE PREWIEW IMMAGINE
    provaclick();
</script>

</html>