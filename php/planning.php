<?php
    
// Session's check
include('include/traitSession.php');

// Vérification d'une modification de date
if (isset($_POST['maDate'])) {
    $uneDate = $_POST['maDate'];
} else {
    $uneDate = time();
}

// include this file to render the datas (with functions)
include('include/traitPlanFonctionCal.php');

// Set the timezone
date_default_timezone_set('Europe/Paris');

?>
<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title data-num="1">Ortho'gestion - Planning</title>
        <meta name="description" content="horloge">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon shortcut" href="../images/logo.png">
        <script src="../js/regexp.js" defer></script>
        <script src="../js/dyna.js" defer></script>
    </head>
  
    <body> 
        
        <!-- Intégration header.php -->
        <?php include 'include/header.php';?>

        <main id="containerIndex">

            <section class="planning">
    
                <div class="hautIndex">
                    
                    <img id="moisPrecedent" src="../images/left-arrow.png" alt="moisPrecedent">
                
                    <h2 data-num="1">Planning</h2>
                    
                    <img id="activeCalendrier" src="../images/calendar.png" alt="calendrier">
                    
                    <img id="moisSuivant" src="../images/right-arrow.png" alt="moisSuivant">
  
                    <div id="injectionCodeCal">
                        <div id="gestionCarroussel">
                            <?php creaCalendrier($dateCal = time(),$tabMois,$tabJour,$tabJourMulti); ?>
                        </div>
                    </div>
    
                    <form id="formDonnee" action="planning.php" method="post">
                        <input id="dateJour" type="text" name="maDate" placeholder="date" value="">
                    </form>   
                
                </div>
    
                <div class="semaine">
                    <?php creaPlanning($uneDate,$tabMois,$tabJourMulti,$connDB); ?>
                </div>

                <div class="blocNouvRdv">

                    <h4>Nouveau RDV</h4>

                    <img id="backNewMeeting" src="../images/close.png" alt="retour">

                    <form id="creneauInjection" action="include/traitPlanCreneau.php" method="post">
                        <input type="text" name="nouvCreneauId" value="" readonly="true">
                        <div class="callAutoComp">
                            <input type="text" placeholder="taper un nom" name="nouvCreneauNom" autocomplete="off">
                            <div id="autocompBeta"></div>
                        </div>
                        
                        <div class=inputRadio>
                            <span>Durée de la séance</span>
                            <select name="dureeCreneau">
                                <option value="1">30m</option>
                                <option value="2">45m</option>
                                <option value="3">1h</option>
                                <option value="4">1h15m</option>
                                <option value="5">1h30m</option>
                                <option value="6">1h45m</option>
                                <option value="7">2h</option>
                            </select>
                        </div>

                        <input id="creneauNom" type="hidden" name="creneauNom" value="">
                        <input id="submitNewMeeting" type="submit" value="Go !">


                    </form>
                    
                    <span>* si le champ Nom est vide, cela supprimera le rendez-vous</span>
                
                </div>

                <div class="blocAntePostRdv">

                    <h4>Ante/Post RDV</h4>

                    <img id="backNewAntePostMeeting" src="../images/close.png" alt="retour">

                    <form id="creneauInjectionAntePost" action="include/traitPlanCreneauBeta.php" method="post">
                        <input type="text" name="nouvCreneauIdBeta" value="" readonly="true">
                        
                        <input type="text" name="creneauComment" value="">

                        <input id="creneauNom" type="hidden" name="creneauNom" value="">
                        <input id="submitNewAntePostMeeting" type="submit" value="Go !">
                    </form>
                </div>

            </section>

            <section class="interactionPatient">

                <?php creaInteraction(time(),$tabMois,$tabJourMulti,$connDB); ?>
                
                <aside id="blocAbsent">

                    <h2>Taux d'absence sup. à 30%</h2>

                    <?php importAbsent($connDB); ?>

                </aside>

                <aside id="blocTaf">

                    <h2>TAF</h2>

                    <form id="formItem" action="include/traitPlanTodolist.php" method="post">
                        <input type=text name="newItem" placeholder="">
                        <input type=submit name="submitNewItem" value="=>">
                    </form>

                    <?php creaTodolist($connDB); ?>
                
                </aside>
                
            </section>

            <section id="blocModification">
              
                <div class="blocModifPatient"></div>

                <div class="blocEnvoiCourrier"></div>
            
            </section>

            <section id="blocTestPresence">
                <img id="boutonRetourAbsence" src="../images/close.png" alt="retour absence">
                <form id="modifPresence" action="include/traitPlanPresence.php" method="post">
                    <input type="hidden" name="idTimeSlotPresence" value="">
                </form>
                <div class="controle">
                    <span>Merci de confirmer l'absence du patient en cliquant sur le bouton ci-dessous : </span>
                    <button id="boutonConfirme">Confirmez</button>
                </div>
            </section>

        </main>

    </body>

</html>
    
