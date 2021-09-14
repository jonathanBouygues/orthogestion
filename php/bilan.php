<?php

// Session's check
include('include/traitSession.php');

?>
<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title data-num="4">Ortho'gestion - Bilan</title>
        <meta name="description" content="horloge">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon shortcut" href="../images/logo.png">
        <script src="../js/regexp.js" defer></script>
        <script src="../js/dynaBilan.js" defer></script>
    </head>
  
    <body> 
        
        <?php 
            include 'include/header.php';
        ?>

        <main id="pageBilan">

            <div class="blocTitre">
                <h2 data-num="4">Bilan</h2>
                <img id='newDataBilan' src='../images/new_attente.png'>
            </div>

            <section id="containerBilan">

                <table id="bilanVisuel">
                    <caption>
                        <select id="dateBilan">
                            <?php
                                // Initialisation of begin/start
                                $timeAct = time();
                                $timeDeb = time() - 31536000;
                                $timeMax = time() + 31536000;
                                // Time actual
                                setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                                echo '<option value="';
                                echo strftime("%Y-%m",$timeAct);
                                echo '">'.utf8_encode(ucfirst(strftime("%b %Y",$timeAct))).'</option>';
                                // Loop to create the dates
                                for ($i = $timeDeb;$i < $timeMax;$i += 2628000) {
                                    if ($i != $timeAct) {
                                        echo '<option value="';
                                        echo strftime("%Y-%m",$i);
                                        echo '">'.ucfirst(strftime("%b %Y",$i)).'</option>';
                                    }
                                }
                            ?>
                        </select> 
                        <?php 
                        ?>
                    </caption>
                    <tbody>
                        <tr id="tableBilan">
                            <td id="tableCharges">      
                                <h4>Charges</h4>
                                <div id="containerCharges">
                                </div>
                            </td>
                            <td id="tableProduits">
                                <h4>Produits</h4>
                                <div id="containerProduits">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td id="tableResultat" colspan="2"> 
                                <span>Résultat mensuel :</span>
                                <span id="resultatBilan"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div id="containerNewBilan">
                    
                    <form id="newItemBilan" action="include/traitBilan.php" method="post">
                        <img id="backBilan" src="../images/close.png" alt="retour login">
                        <h3>Nouvel item</h3>

                        <label>Date</label>
                        <input type="date" name="dateInputBilan">
                        <label>Nom</label>
                        <input type="text" name="nomInputBilan">
                        <label>Montant</label>
                        <input type="text" name="montantInputBilan">
                        <input id="submitItem" type="submit" value="Enregistrer">

                        <span>
                            Montant négatif pour une charge et montant positif pour un produit
                        </span>
                    </form>
                
                </div>

            </section>

            <div id="containerDelBilan">
                <form id="formDelItemBilan" action="include/traitBilanDel.php" method="post">
                    <input type="text" name="idInputBilan">
                </form>
            </div>

        </main>

    </body>

</html>
    
