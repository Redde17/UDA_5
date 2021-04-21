<?php
    session_start();
    date_default_timezone_set('Europe/Rome');

    include "./PHP/connection.php";

    $conn = connection("biblioteca");

    switch($_POST["method"]){
        case 0:
            //login
            $stmt = $conn->prepare("SELECT EXISTS(SELECT * FROM utente WHERE Email = ? AND Password1 = ?)");
            $stmt->bind_param("ss", $_POST["email"], $_POST["password"]);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($exist);
            $stmt->fetch();
            $stmt->close();
            if($exist){
                $_SESSION["logged"] = true;
                $_SESSION["email"] = $_POST["email"];
            }else{
                echo '<div class="alert alert-danger anim-shake" role="alert">Password o email errata!</div>';
            }
            break;

        case 1:
            //registrazione
            $stmt = $conn->prepare("SELECT EXISTS(SELECT * FROM utente WHERE Email = ?)");
            $stmt->bind_param("s", $_POST["email"]);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($exist);
            $stmt->fetch();
            $stmt->close();

            if($exist){
                echo '<div class="alert alert-danger anim-shake" role="alert">Account già esistente!</div>';
            }else{
                $stmt = $conn->prepare("INSERT INTO utente(Nome, Email, Password1, Data_Registrazione) VALUES(?, ?, ?, ?)");
                $current_date = date('Y-m-d');
                $stmt->bind_param("ssss", $_POST["nome"], $_POST["email"], $_POST["password"], $current_date);
                $stmt->execute();
                $stmt->close();

                $_SESSION["logged"] = true;
                $_SESSION["email"] = $_POST["email"];
            }
            break;

        case 2:
            //modifica dati utente
            $stmt = $conn->prepare("UPDATE utente SET Nome = ?, Cognome = ?, Telefono = ? WHERE Email = ?");
            $stmt->bind_param("ssss", $_POST["nome"], $_POST["cognome"], $_POST["telefono"], $_SESSION["email"]);
            $stmt->execute();
            $stmt->close();
            break;

        case 3:
            //avvenimeto prestito
            $stmt = $conn->prepare("INSERT INTO prestare(Email_Utente, ID_Libro, Data_Prestito) VALUES (?, ?, ?)");
            $current_date = date('Y-m-d H:i:s');
            $stmt->bind_param("sss", $_SESSION["email"], $_POST["ID"], $current_date);
            $stmt->execute();
            $stmt->close();

            $conn->query("UPDATE libro SET Numero_Copie = Numero_Copie - 1 WHERE ".$_POST["ID"]." = ID");

            header('Location: book.php?ID='.$_POST["ID"]);
            break;

        case 4:
            //avvenimeto reso
            $stmt = $conn->prepare("UPDATE prestare SET Data_Riconsegna = ? WHERE Email_Utente = ? AND ID_Libro = ? AND Data_Prestito = (SELECT MAX(Data_Prestito) FROM prestare WHERE Email_Utente = ? AND ID_Libro = ?)");
            $current_date = date('Y-m-d H:i:s');
            $stmt->bind_param("sssss", $current_date, $_SESSION["email"], $_POST["ID"], $_SESSION["email"], $_POST["ID"]);
            $stmt->execute();
            $stmt->close();

            $conn->query("UPDATE libro SET Numero_Copie = Numero_Copie + 1 WHERE ".$_POST["ID"]." = ID");

            header('Location: book.php?ID='.$_POST["ID"]);
            break;
    }

?>