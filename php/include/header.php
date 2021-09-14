<?php

// Session's check against the modification in URL
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
}

?>
<header>

    <div id="containerHeader">

        <div id="headerGauche">

            <div class="logo">
                <img id="logo" src="../images/logo.png" alt="logo">
            </div>
    
            <nav>
                <ul>
                    <li><a data-num="1" href="planning.php">Planning</a></li>
                    <li><a data-num="2" href="patient.php">Patient</a></li>
                    <li><a data-num="3" href="document.php">Document</a></li>
                    <li><a data-num="4" href="bilan.php">Bilan</a></li>
                    <li><a data-num="5" href="attente.php">Liste d'attente</a></li>
                    <li><a data-num="6" href="compta.php">Compta Pro/Perso</a></li>
                    <?php
                        // Appears for profil "admin"
                        if ($_SESSION['admin'] == 1) {
                            echo '<li><a data-num="7" href="admin.php">Admin</a></li>';
                        }
                    ?>
                </ul>
            </nav>
        
        </div>

        <img id="blocNote" src="../images/bloc_note.png" alt="bloc-note">
        <img id="blocNotif" src="../images/notification.png" alt="notification">


        <div class="headerDroit">
            <img id="profilImg" src="../images/user.png" alt="profil">
            <p>Bonjour <?php echo $_SESSION['prenom'] ?>
            <span id="deconnexion">déconnexion</span></p>

            <form id="formDeco"action="include/deconnexionLog.php">
            </form>

        </div>

    </div> 

    <script src="../js/dynaHeader.js" defer></script>

</header>