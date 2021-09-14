<?php

// Création d'un CSV
// header('Content-Type: application/x-csv');
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename=fichier.txt');


// Call the DB
// connection's id
include 'connexion.php';
// Request to send
$reqFiche = "SELECT * FROM liste_patient WHERE pat_num = 1";
// Send the request and get the results
$resultatFiche = $connDB->query($reqFiche);
// Formatting the datas for analogy
$tabFiche = $resultatFiche->fetchAll(PDO::FETCH_ASSOC);
// DB's deconnection
if (isset($connDB)) {
    unset($connDB);
}


// Injection data
// Attention '\r\n'
foreach ($tabFiche as $cle => $valeur) {
    
    $data = "Fiche Patient n°".$valeur['pat_num']."\r\n";
    $data.= "nom du patient ".$valeur['pat_ident_nom'];
    echo $data;
}

// Go back to the planning
// header('Location: ../planning.php');