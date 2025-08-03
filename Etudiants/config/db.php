<?php
$host = 'localhost';
$dbname = 'lycee_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Création de la table étudiants si elle n'existe pas
$sql = "CREATE TABLE IF NOT EXISTS etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
 )";

try {
    $pdo->exec($sql);
} catch(PDOException $e) {
    die("Erreur de création de table : " . $e->getMessage());
}

// Insérer un étudiant test si la table est vide
$check = $pdo->query("SELECT COUNT(*) FROM etudiants")->fetchColumn();
if ($check == 0) {
    $hash = password_hash('12345', PASSWORD_DEFAULT);
    $sql = "INSERT INTO etudiants (email, password, nom, prenom) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['etudiant1@example.com', $hash, 'Doe', 'John']);
}
