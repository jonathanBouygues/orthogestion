<?php

// include the regExp
include 'regexp.php';

// If check RegEXp is OK, we send the form
if (($regExp->checkTxtStNn($_POST['demandeNom'])) && ($regExp->checkTxtLgNn($_POST['demandeMessage'])) && (($regExp->checkTel($_POST['demandeTel'])) || ($regExp->checkMail($_POST['demandeMail'])))) {
    
    // connection's id
    include 'connexion.php';
    // Create var and quote's problem
    $demandeNom = htmlspecialchars($_POST['demandeNom']);
    $demandeMail = htmlspecialchars($_POST['demandeMail']);
    $demandeTel = htmlspecialchars($_POST['demandeTel']);
    $demandeMessage = htmlspecialchars($_POST['demandeMessage']);
    // Request to send
    $req_demande = "INSERT INTO `demande_compte`(`dem_nom`, `dem_mail`, `dem_tel`, `dem_message`) VALUES (:demandeNom, :demandeMail, :demandeTel, :demandeMessage)";
    // Target to send 
    $modele = $connDB->prepare($req_demande);
    // Bind Value
    $modele->bindParam('demandeNom', $demandeNom);
    $modele->bindParam('demandeMail', $demandeMail);
    $modele->bindParam('demandeTel', $demandeTel);
    $modele->bindParam('demandeMessage', $demandeMessage);

    // Send the request and check the result
    if ($modele->execute()) {
        // request ok;
    } else {
        // modifiable request
        $nomRequete = $req_demande;
        // Write Log
        include 'traitWriteLog.php';
    }

    // DB's deconnection
    if (isset($connDB)) {
        unset($connDB);
    }
        
    // Back by mail to confirm the contact
    if (!$demandeMail == "") {

        // infos de PHP ini pour vérif
        // phpinfo();
    
        // Initialisation
        $objet = "Demande de contact";
        $destinataire = $demandeMail;   
        // Message
        $message= "<table style='border-radius:15px; border: 3px solid #6247c2; text-align:center; padding:20px; font-family:roboto; background-color:#ecf3e5'>";
        $message.= "<tr>";
        $message.= "<td><img src='https://jonathan-bouygues.com/images/logo.png' alt='logo-ortho-gestion' style='width:50px'></td>";
        $message.= "</tr>";
        $message.= "<tr>";
        $message.= "<td><h1 style='font-size:25px; color:#90c9e0;margin:10px'>Votre demande a bien été reçue</h1></td>";
        $message.= "</tr>";
        $message.= "<tr>";
        $message.= "<td><p style='font-size:15px; color:#90c9e0; margin:10px'>Nous allons étudier votre demande et nous vous recontacterons dans les plus brefs délais.</p></td>";
        $message.= "</tr>";
        $message.= "<tr>";
        $message.= "<td><p style='font-size:15px; color:#90c9e0; margin:10px'>A bientôt !</br> L'équipe Ortho'Gestion</p></td>";
        $message.= "</tr>";
        $message.= "<tr>";
        $message.= "<td><p style='margin:10px; font-size:10px; color:#90c9e0'>&copy; Ortho'Gestion 2020</p></td>";
        $message.= "</tr></table>";
        // HEADER
        $header = 'MIME-version:1.0'."\r\n";
        $header.= 'Content-type: text/html;charset=utf-8'."\r\n";
        $header.= 'From: "Contact Ortho-Gestion" <contact@jonathan-bouygues.com>'."\r\n";
        
        // Envoi de l'email
        if (mail($destinataire, $objet, $message,$header)) {
            // echo "Email correctement envoyé";
        } else {
            // echo "Problème d'envoi";
        }
    }
}

// back to the index
header('Location: ../../index.php');