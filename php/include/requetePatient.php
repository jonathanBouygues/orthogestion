<?php

// Start session
session_start();
// if write on url
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');    
}

// DB's connection in PDO
include 'connexion.php';
// Request to send
$requete = "SELECT `pat_ident_nom`,`pat_ident_prenom` FROM liste_patient";
// Send the request and get the result
$resultatPat = $connDB->query($requete);
// Formating for analogy of the datas
$tabPat = $resultatPat->fetchAll(PDO::FETCH_ASSOC);
// Send in JSON format for read by the JS
echo json_encode($tabPat);
// DB's deconnection
if (isset($connDB)) {
    unset($connDB);
}