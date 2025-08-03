<?php
session_start();

// Ajoutez la connexion PDO avant toute utilisation de $pdo
$host = 'localhost';
$db   = 'lycee_db'; // Assurez-vous que la base existe et que le nom est correct
$user = 'root';              // Remplacez si besoin
$pass = '';                  // Remplacez si besoin
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // Ne pas ajouter .db
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = htmlspecialchars($_POST['prenom'] ?? '');
    $nom = htmlspecialchars($_POST['nom'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM etudiants WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        $message = 'Cet email est déjà utilisé.';
    } else {
        // Hash du mot de passe et insertion
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO etudiants (prenom, nom, email, password) VALUES (?, ?, ?, ?)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$prenom, $nom, $email, $hash]);
            // Connexion automatique après inscription
            $_SESSION['etudiant'] = [
                'id' => $pdo->lastInsertId(),
                'email' => $email,
                'nom' => $nom,
                'prenom' => $prenom
            ];
            header('Location: espace_etudiant.php');
            exit;
        } catch(PDOException $e) {
            $message = 'Erreur lors de l\'inscription. Veuillez réessayer.';
        }
    }
}
?>
