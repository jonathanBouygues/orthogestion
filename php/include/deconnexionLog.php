<?php 

// Start session
session_start();

// Destroy session
session_destroy();

// Delete the identifier's in session
unset($_SESSION['id']);
unset($_SESSION['mdp']);
unset($_SESSION['prenom']);
unset($_SESSION['startActivity']);

//Back to the index
header('Location: ../../index.php');