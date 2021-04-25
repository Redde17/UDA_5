<?php

include("connection.php");

$db_connection = connection("biblioteca");

$color = $_POST['colore'];
$genere = $_POST['nuovogenere'];

$sql = "SELECT EXISTS (SELECT Nome FROM categoria WHERE Nome =?)";
$stmt = $db_connection->prepare($sql);
$stmt->bind_param("s", $genere);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($ris);
$stmt->fetch();
$stmt->close();

if ($ris == 0) {
    $sql1 = "INSERT INTO categoria(nome,colore) VALUES (?,?)";
    $stmt = $db_connection->prepare($sql1);
    $stmt->bind_param("ss", $genere, $color);
    $stmt->execute();
} else {
    echo "exist";
}
?>