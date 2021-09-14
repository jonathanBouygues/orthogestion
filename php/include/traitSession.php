<?php
    
// Start session
session_start();

// Gap on the start activity and now (max : 12h)
$timeActivity = time() - $_SESSION['startActivity'];

// if condition for check the identification
if (($_SESSION['id'] == false) || ($timeActivity > 43200)) {
    header('Location: ../index.php');
}