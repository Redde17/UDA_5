<?php
include("connection.php");

$db_connection = connection("biblioteca");

$select = "SELECT * FROM categoria";

$generi = mysqli_query($db_connection, $select);

$arr = array();

/*while ($row = mysqli_fetch_row($generi)) {
    array_push( $arr, $row[0],$row[1] );
}*/


$row = $generi->fetch_all(MYSQLI_ASSOC);


?>