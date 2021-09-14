<?php

// Session's check
include('include/traitSession.php');

?>
<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title data-num="7">Ortho'gestion - Admin</title>
        <meta name="description" content="horloge">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon shortcut" href="../images/logo.png">
    </head>
  
    <body> 
        
        <?php 
            include 'include/header.php';
        ?>

        <main id="pageAdmin">
            
            <h2 data-num="7">Demande de création de compte</h2>

            <section id="containerDemandeCompte">

                <div class="containerVisuel">

                    <?php 
                    // connection's id
                    include 'include/connexion.php';
                    // Request to send
                    $req_dem = "SELECT * FROM demande_compte";
                    // Send the request and get the results
                    $resultat_dem = $connDB->query($req_dem);
                    // Formating the datas to .. 
                    $tabDem = $resultat_dem->fetchAll(PDO::FETCH_ASSOC);
                    // DB's deconnection
                    if (isset($connDB)) {
                        unset($connDB);
                    }

                    foreach ($tabDem as $ligne) {
                        echo '<div id="containerItemDemande">';
                        echo '<div id="numero"><span>N°</span>';
                        echo '<span>'.$ligne['dem_id'].'</span>';
                        echo '</div>';
                        echo '<div id="reponse">';
                        echo '<span>Nom : '.$ligne['dem_nom'].'</span>';
                        echo '<span>Mail : '.$ligne['dem_mail'].'</span>';
                        echo '<span>Téléphone : '.$ligne['dem_tel'].'</span>';
                        echo '</div>';
                        echo '<div id="message"><span>Message :</span>';
                        echo '<span>'.$ligne['dem_message'].'</span>';
                        echo '</div>';
                        echo '</div>';
                    }

                    ?>

                </div>

            </section>

        </main>

    </body>

</html>
    
