<?php
/**
 * Configuration générale du site
 * LYCEE MICHEL ALLAIRE
 */

// Configuration du site
define('SITE_NAME', 'LYCEE MICHEL ALLAIRE');
define('SITE_URL', 'https://codecode.gt.tc');
define('ADMIN_EMAIL', 'clyelise@gmail.com');

// Configuration des sessions
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1); // HTTPS uniquement

// Démarrage de session sécurisé
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Configuration des uploads
define('UPLOAD_MAX_SIZE', 5 * 1024 * 1024); // 5MB max
define('UPLOAD_PATH', __DIR__ . '/../students/uploads/');
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']);

// Configuration email
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'clyelise@gmail.com');
define('SMTP_PASSWORD', 'votre-mot-de-passe-app'); // A gérer plus tard : ajouter mot de passe

// Mode debug (désactiver en production)
define('DEBUG_MODE', true); // Activer temporairement pour le debug

// Timezone
date_default_timezone_set('Africa/Bamako');

// Fonctions utilitaires
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

function redirect($url) {
    // CORRECTION : Vérifier si les headers ne sont pas déjà envoyés
    if (!headers_sent()) {
        header("Location: " . $url);
        exit();
    }
}

// CORRECTION : Fonction cohérente avec le système de session
function is_logged_in() {
    return isset($_SESSION['student_id']) && !empty($_SESSION['student_id']);
}

// Fonction supplémentaire pour obtenir les infos de l'étudiant connecté
function get_current_student() {
    if (is_logged_in() && isset($_SESSION['etudiant'])) {
        return $_SESSION['etudiant'];
    }
    return null;
}
?>