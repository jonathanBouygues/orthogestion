<?php

// include the regExp
include 'regexp.php';

// Récupération des infos en poste
if (($regExp->checkIntegerNn($_POST['valueModifyId'])) && (isset($_POST['choixChamps'])) && (isset($_POST['valueModifyAttente']))) {

    $idModify = trim($_POST['valueModifyId']);
    $champsModify = trim($_POST['choixChamps']);
    $valueModify = trim($_POST['valueModifyAttente']);
    
    // DB's connection in PDO
    include 'connexion.php';
    // Request to send
    $req_modifyAtt = "UPDATE `liste_attente` SET `$champsModify` = '$valueModify' WHERE att_id ='$idModify'";
    // Send the request and check the result
    if ($connDB->exec($req_modifyAtt)) {
        // request ok;
    } else {
        // request KO and insert in log file
        $nomRequete = $req_modifyAtt;
        // Write Log
        include 'traitWriteLog.php';
    }

    // DB's deconnection
    if (isset($connDB)) {
        unset($connDB);
    }
    
}

// Back to the attente.php
header('Location: ../attente.php');