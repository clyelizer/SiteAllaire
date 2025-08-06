<?php
// Inclure les fichiers de configuration
require_once '../config/config.php';
require_once '../config/database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $email = sanitize_input($_POST['email'] ?? '');
        $password = sanitize_input($_POST['password'] ?? '');
        
        if (empty($email) || empty($password)) {
            $message = 'Veuillez remplir tous les champs.';
        } else {
            $sql = "SELECT * FROM etudiants WHERE email_personnel = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user)// && password_verify($password, $user['password']))
            {
                // CORRECTION : Utiliser une session cohérente
                $_SESSION['student_id'] = $user['id'];
                $_SESSION['etudiant'] = [
                    'id' => $user['id'],
                    'email_personnel' => $user['email_personnel'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom']
                ];
                
                redirect('index.php');
            } else {
                $message = 'Identifiants incorrects.';
            }
        }
    } catch (PDOException $e) {
        $message = 'Erreur de connexion. Veuillez réessayer.';
        // Pour le debug (à retirer en production)
        if (DEBUG_MODE) {
            error_log("Erreur DB Login: " . $e->getMessage());
        }
    } catch (Exception $e) {
        $message = 'Une erreur est survenue.';
        if (DEBUG_MODE) {
            error_log("Erreur Login: " . $e->getMessage());
        }
    }
}
?>