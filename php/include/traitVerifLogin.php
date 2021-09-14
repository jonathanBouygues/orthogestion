<?php

// Start the session
session_start();
// Initialisation 
$error = 1;
// include the regExp
include 'regexp.php';

// Get the datas with the method Post
if (($regExp->checkMail($_POST['idLogin'])) && (isset($_POST['mdpLogin']))) {

    if((filter_var($_POST['idLogin'], FILTER_VALIDATE_EMAIL))) {
        $idLogin = hash('sha256',trim($_POST['idLogin']));
    } else {
        // mail : bad format, so back to index
        header('Location: ../../index.php');
    }
    $mdpLogin = hash('sha256',trim($_POST['mdpLogin']));
    
    // connection's id
    include 'connexion.php';
    // Request to send
    $req_compte = "SELECT * FROM compte";
    // Send the request and get the results
    $resultat_compte = $connDB->query($req_compte);
    // Formatting the datas for analogy
    $tab_compte = $resultat_compte->fetchAll(PDO::FETCH_ASSOC);
    // DB's deconnection
    if (isset($connDB)) {
        unset($connDB);
    }
        
    // Data's analogy
    foreach($tab_compte as $ligne) {
    
        if ((hash_equals($idLogin, $ligne['compte_mail'])) && (hash_equals($mdpLogin, $ligne['compte_mdp']))) {
    
            $_SESSION['id'] = $ligne['compte_mail'];
            $_SESSION['mdp'] = $ligne['compte_mdp'];
            $_SESSION['prenom'] = $ligne['compte_prenom'];
            $_SESSION['startActivity'] = time();
            $error = 0;

            // If admin profil with ternary operator
            $_SESSION['admin'] = ($ligne['compte_id'] == 1) ? 1 : 0;

            // Back to the planning
            header('Location: ../planning.php');
        }
    }
    
} 


if ($error == 1) {

    // request KO and insert in log file the adress IP
    $time = time();
    $remoteAddr = $_SERVER['REMOTE_ADDR'];
    $remotePort = $_SERVER['REMOTE_PORT'];
    $message = "KO";
    $synthese = $time.' - statut : '.$message.' - Remote Addr : '.$remoteAddr.' - Remote Port : '.$remotePort;
    // Write in file's log the error
    // Target
    $fichier = "../../logIP.txt";
    // Test write
    if (is_writable($fichier)) {
        // open the file for write ('a' = write at the file's end)
        $pointeur = fopen($fichier, 'a');
        // Insert in the file
        fputs($pointeur, $synthese);
        fputs($pointeur, "\n");
        // Close the file
        fclose($pointeur);
    }
    
    // No isset, go back to index.php
    header('Location: ../../index.php');

}
