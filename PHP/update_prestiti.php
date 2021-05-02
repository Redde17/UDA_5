<?php
include("connection.php");
$db_connection = connection("biblioteca");
$check = $_POST['primary'];

$valori = array();

foreach ($check as $miao => $value) {

    $valori = explode(" ",$value);
    $valori[2] = str_replace("_"," ",$valori[2]);
    echo $valori[0] . "<br>" . $valori[1] . "<br>" . $valori[2] . "<br>";

    $select = "DELETE FROM prestare WHERE prestare.Email_Utente = ? AND prestare.ID_Libro = ? AND prestare.Data_Prestito = ?";
    $stmt = $db_connection->prepare($select);
    $stmt->bind_param("sis", $valori[0],$valori[1],$valori[2]);
    $stmt->execute();
}