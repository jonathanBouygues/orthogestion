<?php

// Start session
session_start();
// if write on url
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');    
}

// request KO and insert in log file
$time = time();
$message = "KO";
$synthese = $time.' - '.$message.' - '.$nomRequete;
// Write in file's log the error
// Target
$fichier = "../../log.txt";
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