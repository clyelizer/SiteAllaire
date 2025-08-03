<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Documents - Espace Étudiant</title>
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
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
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

        /* Document Grid */
        .documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .document-card {
            background: rgba(240, 240, 245, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 25px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .document-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.12);
        }

        .document-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #FFC107, #F57F17);
            border-radius: 25px 25px 0 0;
        }

        .document-image {
            width: 100%;
            max-height: 250px;
            object-fit: contain;
            border-radius: 15px;
            margin-bottom: 20px;
            background: #fff;
            padding: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .document-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .document-meta {
            color: #666;
            font-size: 14px;
            line-height: 1.4;
        }

        /* No Documents Message */
        .no-documents {
            background: rgba(240, 240, 245, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .no-documents-icon {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .no-documents-text {
            font-size: 22px;
            font-weight: 600;
            color: #555;
            margin-bottom: 15px;
        }

        .no-documents-subtitle {
            color: #999;
            font-size: 16px;
            line-height: 1.6;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .document-card {
            animation: slideInUp 0.6s ease-out;
        }

        .document-card:nth-child(2) { animation-delay: 0.1s; }
        .document-card:nth-child(3) { animation-delay: 0.2s; }
        .document-card:nth-child(4) { animation-delay: 0.3s; }

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

            .documents-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .document-image {
                max-height: 200px;
            }

            .page-title {
                font-size: 26px;
            }
        }

        @media (max-width: 480px) {
            .document-card {
                padding: 20px;
            }

            .document-image {
                max-height: 150px;
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
                <h1 class="page-title">📄 Mes Documents</h1>
            </div>
        </div>

        <?php
        // Simuler la récupération des documents depuis un répertoire ou une base de données
        $documents = [
            [
                'path' => 'uploads/documents/cin.jpg',
                'title' => 'Carte d\'Identité Nationale',
                'date' => '2023-06-15',
                'type' => 'Identité'
            ]
            ,
            [
                'path' => 'uploads/documents/1.jpeg',
                'title' => 'Carte d\'Identité Nationale',
                'date' => '2023-06-15',
                'type' => 'Identité'
            ]
            ,
            [
                'path' => 'uploads/documents/4.pdf',
                'title' => 'Carte d\'Identité Nationale',
                'date' => '2023-06-15',
                'type' => 'Carte de sejour'
            ]
        ];

        try {
            // Vérifier si des documents existent
            if (!empty($documents)) {
                echo '<div class="documents-grid">';
                foreach ($documents as $index => $doc) {
                    $file_path = $doc['path'];
                    if (file_exists($file_path)) {
                        echo '
                        <div class="document-card">
                            <img src="' . htmlspecialchars($file_path) . '" 
                                 alt="' . htmlspecialchars($doc['title']) . '" 
                                 class="document-image">
                            <div class="document-title">' . htmlspecialchars($doc['title']) . '</div>
                            <div class="document-meta">
                                Type: ' . htmlspecialchars($doc['type']) . '<br>
                                Date d\'ajout: ' . htmlspecialchars($doc['date']) . '
                            </div>
                        </div>';
                    }
                }
                echo '</div>';
            } else {
                echo '
                <div class="no-documents">
                    <div class="no-documents-icon">📂❌</div>
                    <div class="no-documents-text">Aucun document disponible</div>
                    <div class="no-documents-subtitle">
                        Aucun document académique ou administratif n\'a été trouvé.<br><br>
                        <strong>Causes possibles :</strong><br>
                        • Aucun document n\'a été téléversé<br>
                        • Problème d\'accès au répertoire<br><br>
                        <strong>Solutions :</strong><br>
                        • Contactez l\'administration pour ajouter vos documents<br>
                        • Vérifiez votre connexion<br><br>
                        📧 Support : support@universite.ma<br>
                        📞 Assistance : +212 5 39 XX XX XX
                    </div>
                </div>';
            }
        } catch (Exception $e) {
            error_log("Erreur lors du chargement des documents: " . $e->getMessage());
            echo '
            <div class="no-documents">
                <div class="no-documents-icon">📂❌</div>
                <div class="no-documents-text">Erreur de chargement</div>
                <div class="no-documents-subtitle">
                    Impossible de charger les documents pour le moment.<br><br>
                    <strong>Causes possibles :</strong><br>
                    • Problème de connexion au serveur<br>
                    • Documents corrompus ou manquants<br>
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
        // Animation d'entrée progressive
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.document-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(40px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150);
            });

            // Effet de hover amélioré
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                    this.style.boxShadow = '0 30px 80px rgba(0, 0, 0, 0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = '0 20px 50px rgba(0, 0, 0, 0.1)';
                });
            });

            // Téléchargement au clic sur l'image
            document.querySelectorAll('.document-image').forEach(image => {
                image.style.cursor = 'pointer';
                image.title = 'Cliquer pour télécharger';
                
                image.addEventListener('click', function() {
                    const fileUrl = this.src;
                    const fileName = this.getAttribute('data-filename');
                    
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
            });
        });
    </script>
</body>
</html>