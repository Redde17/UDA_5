<?php
include("connection.php");
$db_connection = connection("biblioteca");


if ($_FILES["tag_carica"]['error'] == 4) {
} else {
    //GENERAZIONE nome randomico
    $file = uniqid() . "." . pathinfo($_FILES["tag_carica"]["name"], PATHINFO_EXTENSION);
    $target_dir = "../img/"; /*Directory di destinazione del server */
    $target_file = $target_dir . $file;
    echo $target_file;
}

@$id = $_POST['id'];
@$control = $_POST['control'];

$nome = strtolower($_POST['nome']);
$nome = ucfirst($nome);

$check = $_POST['categorie'];


$nomeautore = strtolower($_POST['nomeautore']);
$nomeautore = ucfirst($nomeautore);

$cognomeautore = strtolower($_POST['cognomeautore']);
$cognomeautore = ucfirst($cognomeautore);

$nomeeditore = strtolower($_POST['nomeeditore']);
$nomeeditore = ucfirst($nomeeditore);

$descrizione = $_POST['descrizione'];
$copie = $_POST['copie'];


echo "<br>a" . isset($id) . "b<br>" . $file . "<br>" . $nome . "<br>" . $check . "<br>" . $nomeautore . "<br>" . $cognomeautore . "<br>" . $nomeeditore . "<br>" . $descrizione . "<br>" . $copie . "<br>";

//CONTROLLO EDITORE
$selecteditore = "SELECT EXISTS (SELECT Nome FROM editore WHERE Nome =?)";
$stmt = $db_connection->prepare($selecteditore);
$stmt->bind_param("s", $nomeeditore);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($ris);
echo $ris . "<br>";
$stmt->fetch();
$stmt->close();
if ($ris == 0) { //SE L'EDITORE NON é PRESENTE
    echo "<br> Editore non presente. Inserimento database";
    $inserimentoeditore = "INSERT INTO editore(Nome) VALUES (?)";
    $stmt = $db_connection->prepare($inserimentoeditore);
    $stmt->bind_param("s", $nomeeditore);
    $stmt->execute();
}
//OTIENIMENTO EDITORE
$stmt = $db_connection->prepare("SELECT editore.Codice FROM editore WHERE editore.Nome = ?");
$stmt->bind_param("s", $nomeeditore);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($ideditore);
$stmt->fetch();
$stmt->close();

//CONTROLLO AUTORE
$selectautore = "SELECT EXISTS (SELECT Nome,Cognome FROM autore WHERE Nome =? AND Cognome = ?)";
$stmt = $db_connection->prepare($selectautore);
$stmt->bind_param("ss", $nomeautore, $cognomeautore);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($ris);
$stmt->fetch();
$stmt->close();
if ($ris == 0) { //SE L'AUTORE NON è presente
    echo "<br> autore non presente. Inserimento database";
    $inserimentoautore = "INSERT INTO autore(Nome,Cognome) VALUES (?,?)";
    $stmt = $db_connection->prepare($inserimentoautore);
    $stmt->bind_param("ss", $nomeautore, $cognomeautore);
    $stmt->execute();
}
$stmt = $db_connection->prepare("SELECT autore.id FROM autore WHERE autore.nome = ? AND autore.cognome = ?");
$stmt->bind_param("ss", $nomeautore, $cognomeautore);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($idautore);
$stmt->fetch();
$stmt->close();

if (!isset($id)) { //SE si sta inserendo un libro

    //INSERIMENTO LIBRO E OTTIENIMENTO DELL'ID
    $sql = "INSERT INTO libro(Titolo,Codice_Editore,Descrizione,Numero_copie,Immagine,ID_Autore) VALUES (?,?,?,?,?,?)";
    $stmt = $db_connection->prepare($sql);
    $stmt->bind_param("sssisi", $nome, $ideditore, $descrizione, $copie, $file, $idautore);
    $stmt->execute();
    move_uploaded_file($_FILES["tag_carica"]["tmp_name"], $target_file);
    $stmt = $db_connection->prepare("SELECT libro.id FROM libro WHERE libro.titolo = ? AND libro.descrizione = ? AND libro.Immagine = ?");
    $stmt->bind_param("sss", $nome, $descrizione, $file);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();

    //INSERIMENTO GENERI
    foreach ($check as $var_generi) {
        $sql = "INSERT INTO appartiene(Nome_Categoria,ID_Libro) VALUES (?,?)";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("si", $var_generi, $id);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
} else {
    if ($_FILES["tag_carica"]['error'] == 4) { // Se non è stata caricata una nuova immagine
        $sql = "UPDATE libro SET Titolo = ? ,Codice_Editore = ? , Descrizione = ? , Numero_copie = ? , ID_Autore = ? WHERE ID = ?";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("sisiii", $nome, $ideditore, $descrizione, $copie, $idautore, $id);
        $stmt->execute();
    } else { // se è stata caricata
        //Eliminazione della copertina precedente
        $selectlibro = "SELECT libro.Immagine FROM libro WHERE libro.ID = ?";
        $stmt = $db_connection->prepare($selectlibro);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($pathvecchia);
        $stmt->fetch();
        $stmt->close();
        unlink($target_dir. $pathvecchia);

        $sql = "UPDATE libro SET Titolo = ? ,Codice_Editore = ? , Descrizione = ? , Numero_copie = ? , Immagine = ? , ID_Autore = ? WHERE ID = ?";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("sisisii", $nome, $ideditore, $descrizione, $copie, $file, $idautore, $id);
        $stmt->execute();
        move_uploaded_file($_FILES["tag_carica"]["tmp_name"], $target_file);
    }
    $stmt = $db_connection->prepare("SELECT libro.id FROM libro WHERE libro.titolo = ? AND libro.descrizione = ? AND libro.Immagine = ?");
    $stmt->bind_param("sss", $nome, $descrizione, $file);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();

    //ELIMINAZIONE DEI GENERI ESISTENTI 
    $sql = "DELETE FROM appartiene WHERE ID_Libro = ?";
    $stmt = $db_connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();

    //INSERIMENTO GENERI
    foreach ($check as $var_generi) {
        echo "<br> categoria selezionata non presente. Inserimento database";
        $sql = "INSERT INTO appartiene(Nome_Categoria,ID_Libro) VALUES (?,?)";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("si", $var_generi, $id);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
}

if(isset($control)){
    header("Location:https://".$_SERVER['HTTP_HOST']."/UDA_5/grafici.php");
}else{
    header("Location:https://".$_SERVER['HTTP_HOST']."/UDA_5/index.php");
}

//TODO:CAMBIARE PATH QUANDO è SUL SERVER FINALE