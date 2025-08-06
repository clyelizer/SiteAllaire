<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulletins & Notes - Espace Étudiant</title>
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
            max-width: 1400px;
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

        /* Bulletin Section */
        .bulletin-section {
            background: rgba(240, 240, 245, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            margin-bottom: 40px;
            width: 100%;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .bulletin-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.12);
        }

        .bulletin-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #81C784, #66BB6A);
            border-radius: 25px 25px 0 0;
        }

        .bulletin-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .bulletin-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .bulletin-table th,
        .bulletin-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            background: #fff;
        }

        .bulletin-table th {
            background: #f5f5f5;
            font-weight: 600;
            color: #333;
        }

        .bulletin-table td {
            color: #666;
        }

        .bulletin-average {
            font-size: 20px;
            font-weight: bold;
            color: #2196F3;
            margin-top: 15px;
            text-align: center;
        }

        /* No Bulletins Message */
        .no-bulletins {
            background: rgba(240, 240, 245, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
        }

        .no-bulletins-icon {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .no-bulletins-text {
            font-size: 22px;
            font-weight: 600;
            color: #555;
            margin-bottom: 15px;
        }

        .no-bulletins-subtitle {
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

        .bulletin-section {
            animation: slideInUp 0.8s ease-out;
        }

        .bulletin-section:nth-child(2) { animation-delay: 0.2s; }

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

            .bulletin-section {
                padding: 20px;
            }

            .page-title {
                font-size: 26px;
            }

            .bulletin-table th,
            .bulletin-table td {
                padding: 8px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .bulletin-section {
                padding: 15px;
            }

            .bulletin-table th,
            .bulletin-table td {
                padding: 6px;
                font-size: 12px;
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
                <h1 class="page-title">📊 Bulletins & Notes</h1>
            </div>
        </div>

        <?php
        // Simuler la récupération des bulletins depuis une base de données
        $bulletins = [
            [
                'period' => 'Période 1',
                'year' => '2024-2025',
                'average' => '14.5/20',
                'subjects' => [
                    ['name' => 'Mathématiques', 'coef' => 3, 'grade' => '15/20', 'appreciation' => 'Très bon travail'],
                    ['name' => 'Informatique', 'coef' => 2, 'grade' => '14/20', 'appreciation' => 'Efforts constants'],
                    ['name' => 'Physique', 'coef' => 2, 'grade' => '13/20', 'appreciation' => 'À améliorer'],
                    ['name' => 'Chimie', 'coef' => 2, 'grade' => '15/20', 'appreciation' => 'Très bien'],
                    ['name' => 'Anglais', 'coef' => 1, 'grade' => '16/20', 'appreciation' => 'Excellent']
                ]
            ],
            [
                'period' => 'Période 2',
                'year' => '2024-2025',
                'average' => '15.2/20',
                'subjects' => [
                    ['name' => 'Mathématiques', 'coef' => 3, 'grade' => '16/20', 'appreciation' => 'Excellent'],
                    ['name' => 'Informatique', 'coef' => 2, 'grade' => '15/20', 'appreciation' => 'Très bien'],
                    ['name' => 'Physique', 'coef' => 2, 'grade' => '14/20', 'appreciation' => 'Bon progrès'],
                    ['name' => 'Chimie', 'coef' => 2, 'grade' => '15/20', 'appreciation' => 'Très bon'],
                    ['name' => 'Anglais', 'coef' => 1, 'grade' => '17/20', 'appreciation' => 'Parfait']
                ]
            ]
        ];

        try {
            if (!empty($bulletins)) {
                foreach ($bulletins as $index => $bulletin) {
                    echo '
                    <div class="bulletin-section">
                        <div class="bulletin-title">' . htmlspecialchars($bulletin['period']) . ' - ' . htmlspecialchars($bulletin['year']) . '</div>
                        <table class="bulletin-table">
                            <thead>
                                <tr>
                                    <th>Matière</th>
                                    <th>Coef</th>
                                    <th>Note</th>
                                    <th>Appréciation</th>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach ($bulletin['subjects'] as $subject) {
                        echo '
                                <tr>
                                    <td>' . htmlspecialchars($subject['name']) . '</td>
                                    <td>' . htmlspecialchars($subject['coef']) . '</td>
                                    <td>' . htmlspecialchars($subject['grade']) . '</td>
                                    <td>' . htmlspecialchars($subject['appreciation']) . '</td>
                                </tr>';
                    }
                    echo '
                            </tbody>
                        </table>
                        <div class="bulletin-average">Moyenne Générale: ' . htmlspecialchars($bulletin['average']) . '</div>
                    </div>';
                }
            } else {
                echo '
                <div class="no-bulletins">
                    <div class="no-bulletins-icon">📊❌</div>
                    <div class="no-bulletins-text">Aucun bulletin disponible</div>
                    <div class="no-bulletins-subtitle">
                        Aucun bulletin ou note n\'a été trouvé.<br><br>
                        <strong>Causes possibles :</strong><br>
                        • Aucun bulletin n\'a été enregistré<br>
                        • Problème d\'accès à la base de données<br><br>
                        <strong>Solutions :</strong><br>
                        • Contactez l\'administration pour ajouter vos bulletins<br>
                        • Vérifiez votre connexion<br><br>
                        📧 Support : support@universite.ma<br>
                        📞 Assistance : +212 5 39 XX XX XX
                    </div>
                </div>';
            }
        } catch (Exception $e) {
            error_log("Erreur lors du chargement des bulletins: " . $e->getMessage());
            echo '
            <div class="no-bulletins">
                <div class="no-bulletins-icon">📊❌</div>
                <div class="no-bulletins-text">Erreur de chargement</div>
                <div class="no-bulletins-subtitle">
                    Impossible de charger les bulletins pour le moment.<br><br>
                    <strong>Causes possibles :</strong><br>
                    • Problème de connexion au serveur<br>
                    • Erreur dans la base de données<br>
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
            const sections = document.querySelectorAll('.bulletin-section');
            sections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(40px)';
                
                setTimeout(() => {
                    section.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 200);
            });

            // Effet de hover amélioré
            sections.forEach(section => {
                section.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                    this.style.boxShadow = '0 30px 80px rgba(0, 0, 0, 0.15)';
                });
                
                section.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = '0 20px 50px rgba(0, 0, 0, 0.1)';
                });
            });
        });
    </script>
</body>
</html>