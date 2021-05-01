<!doctype html>
<html lang="en">

<!--TODO:
Rapporto semestrale partendo dalla data di viusalizzazione a indietro
ES: 10/2020 - 04/2021
Grafico linee: Registrazione utenti
Grafico torta verde: Libri che devono essere restituiti
Grafico torta bianco: Generi più letti
Grafico a barre: Libri più letti (MAX 3)

-->

<head>
    <title>Grafici</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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
        <?php

        use function PHPSTORM_META\type;

        include("css/style.css"); ?><?php include("css/style_grafici.css"); ?>
    </style>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.1.1/dist/chart.min.js" integrity="sha256-lISRn4x2bHaafBiAb0H5C7mqJli7N0SH+vrapxjIz3k=" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    $countnoreso = 0;
    @$iddato = $_GET['ID'];
    echo '<script>var iddato = ';
    if (!isset($iddato)) {
        echo 'null';
    } else {
        echo $iddato;
    }
    echo '</script>';
    include("php/connection.php");
    $db_connection = connection("biblioteca");
    if ($iddato == 1 || !isset($iddato)) {
        //PRIMA QUERY
        $mesi = array();
        $val = array();
        $query = "SELECT DATE_FORMAT(Data_Registrazione,'%b-%Y') as dataa,COUNT(*) as conto FROM utente GROUP BY dataa ORDER BY `utente`.`Data_Registrazione` DESC LIMIT 6";
        $inter = $db_connection->query($query);
        if ($inter->num_rows > 0) {
            while ($row = $inter->fetch_assoc()) {
                array_push($mesi, $row['dataa']);
                array_push($val, $row['conto']);
            }
            $mesi = array_reverse($mesi);
            $val = array_reverse($val);
        }
        //FINE PRIMA QUERY
        //SECONDA QUERY
        $restituiti;
        $nonrestituiti;
        $query = "SELECT (SELECT COUNT(*) FROM prestare WHERE Data_Riconsegna IS NULL ) as nonrestituiti,(SELECT COUNT(*) FROM prestare WHERE Data_Riconsegna IS NOT NULL) AS restituiti FROM prestare";
        $inter = $db_connection->query($query);
        if ($inter->num_rows > 0) {
            while ($row = $inter->fetch_assoc()) {
                $nonrestituiti = $row['nonrestituiti'];
                $restituiti = $row['restituiti'];
            }
        } else {
            $nonrestituiti = 0;
            $restituiti = 0;
        }
        //FINE SECONDA QUERY

        //INIZIO TERZA QUERY
        $nomecategoria = array();
        $contocategoria = array();

        $query = "SELECT categoria.Nome as nome,COUNT(*) AS conto FROM prestare,categoria,libro,appartiene WHERE prestare.ID_Libro = libro.ID AND libro.ID = appartiene.ID_Libro AND appartiene.Nome_Categoria = categoria.Nome GROUP BY categoria.Nome ORDER BY conto DESC LIMIT 7";
        $inter = $db_connection->query($query);
        if ($inter->num_rows > 0) {
            while ($row = $inter->fetch_assoc()) {
                array_push($nomecategoria, $row['nome']);
                array_push($contocategoria, $row['conto']);
            }
        }
        //FINE TERZA QUERY
        //INIZIO QUARTA QUERY
        $nomelibro = array();
        $contolibro = array();

        $query = "SELECT libro.Titolo as nome,COUNT(*) AS conto FROM libro,prestare WHERE libro.ID = prestare.ID_Libro GROUP BY libro.Titolo ORDER BY `conto` DESC LIMIT 10";
        $inter = $db_connection->query($query);
        if ($inter->num_rows > 0) {
            while ($row = $inter->fetch_assoc()) {
                array_push($nomelibro, $row['nome']);
                array_push($contolibro, $row['conto']);
            }
        }
        //FINE QUARTA QUERY

        //INIZIO QUINTA QUERY
        $countlibri;
        $countautori;
        $countgeneri;
        $countutenti;

        $query = "SELECT (SELECT COUNT(*) FROM libro) as libri,(SELECT COUNT(*) FROM utente) AS utenti,(SELECT COUNT(*) FROM autore) AS autori,(SELECT COUNT(*) FROM categoria) as generi FROM autore,categoria,editore,libro,utente LIMIT 1";
        $inter = $db_connection->query($query);
        if ($inter->num_rows > 0) {
            while ($row = $inter->fetch_assoc()) {
                $countlibri = $row['libri'];
                $countautori = $row['autori'];
                $countgeneri = $row['generi'];
                $countutenti = $row['utenti'];
            }
        } else {
            $countlibri = 0;
            $countautori = 0;
            $countgeneri = 0;
            $countutenti = 0;
        }

        //FINE QUINTA QUERY

        echo '<script>
        var nomelibro = ' . json_encode($nomelibro) . ';
        var contolibro = ' . json_encode($contolibro) . ';

        var nomecategoria = ' . json_encode($nomecategoria) . ';
        var contocategoria = ' . json_encode($contocategoria) . ';

        var nonrestituiti = ' . json_encode($nonrestituiti) . ';
        var restituiti = ' . json_encode($restituiti) . ';

        var mesi = ' . json_encode($mesi) . ';
        var val = ' . json_encode($val) . ';
    </script>';
    } elseif ($iddato == 2) {
        @$typedato = $_GET['TYPE'];
        //INIZIO QUERY IMPAGINAZIONE LIBRO
        $query = "SELECT COUNT(*) FROM libro";
        $query = $db_connection->query($query);
        $row = mysqli_fetch_row($query);


        $rows = $row[0];

        $page_rows = 13; //Righe massime

        $last = ceil($rows / $page_rows);

        if ($last < 1) {
            $last = 1;
        }

        $pagenum = 1;

        if (isset($_GET['PN'])) {
            $pagenum = preg_replace('#[^0-9]#', '', $_GET['PN']);
        }

        if ($pagenum < 1) {
            $pagenum = 1;
        } else if ($pagenum > $last) {
            $pagenum = $last;
        }

        $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;

        $istruzione = "SELECT libro.Titolo as Titolo, editore.Nome as Nomeeditore, libro.Numero_Copie as Numero_Copie, libro.Immagine as Immagine, autore.Nome as Nomeautore, autore.Cognome as Cognomeautore,Libro.ID as ID FROM libro,autore,editore WHERE libro.Codice_Editore = editore.Codice AND libro.ID_Autore = autore.ID";
        switch ($typedato) {
            case 'titolo':
                $istruzione = $istruzione . " ORDER BY libro.Titolo";
                break;

            case 'editore':
                $istruzione = $istruzione . " ORDER BY editore.Nome";
                break;

            case 'autore':
                $istruzione = $istruzione . " ORDER BY autore.Nome";
                break;

            case 'copie':
                $istruzione = $istruzione . " ORDER BY libro.Numero_Copie DESC";
                break;
            default:
                # code...
                break;
        }
        $istruzione = $istruzione . ' ' . $limit;
        $nquery = $db_connection->query($istruzione);


        $paginationCtrls = '';

        if ($last != 1) {

            if ($pagenum > 1) {
                $previous = $pagenum - 1;
                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?ID=2';
                if (isset($typedato)) {
                    $paginationCtrls .= '&TYPE=' . $typedato;
                }
                $paginationCtrls .= '&PN=' . $previous . '" class="btn btn-default">Precedente</a> &nbsp; &nbsp; ';

                for ($i = $pagenum - 4; $i < $pagenum; $i++) {
                    if ($i > 0) {
                        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?ID=2';
                        if (isset($typedato)) {
                            $paginationCtrls .= '&TYPE=' . $typedato;
                        }
                        $paginationCtrls .= '&PN=' . $i . '" class="btn btn-default">' . $i . '</a> &nbsp; ';
                    }
                }
            }

            $paginationCtrls .= '' . $pagenum . ' &nbsp; ';

            for ($i = $pagenum + 1; $i <= $last; $i++) {
                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?ID=2';
                if (isset($typedato)) {
                    $paginationCtrls .= '&TYPE=' . $typedato;
                }
                $paginationCtrls .= '&PN=' . $i . '" class="btn btn-default">' . $i . '</a> &nbsp; ';

                if ($i >= $pagenum + 4) {
                    break;
                }
            }

            if ($pagenum != $last) {
                $next = $pagenum + 1;

                $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?ID=2';
                if (isset($typedato)) {
                    $paginationCtrls .= '&TYPE=' . $typedato;
                }
                $paginationCtrls .= '&PN    =' . $next . '" class="btn btn-default">Successivo</a> ';
            }
        }
    } else if ($iddato == 3) {
        @$typedato = $_GET['TYPE'];
        //INIZIO QUERY INPAGINAZIONE
        $query = "SELECT COUNT(*) FROM prestare";
        $query = $db_connection->query($query);
        $row = mysqli_fetch_row($query);

        $rows = $row[0];

        $page_rows = 12; //Righe massime

        $last = ceil($rows / $page_rows);

        if ($last < 1) {
            $last = 1;
        }

        $pagenum = 1;

        if (isset($_GET['PN'])) {
            $pagenum = preg_replace('#[^0-9]#', '', $_GET['PN']);
        }

        if ($pagenum < 1) {
            $pagenum = 1;
        } else if ($pagenum > $last) {
            $pagenum = $last;
        }

        $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;

        $istruzione = "SELECT utente.Nome as Nome, utente.Cognome as Cognome,libro.Titolo as Titolo, prestare.Data_Prestito as Prestito, prestare.Data_Riconsegna as Riconsegna, prestare.Email_utente as Email, prestare.ID_Libro as ID FROM utente,libro,prestare WHERE utente.Email = prestare.Email_Utente AND prestare.ID_Libro = libro.ID";
        switch ($typedato) {
            case 'utente':
                $istruzione = $istruzione . " ORDER BY utente.Nome";
                break;

            case 'libro':
                $istruzione = $istruzione . " ORDER BY libro.Titolo";
                break;

            case 'dataprestito':
                $istruzione = $istruzione . " ORDER BY prestare.Data_Prestito";
                break;

            case 'datareso':
                $istruzione = $istruzione . " ORDER BY prestare.Data_Riconsegna DESC";
                break;

            case 'stato':
                $istruzione = $istruzione . " ORDER BY prestare.Data_Riconsegna DESC";
            default:
                # code...
                break;
        }
        $istruzione = $istruzione . ' ' . $limit;
        $nquery = $db_connection->query($istruzione);


        $paginationCtrls = '';

        if ($last != 1) {

            if ($pagenum > 1) {
                $previous = $pagenum - 1;
                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?ID=3';
                if (isset($typedato)) {
                    $paginationCtrls .= '&TYPE=' . $typedato;
                }
                $paginationCtrls .= '&PN=' . $previous . '" class="btn btn-default">Precedente</a> &nbsp; &nbsp; ';

                for ($i = $pagenum - 4; $i < $pagenum; $i++) {
                    if ($i > 0) {
                        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?ID=3';
                        if (isset($typedato)) {
                            $paginationCtrls .= '&TYPE=' . $typedato;
                        }
                        $paginationCtrls .= '&PN=' . $i . '" class="btn btn-default">' . $i . '</a> &nbsp; ';
                    }
                }
            }

            $paginationCtrls .= '' . $pagenum . ' &nbsp; ';

            for ($i = $pagenum + 1; $i <= $last; $i++) {
                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?ID=3';
                if (isset($typedato)) {
                    $paginationCtrls .= '&TYPE=' . $typedato;
                }
                $paginationCtrls .= '&PN=' . $i . '" class="btn btn-default">' . $i . '</a> &nbsp; ';

                if ($i >= $pagenum + 4) {
                    break;
                }
            }

            if ($pagenum != $last) {
                $next = $pagenum + 1;

                $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?ID=3';
                if (isset($typedato)) {
                    $paginationCtrls .= '&TYPE=' . $typedato;
                }
                $paginationCtrls .= '&PN    =' . $next . '" class="btn btn-default">Successivo</a> ';
            }
        }
    } elseif ($iddato == 4) {
        @$typedato = $_GET['TYPE'];
        @$IDBOOK = $_GET['IDBOOK'];
        if (!isset($IDBOOK)) {
            echo '<script>window.location.href = "http://localhost/UDA/grafici.php";</script>'; //TODO:CAMBIARE QUANDO SI TROVA SUL SERVER
        } else {
            //INIZIO QUERY INPAGINAZIONE
            $query = "SELECT COUNT(*) FROM prestare,utente,libro WHERE prestare.ID_libro = " . $IDBOOK . " AND prestare.Email_Utente = utente.Email AND prestare.ID_Libro = libro.ID";
            $query = $db_connection->query($query);
            $row = mysqli_fetch_row($query);

            $rows = $row[0];

            $page_rows = 12; //Righe massime

            $last = ceil($rows / $page_rows);

            if ($last < 1) {
                $last = 1;
            }

            $pagenum = 1;

            if (isset($_GET['PN'])) {
                $pagenum = preg_replace('#[^0-9]#', '', $_GET['PN']);
            }

            if ($pagenum < 1) {
                $pagenum = 1;
            } else if ($pagenum > $last) {
                $pagenum = $last;
            }

            $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;

            $istruzione = "SELECT prestare.Email_utente as Email, prestare.Data_Prestito as Prestito, prestare.Data_Riconsegna as Riconsegna, prestare.ID_Libro as ID FROM utente,libro,prestare WHERE prestare.ID_libro = " . $IDBOOK . " AND prestare.Email_Utente = utente.Email AND prestare.ID_Libro = libro.ID";
            switch ($typedato) {
                case 'utente':
                    $istruzione = $istruzione . " ORDER BY prestare.Email_utente";
                    break;

                case 'dataprestito':
                    $istruzione = $istruzione . " ORDER BY prestare.Data_Prestito";
                    break;

                case 'datareso':
                    $istruzione = $istruzione . " ORDER BY prestare.Data_Riconsegna DESC";
                    break;

                case 'stato':
                    $istruzione = $istruzione . " ORDER BY prestare.Data_Riconsegna DESC";
                default:
                    # code...
                    break;
            }
            $istruzione = $istruzione . ' ' . $limit;
            $nquery = $db_connection->query($istruzione);


            $paginationCtrls = '';

            if ($last != 1) {

                if ($pagenum > 1) {
                    $previous = $pagenum - 1;
                    $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?ID=4';
                    if (isset($typedato)) {
                        $paginationCtrls .= '&IDBOOK=' . $IDBOOK . '&TYPE=' . $typedato;
                    }
                    $paginationCtrls .= '&PN=' . $previous . '" class="btn btn-default">Precedente</a> &nbsp; &nbsp; ';

                    for ($i = $pagenum - 4; $i < $pagenum; $i++) {
                        if ($i > 0) {
                            $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?ID=4';
                            if (isset($typedato)) {
                                $paginationCtrls .= '&IDBOOK=' . $IDBOOK . '&TYPE=' . $typedato;
                            }
                            $paginationCtrls .= '&PN=' . $i . '" class="btn btn-default">' . $i . '</a> &nbsp; ';
                        }
                    }
                }

                $paginationCtrls .= '' . $pagenum . ' &nbsp; ';

                for ($i = $pagenum + 1; $i <= $last; $i++) {
                    $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?ID=4';
                    if (isset($typedato)) {
                        $paginationCtrls .= '&IDBOOK=' . $IDBOOK . '&TYPE=' . $typedato;
                    }
                    $paginationCtrls .= '&PN=' . $i . '" class="btn btn-default">' . $i . '</a> &nbsp; ';

                    if ($i >= $pagenum + 4) {
                        break;
                    }
                }

                if ($pagenum != $last) {
                    $next = $pagenum + 1;

                    $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?ID=4';
                    if (isset($typedato)) {
                        $paginationCtrls .= '&IDBOOK=' . $IDBOOK . '&TYPE=' . $typedato;
                    }
                    $paginationCtrls .= '&PN    =' . $next . '" class="btn btn-default">Successivo</a> ';
                }
            }
        }
    }

    ?>



    <div class="w3-sidebar w3-text-white w3-bar-block d-flex flex-column align-items-end" style="width:20%">
        <a href="index.php" class="w3-bar-item">
            <h3><img src="resources/Logo.png" alt="" srcset="" style="height:56px;width:56px; margin-right:5px">Web Book Library</h3>
        </a>
        <a href="grafici.php?ID=1" class="w3-bar-item"> <span class="iconify" data-icon="fluent:clock-12-regular" data-inline="false"></span>Dashboard</a>
        <a href="grafici.php?ID=2" class="w3-bar-item"><span class="iconify" data-icon="dashicons:book" data-inline="false"></span>Libro</a>
        <a href="grafici.php?ID=3" class="w3-bar-item"><span class="iconify" data-icon="fa-solid:receipt" data-inline="false"></span>Prestiti</a>
        <a href="cleanSession.php" class="w3-bar-item mt-auto p-3"><span class="iconify" data-icon="icomoon-free:exit" data-inline="false"></span>Logout</a>
    </div>

    <div class="container" style="margin-left:22%">
        <div class="row" style="justify-content:space-between;">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Rapporto</h1>

            </div>
            <div class="d-flex align-items-center justify-content-between" style="padding-right:30px">
                <!--<p class="login_text"> Nome Cognome</p>-->
            </div>

        </div>

        <div class="row">
            <?php
            if ($iddato == 1 || !isset($iddato)) {
                echo '
            <main class=" ms-sm-9">
                <div class="d-flex flex-column">
                    <div class="flex-row" style=" padding-bottom: 10px;">
                        <div class="grafico_linee">
                            <p class="testo_titolo">Registrazione Utenti</p>
                            <canvas id="grafico1"></canvas>
                        </div>
                    </div>
                    <div class="flex-row d-inline-flex">
                        <div class="grafico_linee" style="  margin-right: 10px;">
                            <p class="testo_titolo"';
                if (($restituiti + $nonrestituiti) != 0) {
                    echo 'style="padding-bottom: 30px;"';
                } else {
                    echo '';
                }
                echo '>Generi più letti</p>
                            ';
                if (($restituiti + $nonrestituiti) != 0) {
                    echo '<canvas id="grafico3"></canvas>';
                } else {
                    echo '<p>Nessun prestito effettuato</p>';
                }
                echo '
                        </div>
                        <div class="grafico_linee" style="height:450px;">
                            <p class="testo_titolo">Libri più letti</p>
                            ';
                if (($restituiti + $nonrestituiti) != 0) {
                    echo '<canvas id="grafico4" height="400px"></canvas>';
                } else {
                    echo '<p>Nessun prestito effettuato</p>';
                }
                echo '
                        </div>
                    </div>
                </div>
            </main>

            <div class="col-md-5 ms-sm-9" style="margin-left: 10px;">
                <div class="flex-row d-inline-flex " style=" padding-bottom: 10px;">
                    <div class="grafico_linee grafico_verde justify-content-center">
                        <p class="testo_titolo light">Libri in prestito</p>
                        <p style=" bottom:20px;position:relative; float:right; margin-bottom:0px;padding-right:10px; color:#FFFFFF;">';
                if (($restituiti + $nonrestituiti) != 0) {
                    echo round((($restituiti / ($restituiti + $nonrestituiti)) * 100), PHP_ROUND_HALF_UP);
                } else {
                    echo 0;
                }
                echo '%</p>
                        ';
                if (($restituiti + $nonrestituiti) != 0) {
                    echo '<canvas id="grafico2" height="250px" style="padding-bottom: 10px;"></canvas>';
                } else {
                    echo '<p style="color:#FFFFFF;">Nessun prestito effettuato</p>';
                }
                echo '</div>
                </div>
                <div class="flex-row d-inline-flex">
                    <div class="col">
                        <div class="row bordo">
                            <div class="col card col2">
                                <div class="card-body">
                                    <p class="testo_titolo">Libri</p>
                                    <p class="testo_contenuto">
                                        ' . $countlibri . '
                                        <span class="iconify icone" data-icon="fa-solid:book" data-inline="false"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row bordo">
                            <div class="col col2 card">
                                <div class="card-body">
                                    <p class="testo_titolo">Autori</p>
                                    <p class="testo_contenuto">
                                        ' . $countautori . '
                                        <span class="iconify icone" data-icon="oi-pencil" data-inline="false"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row bordo">
                            <div class="col col2 card">
                                <div class="card-body">
                                    <p class="testo_titolo">Generi</p>
                                    <p class="testo_contenuto">
                                        ' . $countgeneri . '
                                        <span class="iconify icone" data-icon="fa-solid:book-open" data-inline="false"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row bordo">
                            <div class="col col2 card">
                                <div class="card-body">
                                    <p class="testo_titolo">Utenti</p>
                                    <p class="testo_contenuto">
                                        ' . $countutenti . '
                                        <span class="iconify icone" data-icon="fa-solid:user" data-inline="false"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            } elseif ($iddato == 2) {
                if ($rows == 0) {
                    echo 'Nessun libro trovato';
                } else {
                    echo '
                <table class="table table-bordered">
                <thead>
                <th><a href="grafici.php?ID=2&TYPE=titolo">Titolo';
                    if ($typedato == "titolo") {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                    } else {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                    }
                    echo '</a></th>
                
                <th><a href="grafici.php?ID=2&TYPE=editore">Editore';
                    if ($typedato == "nomeeditore") {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                    } else {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                    }
                    echo '</a></th>

                <th><a href="grafici.php?ID=2&TYPE=autore">Autore';
                    if ($typedato == "autore") {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                    } else {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                    }
                    echo '</a></th>

                <th><a href="grafici.php?ID=2&IDBOOK=&TYPE=copie">Copie';
                    if ($typedato == "copie") {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                    } else {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                    }
                    echo '</a></th>
                <th></th>
                </thead>
                <tbody><form action="modifica_inserimento.php" method="POST">';
                    while ($crow = mysqli_fetch_array($nquery)) {
                        echo '<input type="hidden" id="control" name="control" value="1"></input> <tr>
                            <td>' . $crow['Titolo'] . '</td>
                            <td>' . $crow['Nomeeditore'] . '</td>
                            <td>' . $crow['Nomeautore'] . ' ' . $crow['Cognomeautore'] . '</td>';
                        if (is_null($crow['Numero_Copie'])) {
                            echo '<td>0</td>';
                        } else {
                            echo '<td>' . $crow['Numero_Copie'] . '</td>';
                        }
                        echo '<td><div> <button value="' . $crow['ID'] . '" name="ID" id="ID" class="btn rettangolo_giallo tratteggiato" >Modifica</button>    <a class="btn rettangolo_rosso tratteggiato" href="php/delete_book.php?ID=' . $crow['ID'] . '">Elimina</a> </div></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>
            </table>
            <div id="pagination_controls" class="" style="display:flex;align-items:center;">' . $paginationCtrls . '</div>
             </div>
</form>';
                }
            } elseif ($iddato == 3) {
                    echo '<form style="margin-top:unset; display:contents;" action="php/update_prestiti.php" method="POST" name="inputprestiti" id="inputprestiti" enctype="multipart/form-data">
                    <table class="table';if ($rows == 0) {}else{echo' table-bordered';}echo'">
                <thead>
                <th><a href="grafici.php?ID=3&TYPE=utente">Utente';
                    if ($typedato == "utente") {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                    } else {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                    }
                    echo '</a></th>
                
                <th><a href="grafici.php?ID=3&TYPE=libro">Libro';
                    if ($typedato == "libro") {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                    } else {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                    }
                    echo '</a></th>

                <th><a href="grafici.php?ID=3&TYPE=dataprestito">Data Prestito';
                    if ($typedato == "dataprestito") {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                    } else {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                    }
                    echo '</a></th>

                <th><a href="grafici.php?ID=3&TYPE=datareso">Data Reso';
                    if ($typedato == "datareso") {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                    } else {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                    }
                    echo '</a></th>

                <th><a href="grafici.php?ID=3&TYPE=stato">Stato';
                    if ($typedato == "stato") {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                    } else {
                        echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                    }
                    echo '</a></th>
                </thead>';
                if ($rows == 0) {
                    echo '<tbody><td></td><td></td><td><h1 class="h2">Nessun prestito effettuato</h1></td></tbody>';
                }else{echo'
                <tbody>';
                    while ($crow = mysqli_fetch_array($nquery)) {
                        echo ' <tr>
                            
                            <td><input type="checkbox" style="" name="primary[]" value="' . str_replace(' ', '_', $crow['Email']) . ' ' . str_replace(' ', '_', $crow['ID']) . ' ' . str_replace(' ', '_', $crow['Prestito']) . '"/>' . $crow['Email'] . '</td>
                            <td>' . $crow['Titolo'] . '</td>
                            <td>' . $crow['Prestito'] . '</td>
                            <td>' . $crow['Riconsegna'] . '</td>';
                        if (is_null($crow['Riconsegna'])) {
                            $countnoreso = $countnoreso + 1;
                            echo '<td><div class="rettangolo_giallo">DA RESTITUIRE</div></td>';
                        } else {
                            echo '<td><div class="rettangolo_verde">IN CUSTODIA</div></td>';
                        }
                        echo '</tr>';
                    }
                    echo '</tbody>';}
            echo'</table>
            <div id="pagination_controls" class="" style="display:flex;align-items:center;">' . $paginationCtrls . '</div>
            <div class="d-flex justify-content-end" style="width:-webkit-fill-available";>';
            if ($rows == 0) {}else{echo'<button type="submit" style="margin-right:4px" name="scelta" id="scelta" class="rettangolo_verde ';
                    if ($countnoreso == 0) {
                        echo 'disabled" value="chiudi"disabled';
                    } else {
                        echo 'tratteggiato" value="chiudi"';
                    }
                    echo '>Chiudi Prestito</button>
                    <!--<button type="submit" name="scelta" id="scelta" class="rettangolo_rosso tratteggiato" value="rimuovi">Rimuovi</button>-->';}
                echo'
            </div>
</form>';
            } elseif ($iddato == 4) {
                echo '
                <table class="table';if ($rows == 0) {}else{echo' table-bordered';}echo'">
                <thead>
                <th><a href="grafici.php?ID=4&IDBOOK=' . $IDBOOK . '&TYPE=utente">Utente';
                if ($typedato == "utente") {
                    echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                } else {
                    echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                }
                echo '</a></th>
                
                <th><a href="grafici.php?ID=4&IDBOOK=' . $IDBOOK . '&TYPE=dataprestito">Data Prestito';
                if ($typedato == "dataprestito") {
                    echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                } else {
                    echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                }
                echo '</a></th>

                <th><a href="grafici.php?ID=4&IDBOOK=' . $IDBOOK . '&TYPE=datareso">Data Reso';
                if ($typedato == "datareso") {
                    echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                } else {
                    echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                }
                echo '</a></th>

                <th><a href="grafici.php?ID=4&IDBOOK=' . $IDBOOK . '&TYPE=stato">Stato';
                if ($typedato == "stato") {
                    echo '<span class="iconify" data-icon="eva:arrow-ios-downward-outline" data-inline="false"></span>';
                } else {
                    echo '<span class="iconify" data-icon="eva:arrow-ios-upward-outline" data-inline="false"></span>';
                }
                echo '</a></th>
                </thead>';
                if ($rows == 0) {
                    echo '<tbody><td></td><td></td><td><h1 class="h2">Nessun prestito effettuato</h1></td></tbody>';
                } else {
                    echo '
                <tbody>';
                    while ($crow = mysqli_fetch_array($nquery)) {
                        echo ' <tr>
                            <td>' . $crow['Email'] . '</td>
                            <td>' . $crow['Prestito'] . '</td>
                            <td>' . $crow['Riconsegna'] . '</td>';
                        if (is_null($crow['Riconsegna'])) {
                            echo '<td><div class="rettangolo_giallo">DA RESTITUIRE</div></td>';
                        } else {
                            echo '<td><div class="rettangolo_verde">IN CUSTODIA</div></td>';
                        }
                        echo '</tr>';
                    }
                    echo '</tbody>';
                }
                echo'</table>
                <div id="pagination_controls" class="" style="display:flex;align-items:center;">' . $paginationCtrls . '</div>
                 </div>
    </form>';
            }
            ?>
        </div>

    </div>
</body>

<script>
    if (iddato == 1 || iddato == null) {
        //Grafico 1
        var ctx = document.getElementById('grafico1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: mesi,
                datasets: [{
                    label: '# di registrazioni',
                    data: val,
                    borderColor: 'rgba(31, 120, 180, 1)',
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //Grafico 2
        var ctx2 = document.getElementById('grafico2').getContext('2d');
        var grafico2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['restituiti', 'Non restituiti'],
                datasets: [{
                    label: '',
                    data: [restituiti, nonrestituiti],
                    backgroundColor: [
                        'rgba(255, 255, 255, 1)',
                        'rgba(188, 188, 188, 1)',
                        'rgba(139, 214, 83, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: 80,
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            },
            centerText: {
                display: true,
                text: "280"
            }
        });

        //Grafico 3
        var ctx3 = document.getElementById('grafico3').getContext('2d');
        var grafico3 = new Chart(ctx3, {
            type: 'doughnut',
            data: {
                labels: nomecategoria,
                datasets: [{
                    label: '# of Votes',
                    data: contocategoria,
                    backgroundColor: [
                        'rgba(110, 167, 206, 1)',
                        'rgba(243, 212, 4, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ]
                }]
            },
            options: {
                cutout: 80,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        //Grafico 4
        var ctx4 = document.getElementById('grafico4').getContext('2d');
        var grafico4 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: nomelibro,
                datasets: [{
                    label: 'libro',
                    data: contolibro,
                    borderColor: 'rgba(139, 214, 83, 1)',
                    backgroundColor: 'rgba(139, 214, 83, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        display: false,
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    /*
        //Grafico 5
        if (iddato == 4) {
            var ctx5 = document.getElementById('grafico5').getContext('2d');
            var grafico5 = new Chart(ctx5, {
                type: 'doughnut',
                data: {
                    labels: ['Libri Totali', 'libro'],
                    datasets: [{
                        label: '',
                        data: [countlibri, countlibriselect],
                        backgroundColor: [
                            'rgba(110, 167, 206, 1)',
                            'rgba(243, 212, 4, 1)',
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    cutout: 80,
                    responsive: false,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                },
                centerText: {
                    display: true,
                    text: "280"
                }
            });
        }*/
</script>

</html>