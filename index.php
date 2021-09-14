<?php

    // Start the session
    session_start();

?>
<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ortho'gestion - Login</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon shortcut" href="../images/logo.png">
        <script src="js/regexp.js"></script>
        <script src="js/dynaLogin.js"></script>
    </head>
  
    <body> 

        <main id="containerLogin">

            <div id="triangleHaut"></div>

            <div id="containerForm">

                <div id="triangleForm"></div>

                <form id="verifLogin" action="php/include/traitVerifLogin.php" method="post">

                    <h2>Login</h2>
                    <label>Mail</label>
                    <input id="idLogin" type="text" name="idLogin">
                    <label>Mot de Passe</label>
                    <input id="mdpLogin" type="password" name="mdpLogin">
                    <input id="boutonLogin" type="submit" value="Envoyer">
                    
                </form>

                <form id="demandeCompte" action="php/include/traitDemCompte.php" method="post">
                    
                    <img id="backLogin" src="images/close.png" alt="retour login">

                    <h2>Formulaire de demande</h2>

                    <div id="containerReponse">
                        <div id="containerInput">
                            <div>
                                <label>Nom/Prénom</label>
                                <input type="text" name="demandeNom">
                            </div>
                            <div>
                                <label>Mail</label>
                                <input type="text" name="demandeMail" placeholder="ex : accueil@yahoo.fr">
                            </div>
                            <div>
                                <label>Téléphone</label>
                                <input name="demandeTel" type="text" placeholder="ex : 05-65-65-65-65">
                            </div>
                        </div>
                        
                        <div id="containerTextarea">
                            <label>Message</label>
                            <textarea name="demandeMessage" cols="30" rows="10"></textarea>
                        </div>

                    </div>

                    <input id="demandeSubmit" type="submit">
    
                </form>
                
                <div class="containerDemande"> 
                   <span>Si vous n'avez pas de compte, cliquez sur le bouton pour faire une demande</span>
                    <button id="demandeButton">Formulaire de demande</button>
                </div>
                
            </div>

        </main>

    </body>

</html>
    
