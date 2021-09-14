<?php

// Session's check against the modification in URL
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
}

// DB's connection in PDO and regExp
include 'connexion.php';
include 'regexp.php';

//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// If action on button "nouveau", create a new request
if (isset($_POST['newDateContact'])) {
    
    // Check the datas by RegEXp  
    if (($regExp->checkDateNn($_POST['newDateContact'])) && ($regExp->checkTxtStNn($_POST['newPrenomEnfant'])) && ($regExp->checkIntegerNn($_POST['newAgeEnfant'])) && ($regExp->checkTxtStNn($_POST['newGenreEnfant'])) && ($regExp->checkTxtStNn($_POST['newNomParent'])) && ($regExp->checkTxtStNn($_POST['newPrenomParent'])) && ($regExp->checkTel($_POST['newNumTel'])) && ($regExp->checkMail($_POST['newMail'])) && ($regExp->checkTxtLgNn($_POST['newPlainte'])) && ($regExp->checkTxtLgNu($_POST['newLimiteHoraire'])) && ($regExp->checkTxtLgNu($_POST['newCommentaires']))) {
        
    $newDateContact = htmlspecialchars($_POST['newDateContact']);
    $newPrenomEnfant = htmlspecialchars($_POST['newPrenomEnfant']);
    $newAgeEnfant = htmlspecialchars($_POST['newAgeEnfant']);
    $newGenreEnfant = htmlspecialchars($_POST['newGenreEnfant']);
    $newNomParent = htmlspecialchars($_POST['newNomParent']);
    $newPrenomParent = htmlspecialchars($_POST['newPrenomParent']);
    $newNumTel = htmlspecialchars($_POST['newNumTel']);
    $newMail = htmlspecialchars($_POST['newMail']);
    $newPlainte = htmlspecialchars($_POST['newPlainte']);
    $newLimiteHoraire = htmlspecialchars($_POST['newLimiteHoraire']);
    $newCommentaires = htmlspecialchars($_POST['newCommentaires']);
    
    // Insert a new child
    $requete2 ="INSERT INTO `liste_attente`(`att_date_contact`, `att_prenom_enfant`, `att_age_enfant`, `att_genre_enfant`, `att_nom_parent`, `att_prenom_parent`, `att_num_tel`, `att_mail`, `att_plainte`, `att_cont_horaire`, `att_commentaire`) VALUES 
    (:dateContact,:prenomEnfant,:ageEnfant,:genreEnfant,:nomParent,:prenomParent,:numTel,:mail,:plainte,:limiteHoraire,:commentaires);";

    // Target to send
    $modele = $connDB->prepare($requete2);
    // Bind Value
    $modele->bindParam('dateContact', $newDateContact);
    $modele->bindParam('prenomEnfant', $newPrenomEnfant);
    $modele->bindParam('ageEnfant', $newAgeEnfant);
    $modele->bindParam('genreEnfant', $newGenreEnfant);
    $modele->bindParam('nomParent', $newNomParent);
    $modele->bindParam('prenomParent', $newPrenomParent);
    $modele->bindParam('numTel', $newNumTel);
    $modele->bindParam('mail', $newMail);
    $modele->bindParam('plainte', $newPlainte);
    $modele->bindParam('limiteHoraire', $newLimiteHoraire);
    $modele->bindParam('commentaires', $newCommentaires);
    // Send the request and check the result
    if ($modele->execute()) {
        // Request ok
    } else {
        // New KO and insert in log file
        $nomRequete = $requete2;
        // Write Log
        include 'traitWriteLog.php';
    }

    // Back to the attente.php
    header('Location: ../attente.php');

    }  
}



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// CALL TO THE DB (LISTE D'ATTENTE)

// Request to send
$requete ="SELECT * FROM liste_attente WHERE att_archive IS NULL ORDER BY `att_id` DESC";
// Send the request and get the datas
$resultat_att = $connDB->query($requete);
// Formate des données pour comparaison des données
$tab_att = $resultat_att->fetchAll(PDO::FETCH_ASSOC);
// DB's deconnection
if (isset($connDB)) {
    unset($connDB);
}


// DIV new client
echo '<div class="client">';
echo '<img id="newFileAttente" src="../images/new_attente.png" alt="nouveau liste attente">';
echo '</div>';

// Comparaison des données
foreach($tab_att as $ligne) {

    echo '<div class="client">';

    echo '<div class="clientDateContact"><h4>Date contact</h4><span>'.$ligne['att_date_contact'].'</span></div>';

    echo '<div class="clientBlocA">';
    echo '<span>'.ucfirst($ligne['att_prenom_enfant']).'</span>';
    echo '<span>('.$ligne['att_age_enfant'].' ans, '.$ligne['att_genre_enfant'].')</span>';
    echo '</div>';

    echo '<div class="clientBlocB"><h4>Plainte</h4>';
    echo '<span>'.mb_strtolower($ligne['att_plainte'],'utf8').'</span>';
    echo '</div>';

    echo '<div class="clientBlocC"><h4>Infos diverses</h4>';
    echo '<span>Parent : '.$ligne['att_nom_parent'].' '.$ligne['att_prenom_parent'].'</span>';
    echo '<span>Tél. : '.$ligne['att_num_tel'].'</span>';
    echo '<span>Mail : '.$ligne['att_mail'].'</span>';
    echo '<span>Contraintes horaires : '.mb_strtolower($ligne['att_cont_horaire'],'utf8').'</span>';
    echo '</div>';

    echo '<div class="clientBlocD"><h4>Commentaires</h4>';
    echo '<span>'.mb_strtolower($ligne['att_commentaire'],'utf8').'</span>';
    echo '</div>';
    
    echo '<div class="blocAction">';
    echo '<div class="blocControlModify"><h4>Modification</h4>';
    echo '<form id="formModifyAttente" action="include/traitAttMod.php" method="post">';
    echo '<input id="valueModifyAttenteId" type="hidden" name="valueModifyId" value="'.$ligne['att_id'].'">';
    echo '<select name="choixChamps">
        <option value="att_date_contact">Date de contact</option>
        <option value="att_prenom_enfant">Prénom</option>
        <option value="att_age_enfant">Age</option>
        <option value="att_genre_enfant">Genre</option>
        <option value="att_nom_parent">Nom parent</option>
        <option value="att_prenom_parent">Prénom parent</option>
        <option value="att_num_tel">Tél</option>
        <option value="att_mail">Mail</option>
        <option value="att_plainte">Plainte</option>
        <option value="att_cont_horaire">Contraintes horaires</option>
        <option value="att_commentaire">Commentaires</option>
        </select>';
    echo '<input id="valueModifyAttenteValeur" type="text" name="valueModifyAttente" value="">';
    echo '<input id="submitModify" type="submit" value="Modifier">';
    echo '<input class="returnModify" type="button" value="Retour">';
    echo '</form>';
    echo '</div>';
    echo '<img class="actionModify" src="../images/order.png" alt="action modification">';
    echo '<form id="formDeleteAttente" action="include/traitAttSupp.php" method="post"><input id="valueDeleteAttente" type="hidden" name="valueDeleteAttente" value="'.$ligne['att_id'].'"></form>';
    echo '<img class="actionSuppression" src="../images/delete.png" alt="action suppression">';
    echo '<div class="blocControlSupp"><span>Etes-vous sûr de vouloir supprimer cette fiche ?</span><span class="supprValide">Oui</span><span class="supprNonValide">Non</span></div>';
    echo '</div>';

    echo '</div>';
}
