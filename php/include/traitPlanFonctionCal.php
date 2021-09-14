<?php

// Session's check against the modification in URL
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
}

//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// Création de tableau de référence
$tabMois = [
    '0' => ['mois' => 'Janvier','jour' => '31','numero' => '01'], 
    '1' => ['mois' => 'Fevrier','jour' => '29','numero' => '02'], 
    '2' => ['mois' => 'Mars','jour' => '31','numero' => '03'], 
    '3' => ['mois' => 'Avril','jour' => '30','numero' => '04'], 
    '4' => ['mois' => 'Mai','jour' => '31','numero' => '05'], 
    '5' => ['mois' => 'Juin','jour' => '30','numero' => '06'], 
    '6' => ['mois' => 'Juillet','jour' => '31','numero' => '07'], 
    '7' => ['mois' => 'Aout','jour' => '31','numero' => '08'], 
    '8' => ['mois' => 'Septembre','jour' => '30','numero' => '09'],
    '9' => ['mois' => 'Octobre','jour' => '31','numero' => '10'], 
    '10' => ['mois' => 'Novembre','jour' => '30','numero' => '11'], 
    '11' => ['mois' => 'Decembre','jour' => '31','numero' => '12' ]   
];

$tabJour = ['Lu','Ma','Me','Je','Ve','Sa','Di'];

$tabJourMulti = [
    '1' => ['jour' => 'Lundi','index' => '0'], 
    '2' => ['jour' => 'Mardi','index' => '1'], 
    '3' => ['jour' => 'Mercredi','index' => '2'], 
    '4' => ['jour' => 'Jeudi','index' => '3'], 
    '5' => ['jour' => 'Vendredi','index' => '4'], 
    '6' => ['jour' => 'Samedi','index' => '5'], 
    '7' => ['jour' => 'Dimanche','index' => '6']  
];

// Test leap year
$test = date("L", time());
$testBeta = strftime('%Y', time());
$testBeta = date("L",mktime(0,0,0,1,1,$testBeta+1));
// If test OK, we set the data
if (($testBeta == 1 ) || ($test == 1)) {
    $tabMois['1']['jour'] = '28';
}

// Fonction pour la création du mini-calendrier
function creaCalendrier($dateCal,$tabMois,$tabJour,$tabJourMulti) {

    // Création tableau des mois/année + boucle pour 5 mois suivants)
    $mois[0] = strftime('%m', $dateCal)-5;
    $annee[0] = strftime('%Y', $dateCal);

    // Génération d'une date antérieure de 6 mois pour gestion des +/- 6 mois en affichage
    if ($mois[0] <1) {
        $mois[0] = $mois[0]+12;
        $annee[0] = $annee[0]-1;
    }

    // Génération des 11 mois suivants
    for ($i = 1; $i <= 11; $i++) {
        $annee[$i] = $annee[0];
        $mois[$i] = $mois[0]+$i;
    }

    // Gestion de la fin d'année pour les 5 mois suivants + création mktime
    for ($i = 0; $i <= 11; $i++) {

        if ($i == 0) {
            // Création mktime pour gestion des 12 mois
            $maDate[$i] = mktime(0,0,0,$mois[$i],1,$annee[$i]);
        } else {
            if ($mois[$i] > 12) {
                $mois[$i] = $mois[$i]-12;
                $annee[$i] = $annee[$i]+1;
            } if ($mois[$i] < 0) {
                $mois[$i] = $mois[$i]+12;
                $annee[$i] = $annee[$i]-1;
            }
            // Création mktime pour gestion des 12 mois
            $maDate[$i] = mktime(0,0,0,$mois[$i],1,$annee[$i]);
        }
    }

    // Boucle for pour générer tout l'affichage dans la classe planning des 11 mois
    for ($i = 0; $i <= 11; $i++) {

        // Création de la zone 'nom du mois'
        $moisTemp = $mois[$i]-1;
        $jourTemp = $tabMois[$moisTemp]['jour'];
        echo '<div class="mois"><h2 class="nomMois">'.$tabMois[$moisTemp]['mois'].' '.$annee[$i].'</h2>
        <div class="plan '.$tabMois[$moisTemp]['numero'].'/'.$annee[$i].'">';

        // Boucle For pour création des Div Lundi-Dimanche
        for ($j = 0; $j <= 6; $j++) {
            echo ('<div class=\'jourTexte\'>'.$tabJour[$j].'</div>');  
        }

        // Identification du jour de départ + correction du dimanche
        $jourDepartMois = strftime('%w', $maDate[$i]);
        // Correction du Dimanche
        if ($jourDepartMois == 0) {
            $jourDepartMois = 7;
        }

        // Création du mois
        $jourDepartNum = ($tabJourMulti[$jourDepartMois]['index']);

        // Création des Jours OFF (départ décalé en semaine)
        for ($j = 0; $j <  $jourDepartNum; $j++) {
            echo ('<div class=\'jourOff\'></div>');  
        }
        // Création des Jours ON (valide)
        for ($j = 1; $j <= $jourTemp; $j++) {
            echo ('<div class=\'jour\'>'.$j.'</div>'); 
        }

        echo '</div></div>';
    }
}



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// Identifiers for the connnection to the DB (passed in arguments in the functions)
include 'connexion.php';



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// Fonction pour la creation du planning
function creaPlanning($uneDate,$tabMois,$tabJourMulti,$connDB) {

    // Test si c'est du time() ou date choisie
    $regexp = '[/]';

    // Correction selon la RegExp
    if (preg_match('#'.$regexp.'#', $uneDate)) {
        $laDate = $uneDate;
    } else {
        // Conservation jour d'aujourd'hui
        $jourDep = strftime('%d', $uneDate);
        $moisDep = strftime('%m', $uneDate);
        $anneeDep = strftime('%Y', $uneDate);
        $laDate = $jourDep.'/'.$moisDep.'/'.$anneeDep;
    }

    // Récupération de la date
    $jourDep = mb_substr($laDate, 0, 2, 'utf8');
    $moisDep = mb_substr($laDate, 3, 2, 'utf8');
    $anneeDep = mb_substr($laDate, 6, 4, 'utf8');

    
    
    $maDate = mktime(0,0,0,$moisDep,$jourDep,$anneeDep);
    setlocale(LC_TIME, 'french');
    
    // Création variables pour tableau (mois/année) et du jour de départ
    $mois[0] = strftime('%m', $maDate);
    $annee[0] = strftime('%Y', $maDate);
    $jourTxtDep = strftime('%w', $maDate);
    
    // Correction du Dimanche
    if ($jourTxtDep == 0) {
        $jourTxtDep = 7;
    }
    
    // Création zone 'mois', 'mois précédent' et 'mois suivant'
    $moisTemp = $mois[0]-1;
    $moisPrecedent = $moisTemp-1;
    $moisSuivant = $moisTemp + 1;
    
    // Départ du planning au Lundi
    $jourTxtDebSemaine = $tabJourMulti[1]['jour'];
    
    // Déduction du début de semaine 
    switch ($jourTxtDep) {
        case 1;
        $jourDebSemaine = $jourDep;
        break;
        case 2;
        $jourDebSemaine = $jourDep-1;
        break;
        case 3;
        $jourDebSemaine = $jourDep-2;
        break;
        case 4;
        $jourDebSemaine = $jourDep-3;
        break;
        case 5;
        $jourDebSemaine = $jourDep-4;
        break;
        case 6;
        $jourDebSemaine = $jourDep-5;
        break;
        case 7;
        $jourDebSemaine = $jourDep-6;
        break;
    }

    // Création du mois-1 
    $moisPrecedent = $moisTemp-1;

    // Modif variable si semaine à cheval sur mois précédent
    $debutMoisPrecedent = 0;
    if ($jourDebSemaine <= 0) {
        $debutMoisPrecedent = 1;
        $jourDebSemaine = $tabMois[$moisPrecedent]['jour']+$jourDebSemaine;
    }

    // Request to send    
    $requete ="SELECT * FROM planning_creneau INNER JOIN liste_patient ON plan_nom = pat_num";
    // Envoi de la requête et récupération des résultats
    $resultat_plan = $connDB->query($requete);
    // Formatage des données pour comparaison des données
    $tab_plan = $resultat_plan->fetchAll(PDO::FETCH_ASSOC);
    // Request to send    
    $requeteAntePost ="SELECT * FROM planning_creneau";
    // Envoi de la requête et récupération des résultats
    $resultatAntePost = $connDB->query($requeteAntePost);
    // Formatage des données pour comparaison des données
    $tabAntePost = $resultatAntePost->fetchAll(PDO::FETCH_ASSOC);
    // Déconnexion de la DB => annuler car appel à la DB plus bas sur une autre fonction
    if (isset($connDB)) {
        unset($connDB);
    }

    // Boucle For pour création de la Div en-tête + span "creneau"
    $jourDebSemaineBeta = $jourDebSemaine;
    $jourDebSemaineOrigine = $jourDebSemaine;
    echo '<div class=blocEntetePlan>';
    echo '<span>Creneau</span>';

    for ($j = 1; $j <= 7; $j++) {

        if ($j >=6) {
            echo ('<span class="jourWE">'.$tabJourMulti[$j]['jour']);
        } else {
            echo ('<span class="jour">'.$tabJourMulti[$j]['jour']);    
        }

        // Condition si semaine à cheval sur mois précédent
        if ($debutMoisPrecedent == 1) {
            if ($jourDebSemaine > $tabMois[$moisPrecedent]['jour']) {
                $jourDebSemaineBeta = $jourDebSemaine - $tabMois[$moisPrecedent]['jour'];
                echo ' '.$jourDebSemaineBeta.' '.$tabMois[$moisTemp]['mois'].'</span>';
            } else {
                echo ' '.$jourDebSemaine.' '.$tabMois[$moisPrecedent]['mois'].'</span>';
            }
        // Condition si semaine sur mois ou mois+1
        } else {
            if ($jourDebSemaine > $tabMois[$moisTemp]['jour']) {
                $jourDebSemaineBeta = $jourDebSemaine - $tabMois[$moisTemp]['jour'];
                echo ' '.$jourDebSemaineBeta.' '.$tabMois[$moisSuivant]['mois'].'</span>';
            } else {
                echo ' '.$jourDebSemaine.' '.$tabMois[$moisTemp]['mois'].'</span>';
            }
        }
        $jourDebSemaine ++;
    }

    echo '</div>';
    $jourDebSemaine = $jourDebSemaineOrigine;
    
    // Création de la div des créneaux horaires
    echo '<div class="blocCreneauHoraire">';
    echo '<span class="heureExt">Avant 9h</span>';
    for ($i = 9; $i<21; $i++) {
        // Création des 1/4 d'heures

        $tabQuartHeure = ['00','15','30','45'];

        foreach ($tabQuartHeure as $value) {

            echo'<span>'.$i.':'.$value.'</span>';

        }
    }
    echo '<span class="heureExt">Après 9h</span>';
    echo '</div>';


    // Boucle For pour création des Div Lundi-Dimanche
    for ($j = 1; $j <= 7; $j++) {

        if ($j >=6) {
            echo ('<div class=\'jourWE\'>');
        } else {
            echo ('<div class=\'jour\'>');                   
        }

        // Condition si semaine à cheval sur mois précédent
        if ($debutMoisPrecedent == 1) {
            if ($jourDebSemaine > $tabMois[$moisPrecedent]['jour']) {
                $jourDebSemaineBeta = $jourDebSemaine - $tabMois[$moisPrecedent]['jour'];
            } 
        // Condition si semaine sur mois ou mois+1
        } else {
            if ($jourDebSemaine > $tabMois[$moisTemp]['jour']) {
                $jourDebSemaineBeta = $jourDebSemaine - $tabMois[$moisTemp]['jour'];
            } 
        }


        // DIV pour noter avant des  RDV avant la journée
        // Condition si semaine à cheval sur mois précédent
        if ($debutMoisPrecedent == 1) {
            if ($jourDebSemaine > $tabMois[$moisPrecedent]['jour']) {
                $test = $annee[0].'/'.$tabMois[$moisTemp]['numero'].'/'.$jourDebSemaineBeta.' - 8:45';
            } else {
                $test = $annee[0].'/'.$tabMois[$moisPrecedent]['numero'].'/'.$jourDebSemaine.' - 8:45';
            }
            // Condition si semaine sur mois ou mois+1
        } else {
            if ($jourDebSemaine > $tabMois[$moisTemp]['jour']) {
                // echo 'mois+1';
                $test = $annee[0].'/'.$tabMois[$moisSuivant]['numero'].'/'.$jourDebSemaineBeta.' - 8:
                45';
            } else {
                // echo 'mois actuel';
                $test = $annee[0].'/'.$tabMois[$moisTemp]['numero'].'/'.$jourDebSemaine.' - 8:45';
            }
        }
        
        echo '<div class="heureExt '.$test.'">';
        echo '<div class="identitePatientBeta">';
        foreach($tabAntePost as $ligne) {
            if ($test == $ligne['plan_id']) {
                echo '<span>'.$ligne['plan_comment'].'</span>';
            }
        }

        echo '</div></div>';



        // DIV pour appel des RDV 
        // Comparison variable
        $patientPrecedent = "";

        // Create hours
        for ($i = 9; $i<21; $i++) {

            // Create quarters of an hour
            $tabQuartHeure = ['00','15','30','45'];

            foreach ($tabQuartHeure as $value) {

                // Condition si semaine à cheval sur mois précédent
                if ($debutMoisPrecedent == 1) {
                    if ($jourDebSemaine > $tabMois[$moisPrecedent]['jour']) {
                        $test = $annee[0].'/'.$tabMois[$moisTemp]['numero'].'/'.$jourDebSemaineBeta.' - '.$i.':'.$value;
                    } else {
                        $test = $annee[0].'/'.$tabMois[$moisPrecedent]['numero'].'/'.$jourDebSemaine.' - '.$i.':'.$value;
                    }
                // Condition si semaine sur mois ou mois+1
                } else {
                    if ($jourDebSemaine > $tabMois[$moisTemp]['jour']) {
                        // echo 'mois+1';
                        $test = $annee[0].'/'.$tabMois[$moisSuivant]['numero'].'/'.$jourDebSemaineBeta.' - '.$i.':'.$value;
                    } else {
                        // echo 'mois actuel';
                        $test = $annee[0].'/'.$tabMois[$moisTemp]['numero'].'/'.$jourDebSemaine.' - '.$i.':'.$value;
                    }
                }
                
                // Test of time slot (presence)
                // Error variable
                $erreur = 0;
                // comparison loops 
                foreach($tab_plan as $ligne) {
                    if ($test == $ligne['plan_id']) {
                        if ($patientPrecedent == $ligne['plan_nom']) {
                            echo '<div class="heureTop '.$test.'">';
                        } else {
                            echo '<div class="heureBot '.$test.'">';
                            echo '<div class="identitePatient">';
                            echo '<span class="nomPatient">';
                            echo $ligne['pat_ident_nom'].'</span><span class="prenomPatient">'.$ligne['pat_ident_prenom'];
                            echo '</span></div>';
                            if (is_null($ligne['plan_cancel'])) {
                                echo '<img class="interrupteurPresence" src="../images/switchOn.png" alt="interrupteur présence">';
                            } else {
                                echo '<img class="interrupteurPresence" src="../images/switchOff.png" alt="interrupteur présence">';
                            }
                        }
                        // 
                        $erreur = 1;
                        $patientPrecedent = $ligne['plan_nom'];
                    } 
                }

                if ($erreur == 0) {
                    echo '<div class="heureGen '.$test.'">';
                    echo '<div class="identitePatient"></div>'; 
                }

                // Fermeture des div quarts d'heure
                echo '</div>';

            }
        
        }
    
    $jourDebSemaine ++;



    // DIV pour noter avant des RDV after la journée
    $testBeta = mb_substr($test, 0, 10, 'utf8');
    $testBeta = trim($testBeta).' - 21:00';
    echo '<div class="heureExt '.$testBeta.'">';
    echo '<div class="identitePatientBeta">';

    foreach($tabAntePost as $ligne) {

        if ($testBeta == $ligne['plan_id']) {
            
            echo '<span>'.$ligne['plan_comment'].'</span>';
            
        }
    }
    echo '</div></div>';


    // Fermeture de la DIV Jour
    echo '</div>';

    }
}



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// Fonction for the creation of the interaction
function creaInteraction($dateAuj,$tabMois,$tabJourMulti,$connDB) {

    // Test si c'est du time() ou date choisie
    $regexp = '[/]';

    // Correction selon la RegExp
    if (preg_match('#'.$regexp.'#', $dateAuj)) {
        $laDate = $dateAuj;
    } else {
        setlocale(LC_TIME, 'french');
        // Conservation jour d'aujourd'hui
        $jourDep = trim(strftime('%e', $dateAuj));
        $moisDep = strftime('%m', $dateAuj);
        $anneeDep = strftime('%Y', $dateAuj);
        $heureDep = (int)strftime('%H', $dateAuj);
        $minuteDep = strftime('%M',$dateAuj);
    }

    //Arrondi des minutes pour connaitre le 1-/4 d'heure de départ
    if ($minuteDep < 15) {
        $minuteDep = 0;
    } else if (($minuteDep >= 15) && ($minuteDep < 30)) {
        $minuteDep = 15;
    } else if (($minuteDep >= 30) && ($minuteDep < 45)) {
        $minuteDep = 30;
    } else {
        $minuteDep = 45;
    }

    // Création d'un tableau pour fournir les 3 creneaux
    // Initialisation
    $tab_creneau = [];  
    // Horaire actuel
    $minuteDep = str_pad($minuteDep, 2, '0', STR_PAD_LEFT);
    $horaireActuel = $anneeDep.'/'.$moisDep.'/'.$jourDep.' - '.$heureDep.':'.$minuteDep;
    array_push($tab_creneau,$horaireActuel);

    // Horaire précédent
    if ($minuteDep - 15 < 0) {
        $minutePrec = 45;
        $heurePrec = $heureDep - 1;
    } else {
        $heurePrec = $heureDep;
        $minutePrec = $minuteDep - 15;
    }
    $minutePrec = str_pad($minutePrec, 2, '0', STR_PAD_LEFT);
    $horairePrec = $anneeDep.'/'.$moisDep.'/'.$jourDep.' - '.$heurePrec.':'.$minutePrec;
    array_unshift($tab_creneau,$horairePrec);
    // Horaire suivant
    if ($minuteDep +15 > 46) {
        $minuteSuiv = 00;
        $heureSuiv = $heureDep + 1;
    } else {
        $heureSuiv = $heureDep;
        $minuteSuiv = $minuteDep + 15;
    }
    $minuteSuiv = str_pad($minuteSuiv, 2, '0', STR_PAD_LEFT);
    $heureSuiv = str_pad($heureSuiv, 2, '0', STR_PAD_LEFT);
    $horaireSuiv = $anneeDep.'/'.$moisDep.'/'.$jourDep.' - '.$heureSuiv.':'.$minuteSuiv;
    array_push($tab_creneau,$horaireSuiv);

    // Appel à la DB
    // Connexion à la DB en PDO => pas de connexion à la DB car déjà fait sur une autre fonction plus haut (passez en argument)
    // préparation de la requete
    $requeteCreneau ="SELECT * FROM planning_creneau INNER JOIN liste_patient ON plan_nom = pat_num INNER JOIN nomen_acte ON pat_presc_AMOActe = nomen_acte_id";
    // Envoi de la requête et récupération des résultats
    $resultatCreneau = $connDB->query($requeteCreneau);
    // Formatage des données pour comparaison des données
    $tabCreneauDB = $resultatCreneau->fetchAll(PDO::FETCH_ASSOC);
    // Déconnexion de la DB
    if (isset($connDB)) {
    unset($connDB);
    }

    // Variable compteur
    $cmp = 0;

    // Création des divs patient (préc, actuel et suivant)
    foreach($tab_creneau as $ligne) {

        if ($cmp == 0) {
            echo '<div class="patientPrecedent">';
            echo '<h4>RDV précédent : '.mb_substr($ligne,13,5).'</h4>';
        } else if ($cmp == 1) {
            echo '<div class="patientActuel">';
            echo '<h4>RDV actuel : '.mb_substr($ligne,13,5).'</h4>';
        } else {
            echo '<div class="patientSuivant">';
            echo '<h4>RDV suivant : '.mb_substr($ligne,13,5).'</h4>';
        }


        foreach($tabCreneauDB as $ligneDB) {

            if ($ligne == $ligneDB['plan_id']) {
                
                // Variables
                $seanceRest = $ligneDB['pat_suivi_seanceNbre'] - $ligneDB['pat_suivi_seanceNbreRealise'];
                $tauxAbsent = ($ligneDB['pat_suivi_seanceNbreAnnulation'] /
                $ligneDB['pat_suivi_seanceNbre']) * 100;

                echo '<span>';
                echo $ligneDB['pat_ident_nom'].' '.$ligneDB['pat_ident_prenom'];
                echo '</span>';
                echo '<span> Taux d\'absence : '.$tauxAbsent.'%</span>';

                if ($cmp == 1) {

                    // Render data
                    echo '<span> Classe : '.$ligneDB['pat_ident_classe'].'</span>';
                    echo '<span> AMO Acte : '.$ligneDB['pat_presc_AMOActe'].'</span>';
                    echo '<span> Type d\'acte : '.$ligneDB['nomen_acte_desActe'].'</span>';
                    echo '<span> Nbre séances restantes : '.$seanceRest.'</span>';
                };

            } 
        }

        echo '</div>';
        $cmp++;

    }

}



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// Function to integrate the ToDoList
function creaTodolist($connDB) {

    // Request to send
    $requete ="SELECT * FROM todolist";
    // Send the request and get the datas
    $resultat = $connDB->query($requete);
    // Use a fetchAll 
     $tabResultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
    // DB's deconnection
    if (isset($connDB)) {
    unset($connDB);
    }

    // Creation of the works
    foreach($tabResultat as $ligne) {
        echo '<div>';
        echo $ligne['tdl_taches'];
        echo '<img class="itemDelete" src="../images/close.png" alt="delete item">';
        echo '</div>';
    }

}




//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// Function to integrate the patient with a absence's rate > 30%
function importAbsent($connDB) {

    // Request to send
    $requeteAbsent ="SELECT `pat_num`,`pat_ident_nom`,`pat_ident_prenom`,`pat_suivi_seanceNbre`,`pat_suivi_seanceNbreAnnulation` FROM liste_patient WHERE pat_archive IS NULL AND ((pat_suivi_seanceNbreAnnulation / pat_suivi_seanceNbre) *100) >= 30";
    // Send the request and get the datas
    $resultatAbsent = $connDB->query($requeteAbsent);
    // Use a fetchAll 
     $tabAbsent = $resultatAbsent->fetchAll(PDO::FETCH_ASSOC);
    // DB's deconnection
    if (isset($connDB)) {
    unset($connDB);
    }


    // Render datas
    echo '<table><thead>';
    echo '<tr>';
    echo '<th>Nom</th><th>Prénom</th><th>Taux d\'absence</th>';
    echo '</tr></thead>';
    echo '<tbody>';

    // Creation of the works
    foreach($tabAbsent as $ligne) {

        // Generate the absence's rate
        $tauxAbs = ($ligne['pat_suivi_seanceNbreAnnulation'] / $ligne['pat_suivi_seanceNbre']) * 100;

        // Render datas on loop
        echo '<tr>';
        echo '<td>'.$ligne['pat_ident_nom'].'</td>';
        echo '<td>'.$ligne['pat_ident_prenom'].'</td>';
        echo '<td>'.$tauxAbs.' %</td>';
        echo '</tr>';
    }

    // End of the table
    echo '</tbody></table>';

}