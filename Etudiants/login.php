<?php
session_start();
require_once 'config/db.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');
    
    $sql = "SELECT * FROM etudiants WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['etudiant'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom']
        ];
        header('Location: espace_etudiant.php');
        exit;
    } else {
        $message = 'Identifiants incorrects.';
    }
}
?>
