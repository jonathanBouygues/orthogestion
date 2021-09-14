<?php

// Session's check
include('include/traitSession.php');

?>
<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title data-num="5">Ortho'gestion - Attente</title>
        <meta name="description" content="horloge">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon shortcut" href="../images/logo.png">
        <script src="../js/regexp.js" defer></script>
        <script src="../js/dynaAttente.js" defer></script>
    </head>
  
    <body> 
        
        <?php 
            include 'include/header.php';
        ?>

        <main id="containerAttente">

            <div class="blocTitre">
                <h2 data-num="5">Liste d'attente</h2>
            </div>
            

            <section class="attentePartieHaute">

                <img id="listeAttentePrecedent" src="../images/left-arrow.png" alt="liste précédent">
                
                <div id="containerListe">
                    <div class="gestionListe">
                        <?php include 'include/traitAttAppelDB.php';?>
                    </div>
                </div>

                <img id="listeAttenteSuivant" src="../images/right-arrow.png" alt="liste suivant">
                
            </section>

            <section id="attentePartieBasse" class="attentePartieBasse">

                
                <form id="formAttente" action="include/traitAttAppelDB.php" method="post">
                
                <fieldset>
                    
                    <table>
                        <tr>
                            <td><label>Date contact</label></td>
                            <td><input type="date" name="newDateContact" id="newDateContact"></td>
                            <td><label>Prénom de l'enfant</label></td>
                            <td><input type="text" name="newPrenomEnfant" id="newPrenomEnfant"  placeholder="caractères max 30" maxlength="30"></td>
                        </tr>
                        <tr>
                            <td><label>Age de l'enfant</label></td>
                            <td><input min="0" max="99" type="number" name="newAgeEnfant" id="newAgeEnfant"></td>
                            <td><label>Genre de l'enfant</label></td>
                            <td><select id="newGenreEnfant" name="newGenreEnfant">
                                <option value="Masculin">Masculin</option> 
                                <option value="Féminin">Féminin</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nom du parent</label></td>
                        <td><input type="text" name="newNomParent" id="newNomParent"  placeholder="caractères max 30" maxlength="30"></td>
                        <td><label>Prénom du parent</label></td>
                        <td><input type="text" name="newPrenomParent" id="newPrenomParent"  placeholder="caractères max 30" maxlength="30"></td>
                            </tr>
                            <tr>
                                <td><label>Numéro de téléphone</label></td>
                                <td><input type="text" name="newNumTel" id="newNumTel"></td>
                                <td><label>Mail</label></td>
                                <td><input type="mail" name="newMail" id="newMail"></td>
                            </tr>
                            <tr>
                                <td><label>Plainte</label></td>
                                <td><textarea name="newPlainte" id="newPlainte"  placeholder="caractères max 255" maxlength="255"></textarea></td>
                                <td><label>Contraintes horaires</label></td>
                                <td><textarea name="newLimiteHoraire" id="newLimiteHoraire"  placeholder="caractères max 255" maxlength="255"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2">Commentaires</td>
                                <td colspan="2"><textarea name="newCommentaires" id="newCommentaires"  placeholder="caractères max 255" maxlength="255"></textarea></td>
                            </tr>
                            
                        </table>
                        
                        <button id="ajouterAttente" class="ajouter">Ajouter</button>
                        
                    </fieldset>
                    
                </form>
                
                <div class="erreurNewAttente">
                </div>
                
            </section>
            
        </main>
        
    </body>
    
    </html>
    
    