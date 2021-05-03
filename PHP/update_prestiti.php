<?php
include("connection.php");
$db_connection = connection("biblioteca");

$check = $_POST['primary'];
$valori = array();


foreach ($check as $miao => $value) {
    $valori = explode(" ", $value);
    $valori[2] = str_replace("_", " ", $valori[2]);
    echo $valori[0] . "<br>" . $valori[1] . "<br>" . $valori[2] . "<br>";
    if ($_POST['scelta'] == 'rimuovi') {
        $select = "DELETE FROM prestare WHERE prestare.Email_Utente = ? AND prestare.ID_Libro = ? AND prestare.Data_Prestito = ?";
        $stmt = $db_connection->prepare($select);
        $stmt->bind_param("sis", $valori[0], $valori[1], $valori[2]);
        $stmt->execute();
    } else {
        $select = "UPDATE prestare SET Data_Riconsegna = current_timestamp() WHERE prestare.Email_Utente = ? AND prestare.ID_Libro = ? AND prestare.Data_Prestito = ?";
        $stmt = $db_connection->prepare($select);
        $stmt->bind_param("sis", $valori[0], $valori[1], $valori[2]);
        $stmt->execute();
    }
    $select = "UPDATE libro SET Numero_Copie = Numero_Copie + 1 WHERE ID = ?";
    $stmt = $db_connection->prepare($select);
    $stmt->bind_param("i", $valori[1]);
    $stmt->execute();
}
header("Location:https://".$_SERVER['HTTP_HOST']."/UDA_5/grafici.php?ID=3");
//TODO:CAMBIARE PATH QUANDO è SUL SERVER FINALE
