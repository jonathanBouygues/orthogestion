<?php

// include the regExp
include 'regexp.php';

// Check the datas by RegExp
if ( ($regExp->checkTxtStNn($_POST['identNom'])) && ($regExp->checkTxtStNn($_POST['identPrenom'])) && ($regExp->checkDateNu($_POST['identDate'])) && ($regExp->checkTxtStNu($_POST['identClasse'])) && ($regExp->checkIntegerNn($_POST['identEtab'])) && ($regExp->checkTxtStNu($_POST['identProf'])) && ($regExp->checkTxtLgNu($_POST['identFratrie'])) && ($regExp->checkTxtLgNu($_POST['identJob'])) && ($regExp->checkTxtStNn($_POST['assureNom'])) && ($regExp->checkTxtStNn($_POST['assurePrenom'])) && ($regExp->checkTxtStNu($_POST['assureAdresse'])) && ($regExp->checkTel($_POST['assureTel'])) && ($regExp->checkMail($_POST['assureMail'])) && ($regExp->checkTxtStNu($_POST['assureSituation'])) && ($regExp->checkTxtStNn($_POST['assureCaisseSS'])) && ($regExp->checkTxtStNn($_POST['assureNumSS'])) && ($regExp->checkTxtLgNu($_POST['assureContHor'])) && ($regExp->checkTxtLgNu($_POST['assureComment'])) && ($regExp->checkIntegerNn($_POST['prescMedPresc'])) && ($regExp->checkIntegerNn($_POST['prescMedTrait'])) && ($regExp->checkIntegerNn($_POST['prescTypeBilan'])) && ($regExp->checkIntegerNn($_POST['prescTypeActe'])) && ($regExp->checkDateNn($_POST['prescDateOrdoInit'])) && ($regExp->checkDateNn($_POST['prescDateDAP1'])) && ($regExp->checkDateNn($_POST['prescDateDAP2'])) && ($regExp->checkIntegerNn($_POST['suiviNbreSeance'])) && ($regExp->checkIntegerNn($_POST['suiviDureeSeance'])) && ($regExp->checkIntegerNn($_POST['suiviFreqSeance']))  ) {
         
        // connection's id
        include 'connexion.php';
        // Initialisation
        $identNom = htmlspecialchars($_POST['identNom']);
        $identPrenom =  htmlspecialchars($_POST['identPrenom']);
        $identBirthdate = htmlspecialchars($_POST['identDate']);
        $identClasse = htmlspecialchars($_POST['identClasse']);
        $identEtab = htmlspecialchars($_POST['identEtab']);
        $identProf = htmlspecialchars($_POST['identProf']);
        $identFratrie = htmlspecialchars($_POST['identFratrie']);
        $identJob = htmlspecialchars($_POST['identJob']);

        $assureNom = htmlspecialchars($_POST['assureNom']);
        $assurePrenom = htmlspecialchars($_POST['assurePrenom']);
        $assureAdresse = htmlspecialchars($_POST['assureAdresse']);
        $assureTel = htmlspecialchars($_POST['assureTel']);
        $assureMail = htmlspecialchars($_POST['assureMail']);
        $assureSituation = htmlspecialchars($_POST['assureSituation']);
        $assureCaisseSS = htmlspecialchars($_POST['assureCaisseSS']);
        $assureNumSS = htmlspecialchars($_POST['assureNumSS']);
        $assureContHor = htmlspecialchars($_POST['assureContHor']);
        $assureComment = htmlspecialchars($_POST['assureComment']);

        $prescMedPresc = $_POST['prescMedPresc'];
        $prescMedTrait = $_POST['prescMedTrait'];
        $prescTypeBilan = $_POST['prescTypeBilan'];
        $prescTypeActe = $_POST['prescTypeActe'];
        $prescDateOrdoInit = $_POST['prescDateOrdoInit'];
        $prescDateDAP1 = $_POST['prescDateDAP1'];
        $prescDateDAP2 = $_POST['prescDateDAP2'];

        $suiviNbreSeance = $_POST['suiviNbreSeance'];
        $suiviDureeSeance = $_POST['suiviDureeSeance'];
        $suiviFreqSeance = $_POST['suiviFreqSeance'];
        
        // Request to send
        $requete ="INSERT INTO liste_patient(pat_ident_nom, pat_ident_prenom, pat_ident_dateNais, pat_ident_classe, pat_ident_etab, pat_ident_prof, pat_ident_fratrie, pat_ident_jobParent, pat_assure_nom, pat_assure_prenom, pat_assure_adresse, pat_assure_tel, pat_assure_mail, pat_assure_caisseSS, pat_assure_numSS, pat_assure_situation, pat_assure_contHor, pat_assure_commentaires, pat_presc_nomMedPresc, pat_presc_nomMedTrait, pat_presc_AMOBilan, pat_presc_AMOActe, pat_presc_dateOrdoInit, pat_presc_dateDAP1, pat_presc_dateDAP2, pat_presc_dateOrdoAct, pat_presc_dateActDAP1, pat_presc_dateActDAP2, pat_suivi_seanceNbre, pat_suivi_seanceDuree, pat_suivi_seanceFreq,pat_suivi_seanceNbreRealise, pat_suivi_seanceNbreFact,pat_suivi_seanceNbreAnnulation, pat_archive) VALUES (:identNom,:identPrenom,:identBirthdate,:identClasse,:identEtab,:identProf,:identFratrie,:identJob,:assureNom,:assurePrenom,:assureAdresse,:assureTel,:assureMail,:assureCaisseSS,:assureNumSS,:assureSituation,:assureContHor,:assureComment,:prescMedPresc,:prescMedTrait,:prescTypeBilan,:prescTypeActe,:prescDateOrdoInit,:prescDateDAP1,:prescDateDAP2,NULL,NULL,NULL,:suiviNbreSeance,:suiviDureeSeance,:suiviFreqSeance,NULL,NULL,NULL,NULL);";
        
        // Target to send
        $modele = $connDB->prepare($requete);
        // Bind Value
        $modele->bindParam('identNom', $identNom);
        $modele->bindParam('identPrenom', $identPrenom);
        $modele->bindParam('identBirthdate', $identBirthdate);
        $modele->bindParam('identClasse', $identClasse);
        $modele->bindParam('identEtab', $identEtab);
        $modele->bindParam('identProf', $identProf);
        $modele->bindParam('identFratrie', $identFratrie);
        $modele->bindParam('identJob', $identJob);
        $modele->bindParam('assureNom', $assureNom);
        $modele->bindParam('assurePrenom', $assurePrenom);
        $modele->bindParam('assureAdresse', $assureAdresse);
        $modele->bindParam('assureTel', $assureTel);
        $modele->bindParam('assureMail', $assureMail);
        $modele->bindParam('assureCaisseSS', $assureCaisseSS);
        $modele->bindParam('assureNumSS', $assureNumSS);
        $modele->bindParam('assureSituation', $assureSituation);
        $modele->bindParam('assureContHor', $assureContHor);
        $modele->bindParam('assureComment', $assureComment);
        $modele->bindParam('prescMedPresc', $prescMedPresc);
        $modele->bindParam('prescMedTrait', $prescMedTrait);
        $modele->bindParam('prescTypeBilan', $prescTypeBilan);
        $modele->bindParam('prescTypeActe', $prescTypeActe);
        $modele->bindParam('prescDateOrdoInit', $prescDateOrdoInit);
        $modele->bindParam('prescDateDAP1', $prescDateDAP1);
        $modele->bindParam('prescDateDAP2', $prescDateDAP2);
        $modele->bindParam('suiviNbreSeance', $suiviNbreSeance);
        $modele->bindParam('suiviDureeSeance', $suiviDureeSeance);
        $modele->bindParam('suiviFreqSeance', $suiviFreqSeance);


        // Send the request and check the result
        if ($modele->execute()) {
                // request ok;
                // Create a new directory to file
                mkdir('../../documentPatient/'.$identNom.' '.$identPrenom);
        } else {
                // request KO and insert in log file
                $nomRequete = $requete;
                // Write Log
                include 'traitWriteLog.php';
        }

}

// Back to planning.php
header('Location: ../patient.php');