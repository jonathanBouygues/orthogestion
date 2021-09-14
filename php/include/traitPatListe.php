<?php

// if write on url 
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');    
}

// include the regExp
include 'regexp.php';

// APPEL DE LA DB (LISTE PATIENT)

// Récupération du mot recherché
if ($regExp->checkTxtStNn($_POST['recherche'])) {

    // Initialisation
    $rech = htmlspecialchars($_POST['recherche']);
    
    // Connexion à la DB en PDO
    include 'connexion.php';
    
    // préparation de la requete
    $requeteListe ="SELECT `pat_num`,`pat_ident_nom`,`pat_ident_prenom` FROM liste_patient WHERE pat_archive IS NULL AND (pat_ident_nom LIKE '%$rech%' OR pat_ident_prenom LIKE '%$rech%')";
    
    // Envoi de la requête et récupération des résultats
    $resultatListe = $connDB->query($requeteListe);
    
    // Formatage des données pour comparaison des données
    $tabListe = $resultatListe->fetchAll(PDO::FETCH_ASSOC);
    
    // Déconnexion de la DB
    if (isset($connDB)) {
    unset($connDB);
    }
    
    echo '<ul>';

    foreach($tabListe as $ligne) {
        echo '<li>'.$ligne['pat_ident_nom'].' '.$ligne['pat_ident_prenom'];
        echo '<span>'.$ligne['pat_num'].'</span>';
        echo '</li>';
    }
        
    echo '</ul>';

} else {
    echo 'aucun résultat';
}
