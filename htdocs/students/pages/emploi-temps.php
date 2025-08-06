<?php
session_start();

// Vérifier si l'étudiant est connecté
if (!isset($_SESSION['etudiant']['id'])) {
    header('Location: ../login.html');
    exit();
}

// Connexion à la base de données avec PDO
$host = 'sql304.infinityfree.com';
$db = 'if0_39632285_lycee_allaire';
$user = 'if0_39632285';
$pass = 'Diongaga2200';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    die('Erreur de connexion à la base de données. Veuillez réessayer plus tard.');
}

// Récupérer l'ID de l'étudiant
$etudiant_id = $_SESSION['etudiant']['id'];
$schedule = null;

try {
    // Récupérer l'emploi du temps de la classe de l'étudiant pour l'année scolaire courante
    $stmt = $pdo->prepare("
        SELECT c.nom_classe, e.fichier, e.description, e.updated_at
        FROM inscriptions i
        JOIN classes c ON i.id_classe = c.id_classe
        LEFT JOIN emploi_du_temps e ON i.id_classe = e.id_classe
        WHERE i.id_etudiant = ? 
        AND i.annee_scolaire = '2025-2026' 
        AND i.statut = 'Actif'
        LIMIT 1
    ");
    $stmt->execute([$etudiant_id]);
    $schedule = $stmt->fetch();
} catch (\PDOException $e) {
    error_log("Erreur lors du chargement de l'emploi du temps: " . $e->getMessage());
    $schedule = null;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du Temps - Espace Étudiant</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4CAF50 0%, #2196F3 50%, #FFC107 100%);
            min-height: 100vh;
            color: #333;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            max-width: 1000px;
            width: 100%;
            padding: 20px;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px 35px;
            margin-bottom: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            padding: 14px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .page-title {
            font-size: 30px;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Schedule Card */
        .schedule-card {
            background: rgba(240, 240, 245, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .schedule-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.12);
        }

        .schedule-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #64B5F6, #42A5F5);
            border-radius: 25px 25px 0 0;
        }

        .schedule-image {
            width: 100%;
            max-height: 500px;
            object-fit: contain;
            border-radius: 15px;
            margin-bottom: 20px;
            background: #fff;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .schedule-title {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .schedule-meta {
            color: #666;
            font-size: 16px;
            line-height: 1.4;
        }

        /* No Schedule Message */
        .no-schedule {
            background: rgba(240, 240, 245, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 800px;
            width: 100%;
        }

        .no-schedule-icon {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .no-schedule-text {
            font-size: 22px;
            font-weight: 600;
            color: #555;
            margin-bottom: 15px;
        }

        .no-schedule-subtitle {
            color: #999;
            font-size: 16px;
            line-height: 1.6;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Animations */
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .schedule-card {
            animation: fadeInScale 0.8s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .schedule-card {
                padding: 30px;
            }

            .schedule-image {
                max-height: 400px;
            }

            .page-title {
                font-size: 26px;
            }
        }

        @media (max-width: 480px) {
            .schedule-card {
                padding: 20px;
            }

            .schedule-image {
                max-height: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <a href="../index.php" class="back-btn">
                    ← Retour à l'accueil
                </a>
                <h1 class="page-title">📅 Emploi du Temps</h1>
            </div>
        </div>

        <?php
        try {
            $file_path = $schedule['fichier'] ?? '';
            $file_name = $file_path ? basename($file_path) : '';
            $title = $schedule ? 'Emploi du Temps - ' . htmlspecialchars($schedule['nom_classe']) : 'Emploi du Temps';
            $description = $schedule['description'] ?? 'Année scolaire 2025-2026';
            $date = $schedule['updated_at'] ? date('Y-m-d', strtotime($schedule['updated_at'])) : 'Non disponible';

            if ($schedule && !empty($file_path) && file_exists('../' . $file_path)) {
                echo '
                <div class="schedule-card">
                    <img src="../' . htmlspecialchars($file_path) . '" 
                         alt="' . htmlspecialchars($title) . '" 
                         class="schedule-image" 
                         data-filename="' . htmlspecialchars($file_name) . '">
                    <div class="schedule-title">' . htmlspecialchars($title) . '</div>
                    <div class="schedule-meta">
                        Classe: ' . htmlspecialchars($schedule['nom_classe']) . '<br>
                        Date de mise à jour: ' . htmlspecialchars($date) . '
                    </div>
                </div>';
            } else {
                echo '
                <div class="no-schedule">
                    <div class="no-schedule-icon">📅❌</div>
                    <div class="no-schedule-text">Aucun emploi du temps disponible</div>
                    <div class="no-schedule-subtitle">
                        L\'emploi du temps pour votre classe n\'a pas été trouvé.<br><br>
                        <strong>Causes possibles :</strong><br>
                        • Vous n\'êtes pas inscrit dans une classe<br>
                        • L\'emploi du temps n\'a pas été téléversé<br>
                        • Fichier manquant ou chemin incorrect<br><br>
                        <strong>Solutions :</strong><br>
                        • Vérifiez votre inscription<br>
                        • Contactez l\'administration<br><br>
                        📧 Support : support@lyceeallaire.ma<br>
                        📞 Assistance : +212 5 39 XX XX XX
                    </div>
                </div>';
            }
        } catch (Exception $e) {
            error_log("Erreur lors du chargement de l'emploi du temps: " . $e->getMessage());
            echo '
            <div class="no-schedule">
                <div class="no-schedule-icon">📅❌</div>
                <div class="no-schedule-text">Erreur de chargement</div>
                <div class="no-schedule-subtitle">
                    Impossible de charger l\'emploi du temps pour le moment.<br><br>
                    <strong>Causes possibles :</strong><br>
                    • Problème de connexion au serveur<br>
                    • Fichier corrompu ou manquant<br>
                    • Erreur système temporaire<br><br>
                    <strong>Solutions :</strong><br>
                    • Actualisez la page<br>
                    • Contactez l\'administration si le problème persiste<br><br>
                    📧 Support : support@lyceeallaire.ma<br>
                    📞 Assistance : +212 5 39 XX XX XX
                </div>
            </div>';
        }
        ?>
    </div>

    <script>
        // Animation d'entrée
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.schedule-card');
            if (card) {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, 100);
            }

            // Effet de hover
            if (card) {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                    this.style.boxShadow = '0 30px 80px rgba(0, 0, 0, 0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = '0 20px 50px rgba(0, 0, 0, 0.1)';
                });
            }

            // Téléchargement au clic sur l'image
            const image = document.querySelector('.schedule-image');
            if (image) {
                image.style.cursor = 'pointer';
                image.title = 'Cliquer pour télécharger';
                
                image.addEventListener('click', function() {
                    const fileUrl = this.src;
                    const fileName = this.getAttribute('data-filename') || 'schedule.jpg';
                    
                    // Créer un lien temporaire pour le téléchargement
                    const link = document.createElement('a');
                    link.href = fileUrl;
                    link.download = fileName;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    
                    // Animation de confirmation
                    const titleElement = this.nextElementSibling;
                    const originalText = titleElement.textContent;
                    titleElement.textContent = '✓ Téléchargement lancé !';
                    titleElement.style.color = '#4CAF50';
                    
                    setTimeout(() => {
                        titleElement.textContent = originalText;
                        titleElement.style.color = '#333';
                    }, 1500);
                });
            }
        });
    </script>
</body>
</html>