<?php

// Session's check
include('include/traitSession.php');

?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-num="2">Ortho'gestion - Patient</title>
    <meta name="description" content="horloge">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon shortcut" href="../images/logo.png">
    <script src="../js/regexp.js" defer></script>
    <script src="../js/dynaPatient.js" defer></script>
</head>

<body>

    <?php
        include 'include/header.php';
    ?>

    <main id="containerPatient">

        <section class="patientPartieHaute">

            <form id="formListe" action="" method="post">

                <input type="text" name="patientNom" placeholder="taper un prénom" value="" autocomplete="off">
                <div id="autocomp"></div>

                <input id="patientID" type="hidden" name="patientID" value="">

            </form>

            <h2 data-num="2">Patient</h2>

            <button class="newPatient" value="Nouveau patient">Nouveau</button>

        </section>

        <section class="patientPartieBasse">

            <?php include('include/traitPatAppelDB.php');?>

            <div class="blocModPatient">

                <h2>Modification</h2>

                <form id="formModPatient" action="include/traitPatMod.php" method="post">
                    <input id="nomModPatient" type="hidden" name="nomModPatient" value="">
                    <select id="selectChamps" name="choixChamps">
                        <option value="pat_ident_nom">Identité : nom</option>
                        <option value="pat_ident_prenom">Identité : prénom</option>
                        <option value="pat_ident_dateNais">Identité : date de naissance</option>
                        <option value="pat_ident_classe">Identité : classe</option>
                        <option value="pat_ident_etab">Identité : etablissement</option>
                        <option value="pat_ident_prof">Identité : professeur</option>
                        <option value="pat_ident_fratrie">Identité : fratrie</option>
                        <option value="pat_ident_jobParent">Identité : Travail des parents</option>
                        <option value="pat_assure_nom">Assuré : nom de l'assuré</option>
                        <option value="pat_assure_prenom">Assuré : prénom de l'assuré</option>
                        <option value="pat_assure_adresse">Assuré : adresse de l'assuré</option>
                        <option value="pat_assure_tel">Assuré : téléphone</option>
                        <option value="pat_assure_mail">Assuré : email</option>
                        <option value="pat_assure_caisseSS">Assuré : caisse Sécurité Sociale</option>
                        <option value="pat_assure_numSS">Assuré : numéro Sécurité Sociale</option>
                        <option value="pat_assure_situation">Assuré : situation</option>
                        <option value="pat_assure_contHor">Assuré : contraintes horaires</option>
                        <option value="pat_assure_commentaires">Assuré : commentaires</option>
                        <option value="pat_presc_nomMedPresc">Prescription : nom Médecin prescripteur</option>
                        <option value="pat_presc_nomMedTrait">Prescription : nom Médecin traitement</option>
                        <option value="pat_presc_AMOBilan">Prescription : AMO Bilan</option>
                        <option value="pat_presc_AMOActe">Prescription : AMO Acte</option>
                        <option value="pat_presc_dateOrdoInit">Prescription : date ordonnance initiale</option>                    
                        <option value="pat_presc_dateDAP1">Prescription : date DAP n°1</option>                    <option value="pat_presc_dateDAP2">Prescription : date DAP n°2</option>
                        <option value="pat_presc_dateOrdoAct">Prescription : date ordonnance actuelle</option>                    
                        <option value="pat_presc_dateActDAP1">Prescription : date DAP actuelle n°1</option>
                        <option value="pat_presc_dateActDAP2">Prescription : date DAP actuelle n°2</option>
                        <option value="pat_suivi_seanceNbre">Suivi : nombre de séances totales</option>
                        <option value="pat_suivi_seanceDuree">Suivi : durée des séances</option>
                        <option value="pat_suivi_seanceFreq">Suivi : fréquence des séances</option>
                        <option value="pat_suivi_seanceNbreRealise">Suivi : nombre de séances réalisées</option>
                        <option value="pat_suivi_seanceNbreFact">Suivi : nombre de séances facturées</option>
                        <option value="pat_suivi_seanceNbreAnnulation">Suivi : nombre de séances annulées</option>
                    </select>
                    <input id="itemModPatient" type="text" name="itemModPatient">
                    <select class="itemModPatientMed" name="modMed">
                        <option value="0"></option>
                    </select>
                    <select class="itemModPatientEtab" name="modEtab">
                        <option value="0"></option>
                    </select>
                    <select class="itemModPatientBilan" name="modBilan">
                        <option value="0"></option>
                    </select>
                    <select class="itemModPatientActe" name="modActe">
                        <option value="0"></option>
                    </select>          
                    <input type="submit" value="Envoyez">
                    <input class="buttonModReturn" type="button" value="Retour">
                </form>
            </div>

            <div class="blocDelPatient">

                <span>Merci de confirmer la suppression de ce patient</span>
                <button class="buttonConfirm">Confirmer</button>
                <button class="buttonDelReturn">Retour</button>

                <form id="formDelPatient" action="include/traitPatDel.php" method="post">
                    <input id="nomDeletePatient" type="hidden" name="nomDeletePatient" value="">
                </form>

            </div>

        </section>

        <section class="blocNewPatient">

            <h2>Nouveau patient</h2>

            <div class="formNewContainer">

                <form id="formNewPatient" action="include/traitPatNew.php" method="post">
                
                    <span>(*) champs obligatoires</span>
                    
                    <table>
                        <caption>Identité</caption>
                        <tbody>
                            <tr>
                                <td>Nom (*)</td>
                                <td><input type="text" name="identNom" placeholder="caractères max 30" maxlength="30"></td>
                                <td>Prénom (*)</td>
                                <td><input type="text" name="identPrenom" placeholder="caractères max 30" maxlength="30"></td>
                            </tr>
                            <tr>
                                <td>Date de naissance (*)</td>
                                <td><input type="date" name="identDate"></td>
                                <td>Classe</td>
                                <td><input type="text" name="identClasse"></td>
                            </tr>
                            <tr>
                                <td>Etablissement</td>
                                <td>
                                    <select class="inputEtab" name="identEtab">
                                    </select>
                                </td>
                                <td>Nom Professeur</td>
                                <td><input type="text" name="identProf" placeholder="caractères max 30" maxlength="30"></td>
                            </tr>
                            <tr>    
                                <td>Fratrie</td>
                                <td><textarea type="text" name="identFratrie" maxlength="255" placeholder="caractères max 255"></textarea></td>
                                <td>Travail des parents</td>
                                <td><textarea type="text" name="identJob" maxlength="255" placeholder="caractères max 255"></textarea></td>
                            </tr>
                        </tbody>
                    </table>


                    <table>
                        <caption>Assuré</caption>
                        <tbody>
                            <tr>
                                <td>Nom (*)</td>
                                <td><input type="text" name="assureNom" placeholder="caractères max 30" maxlength="30"></td>
                                <td>Prénom (*)</td>
                                <td><input type="text" name="assurePrenom" placeholder="caractères max 30" maxlength="30"></td>
                            </tr>
                            <tr>
                                <td>Adresse</td>
                                <td><input type="text" name="assureAdresse"></td>
                                <td>Téléphone (*)</td>
                                <td><input type="text" name="assureTel" placeholder="ex : 06-65-65-65-65"></td>
                            </tr>
                            <tr>
                                <td>Mail</td>
                                <td><input type="email" name="assureMail" placeholder="exemple@gmail.com"></td>
                                <td>Situation</td>
                                <td><input type="text" name="assureSituation"></td>
                            </tr>
                            <tr>    
                                <td>Caisse Sécurité Sociale (*)</td>
                                <td><input type="text" name="assureCaisseSS"></td>
                                <td>Numéro Sécu (*)</td>
                                <td><input type="text" name="assureNumSS" placeholder="ex : 2 02 02 02 123 123 22"></td>
                            </tr>
                            <tr>    
                                <td>Contraintes horaires</td>
                                <td><textarea type="text" name="assureContHor" maxlength="255" placeholder="caractères max 255"></textarea></td>
                                <td>Commentaires</td>
                                <td><textarea type="text" name="assureComment" maxlength="255" placeholder="caractères max 255"></textarea></td>
                            </tr>
                            </tbody>
                    </table>
                    
                    <table>
                        <caption>Prescription</caption>
                        <tbody>
                            <tr>
                                <td>Médecin prescripteur (*)</td>
                                <td>
                                    <select class="inputMedPresc" name="prescMedPresc">
                                    </select>
                                </td>
                                <td>Médecin traitant (*)</td>
                                <td>
                                    <select class="inputMedTrait" name="prescMedTrait">
                                    </select>    
                                </td>
                            </tr>
                            <tr>
                                <td>Type du Bilan (*)</td>
                                <td><select class="typeBilan" name="prescTypeBilan"></select></td>
                                <td>Type d'Acte (*)</td>
                                <td><select class="typeActe" name="prescTypeActe"></select></td>
                            </tr>
                            <tr>    
                                <td>Date Ordo initiale (*)</td>
                                <td><input type="date" name="prescDateOrdoInit"></td>
                                <td>Date DAP 1 (*)</td>
                                <td><input type="date" name="prescDateDAP1"></td>
                                <td>Date DAP 2 (*)</td>
                                <td><input type="date" name="prescDateDAP2"></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <table>
                        <caption>Suivi</caption>
                        <tbody>
                            <tr>
                                <td>Nombre de séances (*)</td>
                                <td><input type="number" name="suiviNbreSeance"></td>
                                <td>Durée de la séance (*)</td>
                                <td><input type="number" name="suiviDureeSeance"></td>
                                <td>Fréquence des séances (*)</td>
                                <td><input type="number" name="suiviFreqSeance"></td>
                            </tr>
                        </tbody>
                    </table>

                    <input type="submit" id="submitNewPatient" value="Enregistrer">
                
                </form>
            </div>

            <div class="erreurNewPatient">
            </div>

        </section>

    </main>
    
</body>

</html>