<?php

// include the regExp
include 'regexp.php';

// Test if the datas have get
if ((isset($_POST['nouvCreneauIdBeta'])) && ($regExp->checkTxtStNn($_POST['creneauComment']))) {
    
    // Call DB with identifiers
    include('connexion.php');
    // variable's initialisation
    $creneau = htmlspecialchars($_POST['nouvCreneauIdBeta']);
    $comment = htmlspecialchars($_POST['creneauComment']);
    // Request to send
    $requeteCreneauStock = "SELECT `plan_id` FROM planning_creneau";
    // Send the request 
    $envoiRequeteCreneauStock = $connDB->query($requeteCreneauStock);
    // Save in array
    $tabCreneauStock = $envoiRequeteCreneauStock->fetchAll(PDO::FETCH_ASSOC);


    // Issue of time slot already exists
    // Interrupto button
    $alreadyStock = 0;
    // Loop for knows if time slot exists
    foreach ($tabCreneauStock as $creneauStock) {
        if ($creneauStock['plan_id'] == $creneau) {
            $alreadyStock = 1;
        }
    }


    // Case in time slot non-exist already 
    if ($alreadyStock == 0) {
        // Request to send
        $requeteNewCreneau = "INSERT INTO `planning_creneau` (`plan_id`,`plan_comment`) VALUES ('$creneau','$comment')";
        // Send the request and check the result
        if ($connDB->exec($requeteNewCreneau)) {
            // request ok;
        } else {
            // request KO and insert in log file
            $nomRequete = $requeteNewCreneau;
            // Write Log
            include 'traitWriteLog.php';
        }

        // DB's deconnection
        if (isset($connDB)) {
            unset($connDB);
        }

    } else {

        // Do a delete request because it's possible to have on the array, one time slot already take and a another not take
        // Delete's request to send
        $requeteDelCreneau = "DELETE FROM `planning_creneau` WHERE plan_id ='$creneau'";            
        // Send the request and check the result
        if ($connDB->exec($requeteDelCreneau)) {
            // request ok;
        } else {
            // request KO and insert in log file
            $nomRequete = $requeteDelCreneau;
            // Write Log
            include 'traitWriteLog.php';
        }

        // New's request to send
        $requeteNewCreneau = "INSERT INTO `planning_creneau` (`plan_id`,`plan_comment`) VALUES ('$creneau','$comment')";
        // Send the request and check the result
        if ($connDB->exec($requeteNewCreneau)) {
            // request ok;
        } else {
            // request KO and insert in log file
            $nomRequete = $requeteNewCreneau;
            // Write Log
            include 'traitWriteLog.php';
        }

        // DB's deconnection
        if (isset($connDB)) {
            unset($connDB);
        }

    }

}

// Go back to the planning
header('Location: ../planning.php');