<?php

// if write on url
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');    
}

// APPEL DE LA DB (LISTE PATIENT)

// Get the id
if (isset($_POST['patientID'])) {
    if ($_POST['patientID'] == "choisir patient") {
        $patientID = 1;
    } else {
        $patientID = $_POST['patientID'];
    }
} else {
    $patientID = 1;
}



// DB's connection in PDO
include 'connexion.php';
// Request to send
$requete ="SELECT * FROM liste_patient INNER JOIN medecin ON pat_presc_nomMedPresc = med_id INNER JOIN etablissement ON pat_ident_etab = etab_id INNER JOIN nomen_bilan ON nomen_bilan_id = pat_presc_AMOBilan INNER JOIN nomen_acte ON nomen_acte_id = pat_presc_AMOActe WHERE pat_num = '$patientID' AND pat_archive IS NULL";
// Send the request and get the datas
$resultat_att = $connDB->query($requete);
// Formatting of the datas for analogy
$tab_att = $resultat_att->fetchAll(PDO::FETCH_ASSOC);



// Function to traitor doctor
function medecinTrait($num, $connDB) {
        
    // Request to send
    $requeteMed ="SELECT * FROM medecin WHERE med_id = $num";
    // Send the request and get the datas
    $resultatMed = $connDB->query($requeteMed);
    // Formatting of the datas for render
    $tabMed = $resultatMed->fetchAll(PDO::FETCH_ASSOC);

    // Render of traitor doctor
    foreach($tabMed as $ligne) {

        echo '<div>Médecin traitant : '.$ligne['med_nom'].' '.$ligne['med_prenom'];
        echo '<img id="infoMedecinTrait" src="../images/plus.png" alt="infos medecin"></div>';
        echo '<div class="blocMedTrait">';
        echo '<span>Spécialité : '.$ligne['med_spec'].'</span>';
        echo '<span>N° identification : '.$ligne['med_numAdeli'].'</span>';
        echo '<span>Adresse : '.$ligne['med_adresse'].'</span>';
        echo '<span>Mail : '.$ligne['med_mail'].'</span>';
        echo '<span>Téléphone : '.$ligne['med_telDirect'].'</span>';
        echo '<span>Téléphone secretariat : '.$ligne['med_telSecret'].'</span>';
        echo '<span>Commentaires : '.$ligne['med_commentaires'].'</span>'; 
        echo '</div>';
        
    }

}



// Data's analogy
foreach($tab_att as $ligne) {

    // Manipulation of the year and the month of birthdate
    $anneeActuelle = strftime('%Y',time());
    $naissance = $ligne['pat_ident_dateNais'];
    $anneeNaissance = mb_substr($naissance, 0, 4);
    $moisNaissance = mb_substr($naissance,5,2);
    $jourNaissance = mb_substr($naissance,8,2); 
    $deltaAnneeNaissance = $anneeActuelle - $anneeNaissance;
    $timestampDepart = mktime(0, 0, 0, $moisNaissance, $jourNaissance, $anneeNaissance);
    $timeActuelle = time();
    $deltaMoisNaissance = ($timeActuelle - $timestampDepart) / 2629800;
    $deltaMoisNaissance = round($deltaMoisNaissance);

    // Initialisation of variable to view
    $seanceNbre = $ligne['pat_suivi_seanceNbre'];
    $seanceReal = $ligne['pat_suivi_seanceNbreRealise'];
    $seanceAnnulation = $ligne['pat_suivi_seanceNbreAnnulation'];
    $seanceRestante = $seanceNbre - $seanceReal;
    $tauxAbsence = ($seanceAnnulation / $seanceNbre) * 100;


    // Render of datas

    // DIV En-tete
    echo '<div class="patientEntete">';
    echo '<div class="identiteEnfant"><span name="'.$ligne['pat_num'].'">'.$ligne['pat_ident_prenom'].' '.$ligne['pat_ident_nom'].'</span>';
    echo '<img id="modifyPatient" src="../images/order.png" alt="modifier patient">';
    echo '<img id="deletePatient" src="../images/delete.png" alt="supprimer patient">';
    echo '<img id="printPatient" src="../images/print.png" alt="print patient">';
    echo '</div>';
    echo '<div class="tauxAbsent">Taux d\'absentéisme : '.$tauxAbsence.'%</div>';
    echo '</div>';

 
    
    // DIV Corps fichier
    echo '<div class="patientCorpsFichier">';

    // Render of the nav
    echo '<nav><ul>';
    echo '<li class="actionSuivi actif">Suivi</li><li class="actionIdentite">Identité</li><li class="actionAssure">Assuré</li><li class="actionPrescription">Prescription</li>';
    echo '</ul></nav>';
    
    // Render of the bloc prescription   
    echo '<div class="blocPrescription">';
    // Bloc Prescription Medecin
    echo '<div class=blocPrescriptionMedecin><h4>Médecin</h4>';
    // Prescriptor doctor
    echo '<div>Médecin prescripteur : '.$ligne['med_nom'].' '.$ligne['med_prenom'];
    echo '<img id="infoMedecin" src="../images/plus.png" alt="infos medecin"></div>';
    echo '<div class="blocMedPresc">';
    echo '<span>Spécialité : '.$ligne['med_spec'].'</span>';
    echo '<span>N° identification : '.$ligne['med_numAdeli'].'</span>';
    echo '<span>Adresse : '.$ligne['med_adresse'].'</span>';
    echo '<span>Mail : '.$ligne['med_mail'].'</span>';
    echo '<span>Téléphone : '.$ligne['med_telDirect'].'</span>';
    echo '<span>Téléphone secretariat : '.$ligne['med_telSecret'].'</span>';
    echo '<span>Commentaires : '.$ligne['med_commentaires'].'</span>';
    echo '</div>';
    // Traitor doctor
    medecinTrait($ligne['pat_presc_nomMedTrait'],$connDB);
    // AMO Bilan/Act
    echo '<span>AMO Bilan : '.$ligne['nomen_bilan_coeff'].'</span>';
    echo '<span>Type de bilan : '.$ligne['nomen_bilan_desActe'].'</span>';
    echo '<span>AMO Acte : '.$ligne['nomen_acte_coeff'].'</span>';
    echo '<span>Type d\'acte : '.$ligne['nomen_acte_desActe'].'</span>';
    echo '</div>';
    // Bloc Prescription Ordonnance
    echo '<div class=blocPrescriptionOrdonnance><h4>Ordonnance</h4>';
    echo '<table><thead><tr>';
    echo '<th class="transp"></th><th>Ordonnance initiale</th><th>Ordonnance actuelle</th><thead>';
    echo '<tbody><tr>';
    echo '<td>Date</td><td>'.$ligne['pat_presc_dateOrdoInit'].'</td><td>'.$ligne['pat_presc_dateOrdoAct'].'</td></tr>';
    echo '<tr><td>DAP 1</td><td>'.$ligne['pat_presc_dateDAP1'].'</td><td>'.$ligne['pat_presc_dateActDAP1'].'</td></tr>';
    echo '<tr><td>DAP 2</td><td>'.$ligne['pat_presc_dateDAP2'].'</td><td>'.$ligne['pat_presc_dateActDAP2'].'</td></tr>';
    echo '</tbody></table></div>';
    echo '</div>';
    
    // Render of bloc assure
    echo '<div class="blocAssure">';
    echo '<div class=blocAssureInfos><h4>Infos générales</h4>';
    echo '<span>Assuré : '.$ligne['pat_assure_nom'].' '.$ligne['pat_assure_prenom'].'</span>';
    echo '<span>Adresse : '.$ligne['pat_assure_adresse'].'</span>';
    echo '<span>Téléphone : '.$ligne['pat_assure_tel'].'</span>';
    echo '<span>E-Mail : '.$ligne['pat_assure_mail'].'</span>';
    echo '<span>Contraintes horaires : '.$ligne['pat_assure_contHor'].'</span>';
    echo '<span>Commentaires : '.$ligne['pat_assure_commentaires'].'</span>';
    echo '</div>';
    echo '<div class=blocAssureAdmin><h4>Données Administratives</h4>';
    echo '<span>Caisse Sécurité Sociale : '.$ligne['pat_assure_caisseSS'].'</span>';
    echo '<span>N° SS : '.$ligne['pat_assure_numSS'].'</span>';echo '<span>Situation : '.$ligne['pat_assure_situation'].'</span>';
    echo '</div>';
    echo '</div>';

    // Render of bloc identite
    echo '<div class="blocIdentite">';
    echo '<div class=blocIdentitePatient><h4>Patient</h4>';
    echo '<span>Date de Naissance : '.$ligne['pat_ident_dateNais'].'</span>';
    echo '<span>Date de Naissance : '.$deltaAnneeNaissance.' ans (ou '.$deltaMoisNaissance.' mois)</span>';
    echo '<span>Profession des parents : '.$ligne['pat_ident_jobParent'].'</span>';
    echo '<span>Fratrie : '.$ligne['pat_ident_fratrie'].'</span>';
    echo '</div>';
    echo '<div class=blocIdentiteScolarite><h4>Scolarité</h4>';
    echo '<span>Classe : '.$ligne['pat_ident_classe'].'</span>';
    echo '<div>Etablissement : '.$ligne['etab_nom'];
    echo '<img id="infoEtablissement" src="../images/plus.png" alt="infos établissement"></div>';
    echo '<span>Professeur : '.$ligne['pat_ident_prof'].'</span>';
    // Mini-bloc Etablissement
    echo '<div class="blocIdentEtab">';
    echo '<span>Nom  : '.$ligne['etab_nom'].' ('.$ligne['etab_type'].','.$ligne['etab_ville'].')</span>';
    echo '<span>Nom directeur : '.$ligne['etab_nomDir'].'</span>';
    echo '<span>Téléphone : '.$ligne['etab_num'].'</span>';
    echo '<span>Adresse : '.$ligne['etab_adresse'].'</span>';
    echo '<span>Mail : '.$ligne['etab_mail'].'</span>';
    echo '<span>Horaires : '.$ligne['etab_horaires'].'</span>';
    echo '<span>Commentaires : '.$ligne['etab_commentaire'].'</span>';
    echo '</div>';
    // Close the big bloc
    echo '</div>';
    echo '</div>';

    // Render of bloc suivi
    echo '<div class="blocSuivi"><h4>Prestation</h4>';
    echo '<span>Durée de la séance : '.$ligne['pat_suivi_seanceDuree'].'</span>';
    echo '<span>Fréquence des séances : '.$ligne['pat_suivi_seanceFreq'].'/semaine</span>';
    echo '<table><caption>Nombre de séances</caption>';
    echo '<thead><tr>';
    echo '<th>totales</th><th>réalisées</th><th>restantes</th><th>facturées</th><th>annulées</th>';
    echo '</tr></thead>';
    echo '<tbody><tr>';
    echo '<td>'.$ligne['pat_suivi_seanceNbre'].'</td><td>'.$ligne['pat_suivi_seanceNbreRealise'].'</td><td>'.$seanceRestante.'</td><td>'.$ligne['pat_suivi_seanceNbreFact'].'</td><td>'.$ligne['pat_suivi_seanceNbreAnnulation'].'</td>';
    echo '</tr></tbody></table>';
    echo '</div>';

    // Render end
    echo '</div>';
}


// DB's deconnection
if (isset($connDB)) {
unset($connDB);
}