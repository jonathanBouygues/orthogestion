<?php

// Identifiers for connection in PDO
// define('DB_DSN', 'mysql:host=localhost;port=3306;dbname=bojo6835_ortho_gestion');
// define('DB_USER', 'bojo6835_admin');
// define('DB_MDP', '31orthoG46!');
define('DB_DSN', 'mysql:host=localhost:3308;dbname=ortho_gestion');
define('DB_USER', 'root');
define('DB_MDP', '');

// Db's connection
try {
    $connDB = new PDO(DB_DSN, DB_USER, DB_MDP);
} catch(Exception $erreur) {
    exit('Problème de connexion à la DB.');
}
