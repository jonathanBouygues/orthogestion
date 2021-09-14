<?php 

// include the regExp
include 'regexp.php';

// Before the injection, check by RegExp
if ($regExp->checkDateNn($_POST['dateInputBilan']) && $regExp->checkTxtStNn($_POST['nomInputBilan']) &&$regExp->checkDecimalNn($_POST['montantInputBilan'])) {

    // Initialisation
    $typeInput = 'jour';

    // connection's id
    include 'connexion.php';
    // new's request to send
    $requeteFin = "INSERT INTO `finance` (`fin_date`,`fin_montant`,`fin_nom`,`fin_type`) VALUES (:dateInput,:montantInput,:nomInput,:typeInput)"; 
    // Target to send
    $modele = $connDB->prepare($requeteFin);
    // Bind Value
    $modele->bindParam('dateInput', $_POST['dateInputBilan']);
    $modele->bindParam('montantInput', $_POST['montantInputBilan']);
    $modele->bindParam('nomInput', $_POST['nomInputBilan']);
    $modele->bindParam('typeInput', $typeInput);
    // Send the request and check the result
    if ($modele->execute()) {
        // echo 'ok';
    } else {
        // request KO and insert in log file
        $nomRequete = $requeteFin;
        // Write Log
        include 'traitWriteLog.php';
    }

    // DB's cut off
    if ($connDB) {
        unset($connDB);
    }
    
} else {
    // echo "pas ok";
}

// Back to the bilan
header('Location: ../bilan.php');