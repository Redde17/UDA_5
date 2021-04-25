<?php
    function connection($DBname){
        $DBhost = "localhost";
        $DBlogin = "root";
        $DBpass = "123";
        
        $conn = new mysqli($DBhost, $DBlogin, $DBpass, $DBname);

        if($conn->connect_error){
            echo("connection error:" . $conn->connect_error);
            return NULL;
        } else{
            return $conn;
        }
    }
?>