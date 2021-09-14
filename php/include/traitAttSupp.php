<?php

// include the regExp
include 'regexp.php';

// Get the datas with the post's method
if ($regExp->checkIntegerNn($_POST['valueDeleteAttente'])) {

    // initialisation
    $idSupp = trim($_POST['valueDeleteAttente']);

    // DB's connection in PDO
    include 'connexion.php';
    // Request to send
    $req_suppAtt = "UPDATE `liste_attente` SET `att_archive`= 'Archive' WHERE att_id ='$idSupp'";
    // Send the request and check the result
    if ($connDB->exec($req_suppAtt)) {
        // request ok;
    } else {
        // request KO and insert in log file
        $nomRequete = $req_suppAtt;
        // Write Log
        include 'traitWriteLog.php';
    }
    
    // DB's deconnection
    if (isset($connDB)) {
        unset($connDB);
    }

}

// Back to the link attente.php
header('Location: ../attente.php');