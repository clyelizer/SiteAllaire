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
                <a href="../espace_etudiant.php" class="back-btn">
                    ← Retour à l'accueil
                </a>
                <h1 class="page-title">📅 Emploi du Temps</h1>
            </div>
        </div>

        <?php
        // Simuler la récupération de l'emploi du temps (une seule image)
        $schedule = [
            'path' => 'uploads/documents/emploi.png',
            'title' => 'Emploi du Temps - Semestre 3',
            'date' => '2025-09-01',
            'semester' => 'Semestre 3'
        ];

        try {
            $file_path = $schedule['path'];
            if (!empty($schedule['path']) && file_exists($file_path)) {
                echo '
                <div class="schedule-card">
                    <img src="' . htmlspecialchars($file_path) . '" 
                         alt="' . htmlspecialchars($schedule['title']) . '" 
                         class="schedule-image" 
                         data-filename="' . htmlspecialchars(basename($schedule['path'])) . '">
                    <div class="schedule-title">' . htmlspecialchars($schedule['title']) . '</div>
                    <div class="schedule-meta">
                        Semestre: ' . htmlspecialchars($schedule['semester']) . '<br>
                        Date de mise à jour: ' . htmlspecialchars($schedule['date']) . '
                    </div>
                </div>';
            } else {
                echo '
                <div class="no-schedule">
                    <div class="no-schedule-icon">📅❌</div>
                    <div class="no-schedule-text">Aucun emploi du temps disponible</div>
                    <div class="no-schedule-subtitle">
                        L\'emploi du temps n\'a pas été trouvé.<br><br>
                        <strong>Causes possibles :</strong><br>
                        • Aucun emploi du temps n\'a été téléversé<br>
                        • Problème d\'accès au répertoire<br><br>
                        <strong>Solutions :</strong><br>
                        • Contactez l\'administration pour obtenir votre emploi du temps<br>
                        • Vérifiez votre connexion<br><br>
                        📧 Support : support@universite.ma<br>
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
                    📧 Support : support@universite.ma<br>
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