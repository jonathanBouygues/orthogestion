<?php

if (isset($_POST['nomModPatient']) && isset($_POST['choixChamps']) && ((isset($_POST['itemModPatient'])) || (isset($_POST['modMed'])) || (isset($_POST['modBilan'])) || (isset($_POST['modActe'])) || (isset($_POST['modEtab'])))) {


    if ($_POST['modMed'] != 0) {
        $valuePatient = $_POST['modMed'];
    } else if ($_POST['modEtab'] != 0) {
        $valuePatient = $_POST['modEtab'];
    } else if ($_POST['modBilan'] != 0) {
        $valuePatient = $_POST['modBilan'];
    } else if ($_POST['modActe'] != 0) {
        $valuePatient = $_POST['modActe'];
    } else {
        $valuePatient = $_POST['itemModPatient'];
    }

    $idPatient = $_POST['nomModPatient'];
    $champsPatient = $_POST['choixChamps'];

    // connection's id
    include 'connexion.php';
    // // Request to send
    $requete = "UPDATE `liste_patient` SET `$champsPatient` = '$valuePatient' WHERE pat_num ='$idPatient'";
    // Send the request and check the result
    if ($connDB->exec($requete)) {
        // request ok;
    } else {
        // request KO and insert in log file
        $nomRequete = $requete;
        // Write Log
        include 'traitWriteLog.php';
    }

    // // DB's deconnection
    if (isset($connDB)) {
        unset($connDB);
    }

} 

// Back to planning.php
header('Location: ../patient.php');
