<?php
include("connection.php");
$db_connection = connection("biblioteca");
$ID = $_GET['ID'];

$select = "DELETE FROM prestare WHERE ID_Libro=?";
$stmt = $db_connection->prepare($select);
$stmt->bind_param("i", $ID);
$stmt->execute();

$select = "DELETE FROM appartiene WHERE ID_Libro=?";
$stmt = $db_connection->prepare($select);
$stmt->bind_param("i", $ID);
$stmt->execute();

$select = "DELETE FROM libro WHERE ID=?";
$stmt = $db_connection->prepare($select);
$stmt->bind_param("i", $ID);
$stmt->execute();

header("Location:https://".$_SERVER['HTTP_HOST']."/UDA_5/grafici.php?ID=2");
//TODO:CAMBIARE PATH QUANDO è SUL SERVER FINALE

?>