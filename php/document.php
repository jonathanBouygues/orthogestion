<?php

// Session's check
include('include/traitSession.php');

?>
<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title data-num="3">Ortho'gestion - Document</title>
        <meta name="description" content="horloge">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon shortcut" href="../images/logo.png">
        <script src="../js/dynaDocument.js" defer></script>
    </head>
  
    <body> 
        
        <?php  include 'include/header.php';?>

        <main id="pageDocument">

            <div class="blocTitre">
                <h2 data-num="3">Document</h2>
                <img id='newDocument' src='../images/new_attente.png'>
            </div>

            <section id="containerDocument">

                <div class="containerDocumentAff">
    
                    <?php

                    // open the directory
                    $pointeur = opendir("../documentPatient");
                        
                    // Lecture de l'intégralité du dossier grace à une boucle
                    while($entree = readdir($pointeur)) {

                        // On élimine les 2 entrées indésirables
                        if (($entree!='.') && ($entree!='..')) {
                            // Recherche du type d'entrée (fichier/dossier/autre)
                            if (is_dir('../documentPatient/'.$entree)) {
                                // Directory
                                echo '<div class="containerPatient">';
                                echo "<h4>".$entree."</h4>";

                                $pointeurBeta = opendir("../documentPatient/".$entree);

                                while($entreeBeta = readdir($pointeurBeta)) {

                                    if (($entreeBeta!='.') && ($entreeBeta!='..')) {
                                        echo '<div class="containerFile">';
                                        echo "<img class='folderPatient' src='../images/order.png'>";
                                        echo "<span data-parent='".$entree."'><a target='blank' href='../documentPatient/".$entree."/".$entreeBeta."'>".$entreeBeta."</a></span>";
                                        echo '</div>';
                                    }
                                }
                                echo '</div>';
                            } 
                        }
                    }
                        
                    // close the directory
                    closedir($pointeur);
                        
                    ?>
                
                </div>

            </section>

            <section id="containerNewDocument">
    
                <form id="formNewDocument" action="include/traitNewDocument.php" method="post" enctype="multipart/form-data">
                                
                    <label>Patient</label>
                    <select name="newNomDocument"></select>
                    <label>Lien</label>
                    <input type="file" name="newFileDocument">

                    <input id="addNewDocument" type="submit" value="Ajouter">

                </form>

            </section>

        </main>

    </body>

</html>