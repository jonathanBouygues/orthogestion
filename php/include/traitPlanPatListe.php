<?php

// include the regExp
include 'regexp.php';

// if write on url
if (!isset($_POST['recherche'])) {
    header('Location: ../../index.php');    
}


// CALL TO THE DB (LISTE PATIENT)
// Get the reward's word
if ($regExp->checkTxtStNu($_POST['recherche'])) {

    // Initialisation
    $rech = $_POST['recherche'];
    
    // Db's connection in PDO
    include 'connexion.php';
    
    // Request to send
    $requeteListe ="SELECT `pat_num`,`pat_ident_nom`,`pat_ident_prenom` FROM liste_patient WHERE pat_archive IS NULL AND (pat_ident_nom LIKE '%$rech%' OR pat_ident_prenom LIKE '%$rech%')";
    
    // Send the request and get the datas
    $resultatListe = $connDB->query($requeteListe);
    
    // Formating the datas for analogy
    $tabListe = $resultatListe->fetchAll(PDO::FETCH_ASSOC);
    
    // DB's deconnection
    if (isset($connDB)) {
    unset($connDB);
    }
    
    // Render data
    echo '<ul>';

    foreach($tabListe as $ligne) {
        echo '<li>'.$ligne['pat_ident_nom'].' '.$ligne['pat_ident_prenom'];
        echo '<span>'.$ligne['pat_num'].'</span>';
        echo '</li>';
    }
    echo '</ul>';

}