<?php
require_once '../config/config.php';
require_once '../config/database.php';

// Vérifier si l'étudiant est connecté
if (!isset($_SESSION['etudiant'])) {
    header('Location: ../login.html');
    exit();
}

// Récupérer l'ID de l'étudiant
$etudiant_id = $_SESSION['etudiant']['id'] ?? null;
$etudiant_data = null;

if ($etudiant_id) {
    try {
        // Récupérer les informations de l'étudiant depuis la table etudiants
        $stmt = $pdo->prepare("
            SELECT student_id,nom,prenom,classe
            FROM etudiants
            WHERE id = ?
        ");
        $stmt->execute([$etudiant_id]);
        $etudiant_data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Formater l'ID étudiant pour l'affichage
        if ($etudiant_data) {
            $etudiant_data['formatted_id'] = sprintf('ETUD-%04d', $etudiant_id);
        }
    } catch (PDOException $e) {
        error_log("Erreur lors du fetch des données: " . $e->getMessage());
        $etudiant_data = null;
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Tableau de bord du compte de chaque etudiant du lycee michel allaire de Segou" >
    <title>Espace Étudiant</title>
    <style>
        /* ===== RESET & BASE STYLES ===== */
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
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* ===== COLOR VARIABLES ===== */
        :root {
            --color-green: #4CAF50;
            --color-blue: #2196F3;
            --color-yellow: #FFC107;
            --color-green-dark: #388E3C;
            --color-blue-dark: #1976D2;
            --color-yellow-dark: #F57F17;
            --color-text: #333;
            --color-text-light: #666;
            --color-white: rgba(255, 255, 255, 0.95);
            --shadow-light: 0 8px 32px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 15px;
            --transition: all 0.3s ease;
        }

        /* ===== UTILITY CLASSES ===== */
        .accent-green { color: var(--color-green); }
        .accent-blue { color: var(--color-blue); }
        .accent-yellow { color: var(--color-yellow); }

        .glass-effect {
            background: var(--color-white);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
        }

        .hover-lift {
            transition: var(--transition);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        /* ===== HEADER SECTION ===== */
        .header {
            padding: 20px;
            margin-bottom: 30px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .student-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--color-green), var(--color-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .welcome-text {
            font-size: 24px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 5px;
        }

        .student-id {
            color: var(--color-text-light);
            font-size: 14px;
        }

        .logout-btn {
            background: linear-gradient(45deg, var(--color-yellow), #FF9800);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
        }

        /* ===== NAVIGATION MENU ===== */
        .nav-menu {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .nav-item {
            padding: 25px;
            text-decoration: none;
            color: var(--color-text);
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s;
        }

        .nav-item:hover::before {
            left: 100%;
        }

        .nav-item:hover {
            transform: translateY(-5px);
        }

        .nav-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
        }

        .nav-content h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--color-text);
        }

        .nav-content p {
            color: var(--color-text-light);
            font-size: 14px;
            line-height: 1.4;
        }

        /* Navigation Icons Colors */
        .nav-item.profile .nav-icon { 
            background: linear-gradient(45deg, var(--color-blue), var(--color-blue-dark)); 
        }
        .nav-item.documents .nav-icon { 
            background: linear-gradient(45deg, var(--color-yellow), var(--color-yellow-dark)); 
        }
        .nav-item.grades .nav-icon { 
            background: linear-gradient(45deg, #81C784, #66BB6A); 
        }
        .nav-item.schedule .nav-icon { 
            background: linear-gradient(45deg, #64B5F6, #42A5F5); 
        }

        /* ===== STATISTICS SECTION ===== */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
            border-left: 4px solid;
        }

        .stat-card:nth-child(1) { border-left-color: var(--color-green); }
        .stat-card:nth-child(2) { border-left-color: var(--color-blue); }
        .stat-card:nth-child(3) { border-left-color: var(--color-yellow); }
        .stat-card:nth-child(4) { border-left-color: var(--color-green); }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            color: var(--color-blue);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--color-text-light);
            font-size: 14px;
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .nav-menu {
                grid-template-columns: 1fr;
            }

            .welcome-text {
                font-size: 20px;
            }

            .quick-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            .quick-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- ===== HEADER SECTION ===== -->
        <header class="header glass-effect">
            <div class="header-content">
                <div class="student-info">
                    <div class="student-avatar"><?= htmlspecialchars($etudiant_data['nom'][0].$etudiant_data['prenom'][0]) ?></div>
                    <div>
                    <div class="welcome-text">
    Bienvenue 
    <span class="accent-green"><?= $etudiant_data ? htmlspecialchars($etudiant_data['nom']) : 'Étudiant' ?></span> 
    <span class="accent-blue"><?= $etudiant_data ? htmlspecialchars($etudiant_data['prenom']) : '' ?></span> !
</div>

<div class="student-id">
    ID Étudiant: <?= $etudiant_data ? htmlspecialchars($etudiant_data['student_id']) : 'Non défini' ?> | 
    Classe: <?= $etudiant_data ? htmlspecialchars($etudiant_data['classe']) : 'Non défini' ?>
</div>                    
</div>
                </div>
                <form action="logout.php" method="POST">
                    <button type="submit" class="logout-btn">🚪 Déconnexion</button>
                </form>
            </div>
        </header>

        <!-- ===== NAVIGATION MENU ===== -->
        <nav class="nav-menu">
            <a href="pages/profil.php" class="nav-item profile glass-effect hover-lift">
                <div class="nav-icon">👤</div>
                <div class="nav-content">
                    <h3>Mon Profil</h3>
                    <p>Informations personnelles, photo de profil et coordonnées</p>
                </div>
            </a>

            <a href="pages/documents.php" class="nav-item documents glass-effect hover-lift">
                <div class="nav-icon">📄</div>
                <div class="nav-content">
                    <h3>Mes Documents</h3>
                    <p>Scans des pièces d'identité, certificats et attestations</p>
                </div>
            </a>

            <a href="pages/bulletins.php" class="nav-item grades glass-effect hover-lift">
                <div class="nav-icon">📊</div>
                <div class="nav-content">
                    <h3>Bulletins & Notes</h3>
                    <p>Relevés de notes, bulletins et résultats d'examens</p>
                </div>
            </a>

            <a href="pages/emploi-temps.php" class="nav-item schedule glass-effect hover-lift">
                <div class="nav-icon">📅</div>
                <div class="nav-content">
                    <h3>Emploi du Temps</h3>
                    <p>Planning des cours, horaires et salles de classe</p>
                </div>
            </a>
        </nav>

        <!-- ===== STATISTICS SECTION ===== -->
        <section class="quick-stats">
            <div class="stat-card glass-effect hover-lift">
                <div class="stat-number accent-green">---</div>
                <div class="stat-label">Moyenne Générale</div>
            </div>
           
            <div class="stat-card glass-effect hover-lift">
                <div class="stat-number accent-yellow">---</div>
                <div class="stat-label">Taux de Présence</div>
            </div>
          
        </section>
    </div>

    <!-- ===== JAVASCRIPT ===== -->
    <script>
        // ===== ANIMATION D'ENTRÉE PROGRESSIVE =====
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.nav-item, .stat-card');
            
            animatedElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(30px)';
                
                setTimeout(() => {
                    element.style.transition = 'all 0.6s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // ===== INTERACTIONS HOVER AMÉLIORÉES =====
        const navItems = document.querySelectorAll('.nav-item');
        
        navItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
        // ===== GESTION DU FOCUS POUR L'ACCESSIBILITÉ =====
        document.querySelectorAll('.nav-item, .logout-btn').forEach(element => {
            element.addEventListener('focus', function() {
                this.style.outline = '3px solid var(--color-blue)';
                this.style.outlineOffset = '2px';
            });
            
            element.addEventListener('blur', function() {
                this.style.outline = 'none';
            });
        });
    </script>
</body>
</html>