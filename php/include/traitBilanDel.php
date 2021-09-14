<?php 

// if write on url
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');    
}

// connection's id
include 'connexion.php';
// new's request to send
$requeteDelFin = "UPDATE `finance` SET `fin_archive` = 'archive' WHERE fin_id = :inputId";
// Target to send
$modele = $connDB->prepare($requeteDelFin);
// Bind Value
$modele->bindParam('inputId', $_POST['idInputBilan']);
// Send the request and check the result
if ($modele->execute()) {
    // echo 'ok';
} else {
    // request KO and insert in log file
    $nomRequete = $requeteDelFin;
    // Write Log
    include 'traitWriteLog.php';
}

// DB's cut off
if ($connDB) {
    unset($connDB);
}

// Back to the bilan
header('Location: ../bilan.php');