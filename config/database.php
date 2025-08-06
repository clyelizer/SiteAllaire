<?php
/**
 * Configuration de base de données pour InfinityFree
 * LYCEE MICHEL ALLAIRE
 */

// Paramètres de connexion InfinityFree
$host = 'sql304.infinityfree.com';        // Serveur MySQL InfinityFree
$dbname = 'if0_39632285_lycee_allaire';    
$username = 'if0_39632285';                // Votre nom d'utilisateur MySQL
$password = 'Diongaga2200';   // Votre mot de passe MySQL

// Options de connexion PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
    
    
} catch(PDOException $e) {
    // Log l'erreur (ne pas afficher en production)
    error_log("Erreur de connexion DB: " . $e->getMessage());
    
    // Message générique pour l'utilisateur
    die("Erreur de connexion à la base de données. Veuillez réessayer plus tard.");
}

// Variable globale pour l'utilisation dans d'autres fichiers
$GLOBALS['pdo'] = $pdo;
?>