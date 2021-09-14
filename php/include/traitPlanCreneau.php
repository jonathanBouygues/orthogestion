<?php

// include the regExp
include 'regexp.php';

// Creation of a time slot array
$creneau = [];

// Test if the datas have get
if ((isset($_POST['nouvCreneauId'])) && (isset($_POST['dureeCreneau'])) && (($regExp->checkIntegerNn($_POST['creneauNom'])) || ($_POST['creneauNom'] == ""))) {

    // variable's initialisation
    array_push($creneau,$_POST['nouvCreneauId']);
    $duree = htmlspecialchars($_POST['dureeCreneau']);
    $id = htmlspecialchars($_POST['creneauNom']); 

    // Loop for create if 1 or 2 times slots in more
    for ($i = 0 ; $i < $duree ; $i++) {
    
        // Nine o'clock issue
        if (strlen($creneau[$i]) == 18) {
            // 'sup à 10';
            $test = mb_substr($creneau[$i],13,2);
            $depart = 16;
            $departBeta = 13;
        } else if (strlen($creneau[$i]) == 17) {
            // 'creneau 9h';
            $test = mb_substr($creneau[$i],12,2);
            $depart = 15;
            $departBeta = 13;
        } else {
            $test = mb_substr($creneau[$i],11,2);
            $depart = 14;
            $departBeta = 12;
        }
        
        // Formatting add push in array $creneau
        $creneauBeta = mb_substr($creneau[$i],$depart,2);
        $creneauGeneriqueBeta = mb_substr($creneau[$i],0,$depart);
        $creneauBeta = $creneauBeta + 15;
        if ($creneauBeta == 60) {
            $creneauGeneriqueBeta = mb_substr($creneau[$i],0,$departBeta);
            $creneauGeneriqueHeure = mb_substr($creneau[$i],$departBeta,2);
            $var = 1;
            $creneauGeneriqueHeure = $creneauGeneriqueHeure + $var;
            $creneauBeta = $creneauGeneriqueBeta.$creneauGeneriqueHeure.':00';
            array_push($creneau,$creneauBeta);
        } else {
            $creneauBeta = $creneauGeneriqueBeta.$creneauBeta;
            array_push($creneau,$creneauBeta);
        }

    }


    // Call DB with identifiers
    include('connexion.php');
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
        if ($creneauStock['plan_id'] == $creneau[0]) {
            $alreadyStock = 1;
        }
    }


    // Case in time slot non-exist already 
    if ($alreadyStock == 0) {

        // Loop for integrate the news time slot
        foreach ($creneau as $ligne) {
            
            // Request to send
            $requeteNewCreneau = "INSERT INTO `planning_creneau` (`plan_id`,`plan_nom`) VALUES ('$ligne','$id')";
            // Send the request and check the result
            if ($connDB->exec($requeteNewCreneau)) {
                // request ok;
            } else {
                // request KO and insert in log file
                $nomRequete = $requeteNewCreneau;
                // Write Log
                include 'traitWriteLog.php';
            }

        }


        // Add a new meeting effected
        // Request to send
        $requeteListe = "SELECT `pat_num`,`pat_suivi_seanceNbreRealise`,`pat_archive` FROM liste_patient WHERE pat_archive IS NULL";
        // Send the request
        $resultatListe = $connDB->query($requeteListe);
        // Formatting and save the datas to compare
        $tabListe = $resultatListe->fetchAll(PDO::FETCH_ASSOC);

        // Comparison with a loop "foreach"
        foreach ($tabListe as $value) {
            // When it finds a patient with "$id"
            if ($id == $value['pat_num']) {

                // MAJ meetings effected
                $newNbre = $value['pat_suivi_seanceNbreRealise'];
                $newNbre = $newNbre + 1;
                // Create the request
                $requeteModSeanceEffectuee = "UPDATE `liste_patient` SET `pat_suivi_seanceNbreRealise` ='$newNbre' WHERE pat_num = '$id' AND pat_archive IS NULL";
                // Send the request and check the result
                if ($connDB->exec($requeteModSeanceEffectuee)) {
                    // request ok;
                } else {
                    // request KO and insert in log file
                    $nomRequete = $requeteModSeanceEffectuee;
                    // Write Log
                    include 'traitWriteLog.php';
                }

            }

        }

        // DB's deconnection
        if (isset($connDB)) {
            unset($connDB);
        }

    } else {
        // Do a delete request because it's possible to have on the array, one time slot already take and a another not take
        // A loop for use the array and delete/integrate the new time slot

        // Switch button for delete
        $delete = ($_POST['creneauNom'] == "") ? 1 : 0;

        foreach ($creneau as $ligne) {

            // Request to send
            $requete = "SELECT * FROM planning_creneau INNER JOIN liste_patient ON plan_nom = pat_num WHERE pat_archive IS NULL";
            // Send request
            $resultat = $connDB->query($requete);
            // Drilling to analogy of results
            $tabPresence = $resultat->fetchAll(PDO::FETCH_ASSOC);
            
            // Number of the OLD MEETING Liste_patient
            foreach($tabPresence as $value) {
                if ($value['plan_id'] == $ligne) {
                    $idPrevious = $value['plan_nom'];
                }
            }

            // OLD MEETTING - Planning_creneau 
            // Delete's request to send
            $requeteDelCreneau = "DELETE FROM `planning_creneau` WHERE plan_id ='$ligne'";            
            // Send the request and check the result
            if ($connDB->exec($requeteDelCreneau)) {
                // request ok;
            } else {
                // request KO and insert in log file
                $nomRequete = $requeteDelCreneau;
                // Write Log
                include 'traitWriteLog.php';
            } 
            
            // NEW MEETING - Planning_creneau
            // New's request to send
            $requeteNewCreneau = "INSERT INTO `planning_creneau` (`plan_id`,`plan_nom`) VALUES ('$ligne','$id')";
            // Send the request and check the result
            if ($connDB->exec($requeteNewCreneau)) {
                // request ok;
            } else {
                // request KO and insert in log file
                $nomRequete = $requeteNewCreneau;
                // Write Log
                include 'traitWriteLog.php';
            }
            
        }
        
        
        // OLD MEETING Liste_patient
        // Short the realize's number
        foreach($tabPresence as $value) {

            if ($value['plan_id'] == $ligne) {
                $seanceReal = $value['pat_suivi_seanceNbreRealise'];
            }
        }
        // New data
        $newReal = $seanceReal - 1;
        // Prepare the request
        $req_modify = "UPDATE `liste_patient` SET `pat_suivi_seanceNbreRealise` ='$newReal' WHERE pat_num = '$idPrevious' AND pat_archive IS NULL";
        // Send and check the result (send a boolean)
        if ($connDB->exec($req_modify)) {
            // request ok;
        } else {
            // request KO and insert in log file
            $nomRequete = $req_modify;
            // Write Log
            include 'traitWriteLog.php';
        }

        if ($delete == 0) {
            // NEW MEETING Liste_patient
            // add the realize's number
            foreach($tabPresence as $value) {
    
                if ($value['pat_num'] == $id) {
                    $seanceReal = $value['pat_suivi_seanceNbreRealise'];
                }
            }
            // New data
            $newReal = $seanceReal + 1;
            // Prepare the request
            $req_modify = "UPDATE `liste_patient` SET `pat_suivi_seanceNbreRealise` ='$newReal' WHERE pat_num = '$id' AND pat_archive IS NULL";
            // Send and check the result (send a boolean)
            if ($connDB->exec($req_modify)) {
                // request ok;
            } else {
                // request KO and insert in log file
                $nomRequete = $req_modify;
                // Write Log
                include 'traitWriteLog.php';
            }
        }

        // DB's deconnection
        if (isset($connDB)) {
            unset($connDB);
        }

    }

}

// Go back to the planning
header('Location: ../planning.php');