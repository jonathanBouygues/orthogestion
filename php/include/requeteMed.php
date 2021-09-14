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
$requete = "SELECT `med_nom`,`med_id` FROM medecin";
// Send the request and get the result
$resultatMed = $connDB->query($requete);
// Formating for analogy of the datas
$tabMed = $resultatMed->fetchAll(PDO::FETCH_ASSOC);
// Send in JSON format for read by the JS
echo json_encode($tabMed);
// DB's deconnection
if (isset($connDB)) {
    unset($connDB);
}