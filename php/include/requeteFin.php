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
$requete = "SELECT `fin_id`,`fin_nom`,`fin_date`,`fin_montant` FROM finance WHERE fin_archive IS NULL ORDER BY `fin_date` ASC";
// Send the request and get the result
$resultatFin = $connDB->query($requete);
// Formating for analogy of the datas
$tabFin = $resultatFin->fetchAll(PDO::FETCH_ASSOC);
// Send in JSON format for read by the JS
// And add a new arguement "JSON Invalid" for UT8 problem
echo json_encode($tabFin,JSON_INVALID_UTF8_IGNORE);
// DB's deconnection
if (isset($connDB)) {
    unset($connDB);
}