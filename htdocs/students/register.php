<?php
require_once '../config/config.php';
require_once '../config/database.php';


$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = sanitize_input($_POST['prenom'] ?? '');
    $nom = sanitize_input($_POST['nom'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $password = sanitize_input($_POST['password'] ?? '');

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM etudiants WHERE email_personnel = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        $message = 'Cet email est déjà utilisé.';
    } else {
        // Hash du mot de passe et insertion
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO etudiants (prenom, nom, email_personnel, password) VALUES (?, ?, ?, ?)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$prenom, $nom, $email, $hash]);
            // Connexion automatique après inscription
            $_SESSION['etudiant'] = [
                'id' => $pdo->lastInsertId(),
                'email_personnel' => $email,
                'nom' => $nom,
                'prenom' => $prenom
            ];
            header('Location: index.php');
            exit;
        } catch(PDOException $e) {
            $message = 'Erreur lors de l\'inscription. Veuillez réessayer.';
        }
    }
}
?>
