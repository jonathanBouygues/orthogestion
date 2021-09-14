<?php

if (isset($_POST['nomDeletePatient'])) {
    
    $id = $_POST['nomDeletePatient'];
    // connection's id
    include 'connexion.php';
    // Request to send
    $requete = "UPDATE `liste_patient` SET pat_archive = 'archive' WHERE pat_num ='$id'";
    // Send the request and check the result
    if ($connDB->exec($requete)) {
        // request ok;
    } else {
        // request KO and insert in log file
        $nomRequete = $requete;
        // Write Log
        include 'traitWriteLog.php';
    }

    // DB's deconnection
    if (isset($connDB)) {
        unset($connDB);
    }

} 

// Back to planning.php
header('Location: ../patient.php');
