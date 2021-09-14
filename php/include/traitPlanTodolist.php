<?php 

// include the regExp
include 'regexp.php';

// Before the injection, check by RegExp
if ($regExp->checkTxtStNn($_POST['newItem'])) {
     
    // DB's connection
    // connection's id
    include 'connexion.php';
    // Initilaiisation
    $newItem = htmlspecialchars($_POST['newItem']);
    // Request to send
    $requete = "SELECT `tdl_taches` FROM todolist";
    // Send request
    $resultat = $connDB->query($requete);
    // Drilling to analogy of results
    $tabTdl = $resultat->fetchAll(PDO::FETCH_ASSOC);

    // Presence's test
    // Interruptor button
    $presence = 0;
    // Loop of array $tabTdl
    foreach ($tabTdl as $value) {
        
        if ($newItem == $value['tdl_taches']) {
            $presence = 1;
        } 

    }


    // Condition if : one, it's deleted and zero, it's inserted
    if ($presence == 1) {
        // Delete's request to send
        $requeteDelTdl = "DELETE FROM `todolist` WHERE tdl_taches = :nomItem";
        // Target to send
        $modele = $connDB->prepare($requeteDelTdl);
        // Bind Value
        $modele->bindParam('nomItem', $newItem);
        // Send the request and check the result
        if ($modele->execute()) {
            // request ok;
        } else {
            // request KO and insert in log file
            $nomRequete = $requeteDelTdl;
            // Write Log
            include 'traitWriteLog.php';
        }
    } else {        
        // New's request to send
        $requeteNewTdl = "INSERT INTO `todolist` (`tdl_taches`) VALUES (:nomItem)";
        // Target to send
        $modele = $connDB->prepare($requeteNewTdl);
        // Bind Value
        $modele->bindParam('nomItem', $newItem);
        // Send the request and check the result (send a boolean)
        if ($modele->execute()) {
            // request ok;
        } else {
            // request KO and insert in log file
            $nomRequete = $requeteNewTdl;
            // Write Log
            include 'traitWriteLog.php';
        }
    }

    // DB's cut off
    if ($connDB) {
        unset($connDB);
    }
    
}

// Back to the planning
header('Location: ../planning.php');