<?php

// include the regExp
include 'regexp.php';

// Check the datas
if (($_FILES['newFileDocument']['error'] == 0) && ($_FILES['newFileDocument']['size'] < 5000000 ) && (isset($_FILES['newFileDocument']))) {

    // initialisation
    // $nom = 'C:/wamp64/www/OrthoGestion/documentPatient/'.$_POST['newNomDocument'].'/'.$_FILES['newFileDocument']['name'];
    $nom = '../../documentPatient/'.$_POST['newNomDocument'].'/'.$_FILES['newFileDocument']['name'];
    $file = $_FILES['newFileDocument'];
    
    // Injection of the document
    if (!move_uploaded_file($file['tmp_name'],$nom)) {
        // echo 'nonok';
    } else {
        // request KO and insert in log file
        $nomRequete = $nom;
        // Write Log
        include 'traitWriteLog.php';
    }

}

// back to the index
header('Location: ../document.php');