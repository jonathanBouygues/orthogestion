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
$requete = "SELECT `nomen_acte_id`,`nomen_acte_desActe` FROM nomen_acte";
// Send the request and get the result
$resultatActe = $connDB->query($requete);
// Formating for analogy of the datas
$tabActe = $resultatActe->fetchAll(PDO::FETCH_ASSOC);
// Send in JSON format for read by the JS
// And add a new arguement "JSON Invalid" for UTF-8 problem
echo json_encode($tabActe,JSON_INVALID_UTF8_IGNORE);
// DB's deconnection
if (isset($connDB)) {
    unset($connDB);
}