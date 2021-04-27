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
    @$iddato = $_GET['id'];
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
    
        $query = "SELECT (SELECT COUNT(*) FROM libro) as libri,(SELECT COUNT(*) FROM utente) AS utenti,(SELECT COUNT(*) FROM autore) AS autori,(SELECT COUNT(*) FROM categoria) as generi FROM prestare LIMIT 1";
        $inter = $db_connection->query($query);
        if ($inter->num_rows > 0) {
            while ($row = $inter->fetch_assoc()) {
                $countlibri = $row['libri'];
                $countautori = $row['autori'];
                $countgeneri = $row['generi'];
                $countutenti = $row['utenti'];
            }
        }

        //FINE QUINTA QUERY
    } else if ($iddato == 3) {
        @$typedato = $_GET['type']; 
        //INIZIO QUERY INPAGINAZIONE
        $query = "SELECT COUNT(*) FROM prestare";
        $query = $db_connection->query($query);
        $row = mysqli_fetch_row($query);

        $rows = $row[0];

        $page_rows = 3; //Righe massime

        $last = ceil($rows / $page_rows);

        if ($last < 1) {
            $last = 1;
        }

        $pagenum = 1;

        if (isset($_GET['pn'])) {
            $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
        }

        if ($pagenum < 1) {
            $pagenum = 1;
        } else if ($pagenum > $last) {
            $pagenum = $last;
        }

        $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;

        $istruzione = "SELECT utente.Nome as Nome, utente.Cognome as Cognome,libro.Titolo as Titolo, prestare.Data_Prestito as Prestito, prestare.Data_Riconsegna as Riconsegna FROM utente,libro,prestare WHERE utente.Email = prestare.Email_Utente AND prestare.ID_Libro = libro.ID";
        switch ($typedato) {
            case 'utente':
                $istruzione=$istruzione." ORDER BY utente.Nome";
                break;
            
            case 'libro':
                $istruzione = $istruzione." ORDER BY libro.Titolo";
                break;
            
            case 'dataprestito':
                $istruzione = $istruzione." ORDER BY prestare.Data_Prestito";
                break;
            
            case 'datareso':
                $istruzione = $istruzione." ORDER BY prestare.Data_Riconsegna DESC";
                break;
            
            case 'stato':
                $istruzione = $istruzione." ORDER BY prestare.Data_Riconsegna DESC";
            default:
                # code...
                break;
        }
        $istruzione= $istruzione.' '.$limit;
        $nquery = $db_connection->query($istruzione);


        $paginationCtrls = '';

        if ($last != 1) {

            if ($pagenum > 1) {
                $previous = $pagenum - 1;
                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?id=3';
                if(isset($typedato)){
                    $paginationCtrls.= '&type='.$typedato;
                }
                $paginationCtrls.= '&pn=' . $previous . '" class="btn btn-default">Previous</a> &nbsp; &nbsp; ';

                for ($i = $pagenum - 4; $i < $pagenum; $i++) {
                    if ($i > 0) {
                        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?id=3';
                        if(isset($typedato)){
                            $paginationCtrls.= '&type='.$typedato;
                        }
                        $paginationCtrls.= '&pn=' . $i . '" class="btn btn-default">' . $i . '</a> &nbsp; ';
                    }
                }
            }

            $paginationCtrls .= '' . $pagenum . ' &nbsp; ';

            for ($i = $pagenum + 1; $i <= $last; $i++) {
                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?id=3';
                if(isset($typedato)){
                    $paginationCtrls.= '&type='.$typedato;
                }
                $paginationCtrls.= '&pn=' . $i . '" class="btn btn-default">' . $i . '</a> &nbsp; ';

                if ($i >= $pagenum + 4) {
                    break;
                }
            }

            if ($pagenum != $last) {
                $next = $pagenum + 1;
                
                $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?id=3';
                if(isset($typedato)){
                    $paginationCtrls.= '&type='.$typedato;
                }
                '&pn=' . $next . '" class="btn btn-default">Next</a> ';
            }
        }
    }
    
    ?>

    <script>
        var nomelibro = <?php echo json_encode($nomelibro); ?>;
        var contolibro = <?php echo json_encode($contolibro); ?>;

        var nomecategoria = <?php echo json_encode($nomecategoria); ?>;
        var contocategoria = <?php echo json_encode($contocategoria); ?>;

        var nonrestituiti = <?php echo json_encode($nonrestituiti); ?>;
        var restituiti = <?php echo json_encode($restituiti); ?>;

        var mesi = <?php echo json_encode($mesi); ?>;
        var val = <?php echo json_encode($val); ?>;
    </script>

    <div class="w3-sidebar w3-text-white w3-bar-block" style="width:16%">
        <a href="index.php">
            <h3 class="w3-bar-item"><img src="resources/Logo.png" alt="" srcset="" style="height:56px;width:56px; margin-right:5px">Web Book Library</h3>
        </a>
        <a href="grafici.php?id=1" class="w3-bar-item" style="margin-top:100px">Dashboard</a>
        <a href="#" class="w3-bar-item">Libro</a>
        <a href="grafici.php?id=3" class="w3-bar-item">Prestiti</a>
        <a href="" class="w3-bar-item" style="margin-top: 150%;">Logout</a>
    </div>

    <div class="container" style="margin-left:19%">
        <div class="row" style="justify-content:space-between;">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Rapporto</h1>

            </div>
            <div class="d-flex align-items-center justify-content-between" style="padding-right:30px">
                <p class="login_text"> Nome Cognome</p>
            </div>

        </div>

        <div class="row">
            <?php
            if ($iddato == 1) {
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
                            <p class="testo_titolo" style="padding-bottom: 30px;">Generi più letti</p>
                            <canvas id="grafico3"></canvas>
                        </div>
                        <div class="grafico_linee" style="height:450px;">
                            <p class="testo_titolo">Libri più letti</p>
                            <canvas id="grafico4" height="400px"></canvas>
                        </div>
                    </div>
                </div>
            </main>

            <div class="col-md-5 ms-sm-9" style="margin-left: 10px;">
                <div class="flex-row d-inline-flex " style=" padding-bottom: 10px;">
                    <div class="grafico_linee grafico_verde justify-content-center">
                        <p class="testo_titolo light">Libri in prestito</p>
                        <p style=" bottom:20px;position:relative; float:right; margin-bottom:0px;padding-right:10px; color:#FFFFFF;">' . (($restituiti / ($restituiti + $nonrestituiti)) * 100) . '%' . '</p>
                        <canvas id="grafico2" height="250px" style="padding-bottom: 10px;"></canvas>
                    </div>
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
            }elseif($iddato == 3){
                echo'<table class="table table-bordered">
                <thead>
                    <th><a href="grafici.php?id=3&type=utente">Utente</a></th>
                    <th><a href="grafici.php?id=3&type=libro">Libro</a></th>
                    <th><a href="grafici.php?id=3&type=dataprestito">Data Prestito</a></th>
                    <th><a href="grafici.php?id=3&type=datareso">Data Reso</a></th>
                    <th><a href="grafici.php?id=3&type=stato">Stato</a></th>
                </thead>
                <tbody>';
                    while ($crow = mysqli_fetch_array($nquery)) {
                        echo' <tr>
                            <td>'.$crow['Nome'].' '.$crow['Cognome'].'</td>
                            <td>'.$crow['Titolo'].'</td>
                            <td>'.$crow['Prestito'].'</td>
                            <td>'.$crow['Riconsegna'].'</td>';
                            if(is_null($crow['Riconsegna'])){
                                echo'<td><div class="rettangolo_giallo">DA RESTITUIRE</div></td>';
                            }else{
                                echo'<td><div class="rettangolo_verde">IN CUSTODIA</div></td>';
                            }
                        echo'</tr>';
                    }
                echo'</tbody>
            </table>
            <div id="pagination_controls">'.$paginationCtrls.'</div>';
        }
            ?>
        </div>

    </div>
</body>

<script>
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
</script>

</html>