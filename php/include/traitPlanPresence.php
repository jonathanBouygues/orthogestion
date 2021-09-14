<?php

// Creation of a time slot array
$creneau = [];

// get the patient's id
if (isset($_POST['idTimeSlotPresence'])) {
    array_push($creneau,$_POST['idTimeSlotPresence']);
}

// connection's id
include 'connexion.php';

// Request to send
$requete = "SELECT * FROM planning_creneau INNER JOIN liste_patient ON plan_nom = pat_num WHERE pat_archive IS NULL";
// Send request
$resultat = $connDB->query($requete);
// Drilling to analogy of results
$tabPresence = $resultat->fetchAll(PDO::FETCH_ASSOC);

// Analogy with a Foreach loops
foreach ($tabPresence as $value) {

    if ($value['plan_id'] == $creneau[0]) {
        $id = $value['pat_num'];
        $seancePresc = $value['pat_suivi_seanceNbre'];
        $seanceReal = $value['pat_suivi_seanceNbreRealise'];
        $seanceAnnul = $value['pat_suivi_seanceNbreAnnulation'];
        $newAnnul = $seanceAnnul + 1;
        $newReal = $seanceReal - 1;
        $newTauxAbsent = (($newAnnul/$seancePresc) * 100).' %';

        // Modify the number's cancelled and lake'rate
        // Request to send
        $req_modifyAbsent = "UPDATE `liste_patient` SET `pat_suivi_seanceNbreRealise` ='$newReal', `pat_suivi_seanceNbreAnnulation` ='$newAnnul' WHERE pat_num = '$id' AND pat_archive IS NULL";
        // Send and check the result (send a boolean)
        if ($connDB->exec($req_modifyAbsent)) {
            // request ok;
        } else {
            // request KO and insert in log file
            $nomRequete = $req_modifyAbsent;
            // Write Log
            include 'traitWriteLog.php';
        }

        // Loop for create if [1-8] times slots in more
        for ($i = 0 ; $i < 7 ; $i++) {
            
            // Nine o'clock issue
            $test = mb_substr($creneau[$i],13,2);
            if ($test >= 10) {
                // 'sup à 10';
                $depart = 16;
                $departBeta = 13;
            } else {
                // 'creneau 9h';
                $depart = 15;
                $departBeta = 13;
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

        foreach ($creneau as $ligne) {

            // Modify the presence's button for the planning's view 
            // Request to send
            $req_modifyCreneau = "UPDATE `planning_creneau` SET `plan_cancel` = 'cancel' WHERE plan_id = '$ligne' AND plan_nom = '$id'";
            // Send and check the result (send a boolean)
            if ($connDB->exec($req_modifyCreneau)) {
                // request ok;
            } 

        }

        // DB's deconnection
        if (isset($connDB)) {
            unset($connDB);
        }

    }
}

// If there is no data, redirection on planning.php
header('Location: ../planning.php');