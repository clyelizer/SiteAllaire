<?php
session_start();

// Vérifier si l'étudiant est connecté
if (!isset($_SESSION['etudiant'])) {
    header('Location: ../login.php');
    exit();
}

// Simulation du fetch des données (remplacez par votre logique de base de données)
$etudiant_id = $_SESSION['etudiant']['id'] ?? null;
$etudiant_data = null;

// Exemple de fetch des données (à adapter selon votre base de données)
try {
    // Simulation des données pour démonstration
    $etudiant_data = [
        // Informations personnelles
        'nom' => 'Traoré',
        'prenom' => 'Aminata',
        'date_naissance' => '2003-08-12',
        'lieu_naissance' => 'Bamako',
        'sexe' => 'Féminin',
        'nationalite' => 'Malienne',
        'cin' => 'ML123456789',
        'date_delivrance_cin' => '2021-05-10',
        'lieu_delivrance_cin' => 'Bamako',
        'passeport' => '',
        'situation_matrimoniale' => 'Célibataire',
        
        // Adresse & Contact
        'adresse_permanente' => 'Quartier Lafiabougou, Rue 234, Porte 56, Bamako',
        'adresse_temporaire' => 'Cité Universitaire, Chambre 245, Tétouan',
        'code_postal' => '93000',
        'region' => 'Tanger-Tétouan-Al Hoceima',
        'telephone_personnel' => '+212 6 12 34 56 78',
        'telephone_secondaire' => '+223 70 12 34 56',
        'email_personnel' => 'aminata.traore@gmail.com',
        'email_universitaire' => 'a.traore@universite.ma',
        
        // Informations Père
        'nom_pere' => 'Moussa Traoré',
        'profession_pere' => 'Enseignant',
        'telephone_pere' => '+223 65 78 90 12',
        'email_pere' => 'moussa.traore@education.ml',
        'adresse_pere' => 'Quartier Lafiabougou, Bamako',
        'statut_pere' => 'Vivant',
        
        // Informations Mère
        'nom_mere' => 'Fatoumata Coulibaly',
        'profession_mere' => 'Commerçante',
        'telephone_mere' => '+223 76 54 32 10',
        'email_mere' => '',
        'adresse_mere' => 'Quartier Lafiabougou, Bamako',
        'statut_mere' => 'Vivante',
        
        // Tuteur
        'nom_tuteur' => 'Ibrahim Coulibaly',
        'lien_parente' => 'Oncle maternel',
        'profession_tuteur' => 'Médecin',
        'telephone_tuteur' => '+212 6 98 76 54 32',
        'email_tuteur' => 'i.coulibaly@hopital.ma',
        'adresse_tuteur' => 'Avenue Mohammed V, Tétouan',
        'contact_urgence' => '+212 6 98 76 54 32',
        
        // Informations Académiques (Lycée)
        'etablissement_origine' => 'Lycée Technique de Bamako',
        'ville_lycee' => 'Bamako',
        'serie_bac' => 'Série S (Scientifique)',
        'annee_bac' => '2022',
        'mention_bac' => 'Bien',
        'note_bac' => '14.5',
        'numero_diplome_bac' => 'BAC2022-S-BKO-1234',
        'centre_examen' => 'Centre d\'examen de Bamako Nord',
        
        // Informations Médicales
        'groupe_sanguin' => 'O+',
        'facteur_rhesus' => 'Positif',
        'allergies' => 'Arachides, Pénicilline',
        'maladies_chroniques' => 'Aucune',
        'handicaps' => 'Aucun',
        'traitement_medical' => 'Aucun',
        'assurance_maladie' => 'CNOPS',
        'numero_assurance' => 'CN123456789',
        'medecin_traitant' => 'Dr. Hassan Benali - +212 5 39 12 34 56',
        'contact_medical_urgence' => 'Hôpital Saniat Rmel - +212 5 39 99 99 99',
        
        // Informations Financières
        'statut_frais' => 'Payé',
        'montant_frais_annuels' => '15000 MAD',
        'mode_paiement' => 'Virement bancaire',
        'echeancier' => 'Semestriel',
        'bourse_etudes' => 'Oui',
        'type_bourse' => 'Bourse de mérite gouvernementale',
        'montant_bourse' => '8000 MAD',
        'organisme_bourse' => 'Ministère de l\'Enseignement Supérieur',
        'aide_financiere' => 'Aide au logement',
        'situation_financiere' => 'Moyenne',
        'activite_remuneree' => 'Cours particuliers (weekend)',
        'compte_bancaire' => 'BMCE Bank - RIB: 011 780 0000123456789 12',
        
        'photo' => 'uploads/photos/aminata_traore.jpg',
        'id' => '2024001'
    ];
    
} catch (Exception $e) {
    $etudiant_data = null;
    error_log("Erreur lors du fetch des données: " . $e->getMessage());
}
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil Complet - Espace Étudiant</title>
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
            max-width: 1400px; /* Increased for larger layout */
            margin: 0 auto;
        }

        /* Header élégant */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 40px; /* Increased margin */
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px 35px; /* Increased padding */
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            padding: 14px 24px; /* Increased padding */
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
            font-size: 30px; /* Slightly larger title */
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header-actions {
            display: flex;
            gap: 15px;
        }

        .btn-action {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 12px 24px; /* Increased padding */
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-action:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
        }

        /* Carte principale du profil avec photo */
        .profile-hero {
            background: rgba(245, 245, 250, 0.85); /* Softer background */
            backdrop-filter: blur(15px);
            border-radius: 30px; /* Larger border radius */
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            margin-bottom: 40px; /* Increased margin */
            position: relative;
        }

        .photo-banner {
            background: linear-gradient(135deg, #4CAF50 0%, #2196F3 100%);
            padding: 60px 40px 40px; /* Increased padding */
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .photo-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .profile-photo-container {
            position: relative;
            display: inline-block;
            z-index: 2;
        }

        .profile-photo {
            width: 200px; /* Larger photo */
            height: 200px;
            border-radius: 50%;
            border: 6px solid white;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
            object-fit: cover;
            background: #f0f0f0;
        }

        .photo-placeholder {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 6px solid white;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
            background: linear-gradient(45deg, #e0e0e0, #f5f5f5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 70px; /* Larger icon */
            color: #999;
        }

        .student-identity {
            margin-top: 30px;
            z-index: 2;
            position: relative;
        }

        .student-name {
            font-size: 36px; /* Larger font */
            font-weight: 700;
            color: white;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.3);
            margin-bottom: 10px;
        }

        .student-details {
            color: rgba(255, 255, 255, 0.9);
            font-size: 18px; /* Larger font */
            font-weight: 500;
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Grid des sections d'informations */
        .info-sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); /* Larger min-width */
            gap: 30px; /* Increased gap */
        }

        .info-section {
            background: rgba(240, 240, 245, 0.85); /* Softer, less white background */
            backdrop-filter: blur(15px);
            border-radius: 25px; /* Larger border radius */
            padding: 40px; /* Increased padding */
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1); /* Softer shadow */
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            border-radius: 25px 25px 0 0;
        }

        .info-section.personal::before { background: linear-gradient(90deg, #4CAF50, #66BB6A); }
        .info-section.family::before { background: linear-gradient(90deg, #FF9800, #FFB74D); }
        .info-section.academic::before { background: linear-gradient(90deg, #2196F3, #64B5F6); }
        .info-section.medical::before { background: linear-gradient(90deg, #F44336, #EF5350); }
        .info-section.financial::before { background: linear-gradient(90deg, #FFC107, #FFEB3B); }

        .info-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.12);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px; /* Increased margin */
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.05);
        }

        .section-icon {
            width: 60px; /* Larger icon */
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px; /* Larger font */
            color: white;
            font-weight: bold;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .personal .section-icon { background: linear-gradient(45deg, #4CAF50, #66BB6A); }
        .family .section-icon { background: linear-gradient(45deg, #FF9800, #FFB74D); }
        .academic .section-icon { background: linear-gradient(45deg, #2196F3, #64B5F6); }
        .medical .section-icon { background: linear-gradient(45deg, #F44336, #EF5350); }
        .financial .section-icon { background: linear-gradient(45deg, #FFC107, #FFEB3B); }

        .section-title {
            font-size: 24px; /* Larger font */
            font-weight: 700;
            color: #333;
        }

        .section-subtitle {
            font-size: 16px; /* Larger font */
            color: #666;
            margin-top: 4px;
        }

        /* Sous-sections pour famille */
        .family-subsection {
            background: rgba(245, 245, 250, 0.8); /* Softer background */
            border-radius: 18px; /* Slightly larger */
            padding: 25px; /* Increased padding */
            margin-bottom: 25px;
            border-left: 4px solid;
        }

        .family-subsection.pere { border-left-color: #2196F3; }
        .family-subsection.mere { border-left-color: #E91E63; }
        .family-subsection.tuteur { border-left-color: #FF9800; }

        .subsection-title {
            font-size: 18px; /* Larger font */
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .subsection-title::before {
            content: '';
            width: 10px; /* Larger dot */
            height: 10px;
            border-radius: 50%;
            background: currentColor;
        }

        /* Items d'information */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Larger min-width */
            gap: 20px; /* Increased gap */
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 14px 0; /* Increased padding */
        }

        .info-label {
            font-weight: 600;
            color: #555;
            font-size: 14px; /* Larger font */
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #333;
            font-size: 16px; /* Larger font */
            font-weight: 500;
            word-break: break-word;
        }

        .info-value.empty {
            color: #999;
            font-style: italic;
            font-weight: 400;
        }

        .info-value.highlight {
            color: #2196F3;
            font-weight: 600;
        }

        .info-value.success {
            color: #4CAF50;
            font-weight: 600;
        }

        .info-value.warning {
            color: #FF9800;
            font-weight: 600;
        }

        /* Message d'absence de données */
        .no-data-message {
            text-align: center;
            padding: 70px 40px; /* Increased padding */
            color: #666;
        }

        .no-data-icon {
            font-size: 90px; /* Larger icon */
            color: #ddd;
            margin-bottom: 30px;
        }

        .no-data-text {
            font-size: 22px; /* Larger font */
            font-weight: 600;
            margin-bottom: 15px;
            color: #555;
        }

        .no-data-subtitle {
            color:brown;
            font-size: 17px; /* Larger font */
            line-height: 1.6;
            max-width: 450px; /* Larger width */
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

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .profile-hero {
            animation: fadeInScale 0.8s ease-out;
        }

        .info-section {
            animation: slideInUp 0.6s ease-out;
        }

        .info-section:nth-child(2) { animation-delay: 0.1s; }
        .info-section:nth-child(3) { animation-delay: 0.2s; }
        .info-section:nth-child(4) { animation-delay: 0.3s; }
        .info-section:nth-child(5) { animation-delay: 0.4s; }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .header-left {
                flex-direction: column;
                gap: 15px;
            }

            .page-title {
                font-size: 26px;
            }

            .info-sections {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .photo-banner {
                padding: 50px 25px 30px;
            }

            .profile-photo,
            .photo-placeholder {
                width: 160px;
                height: 160px;
            }

            .student-name {
                font-size: 28px;
            }

            .student-details {
                flex-direction: column;
                gap: 12px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .section-header {
                flex-direction: column;
                text-align: center;
                gap: 12px;
            }
        }

        @media (max-width: 480px) {
            .info-section {
                padding: 25px;
            }

            .family-subsection {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header moderne -->
        <div class="header">
            <div class="header-left">
                <a href="../espace_etudiant.php" class="back-btn">
                    ← Retour à l'accueil
                </a>
                <h1 class="page-title">📋 Profil Complet</h1>
            </div>
            <div class="header-actions">
                <button class="btn-action">📄 Exporter PDF</button>
            </div>
        </div>

        <?php if ($etudiant_data): ?>
            <!-- Hero Section avec photo -->
            <div class="profile-hero">
                <div class="photo-banner">
                    <div class="profile-photo-container">
                        <?php if (!empty($etudiant_data['photo']) && file_exists('../' . $etudiant_data['photo'])): ?>
                            <img src="../<?= htmlspecialchars($etudiant_data['photo']) ?>" 
                                 alt="Photo de profil" 
                                 class="profile-photo">
                        <?php else: ?>
                            <div class="photo-placeholder">👤</div>
                        <?php endif; ?>
                    </div>
                    <div class="student-identity">
                        <div class="student-name">
                            <?= htmlspecialchars($etudiant_data['prenom'] . ' ' . $etudiant_data['nom']) ?>
                        </div>
                        <div class="student-details">
                            <div class="detail-item">
                                <span>🆔</span>
                                <span>ID: <?= htmlspecialchars($etudiant_data['id']) ?></span>
                            </div>
                            <div class="detail-item">
                                <span>🌍</span>
                                <span><?= htmlspecialchars($etudiant_data['nationalite']) ?></span>
                            </div>
                            <div class="detail-item">
                                <span>🎂</span>
                                <span><?= date('d/m/Y', strtotime($etudiant_data['date_naissance'])) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sections d'informations -->
            <div class="info-sections">
                <!-- INFORMATIONS PERSONNELLES -->
                <div class="info-section personal">
                    <div class="section-header">
                        <div class="section-icon">👤</div>
                        <div>
                            <div class="section-title">Informations Personnelles</div>
                            <div class="section-subtitle">Identité et documents officiels</div>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nom complet</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['prenom'] . ' ' . $etudiant_data['nom']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Date de naissance</div>
                            <div class="info-value"><?= date('d/m/Y', strtotime($etudiant_data['date_naissance'])) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lieu de naissance</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['lieu_naissance']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Sexe</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['sexe']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Nationalité</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['nationalite']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Numéro CIN</div>
                            <div class="info-value highlight"><?= htmlspecialchars($etudiant_data['cin']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Date délivrance CIN</div>
                            <div class="info-value"><?= date('d/m/Y', strtotime($etudiant_data['date_delivrance_cin'])) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lieu délivrance CIN</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['lieu_delivrance_cin']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Situation matrimoniale</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['situation_matrimoniale']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Adresse permanente</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['adresse_permanente']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Adresse temporaire</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['adresse_temporaire']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Région</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['region']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Téléphone personnel</div>
                            <div class="info-value highlight"><?= htmlspecialchars($etudiant_data['telephone_personnel']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Téléphone secondaire</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['telephone_secondaire']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email personnel</div>
                            <div class="info-value highlight"><?= htmlspecialchars($etudiant_data['email_personnel']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email universitaire</div>
                            <div class="info-value highlight"><?= htmlspecialchars($etudiant_data['email_universitaire']) ?></div>
                        </div>
                    </div>
                </div>

                <!-- INFORMATIONS FAMILLE -->
                <div class="info-section family">
                    <div class="section-header">
                        <div class="section-icon">👨‍👩‍👧‍👦</div>
                        <div>
                            <div class="section-title">Informations Familiales</div>
                            <div class="section-subtitle">Parents et tuteur légal</div>
                        </div>
                    </div>

                    <!-- Père -->
                    <div class="family-subsection pere">
                        <div class="subsection-title">👨 Informations du Père</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Nom complet</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['nom_pere']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Profession</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['profession_pere']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Téléphone</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['telephone_pere']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['email_pere']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Statut</div>
                                <div class="info-value success"><?= htmlspecialchars($etudiant_data['statut_pere']) ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Mère -->
                    <div class="family-subsection mere">
                        <div class="subsection-title">👩 Informations de la Mère</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Nom complet</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['nom_mere']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Profession</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['profession_mere']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Téléphone</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['telephone_mere']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value"><?= !empty($etudiant_data['email_mere']) ? htmlspecialchars($etudiant_data['email_mere']) : '<span class="empty">Non renseigné</span>' ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Statut</div>
                                <div class="info-value success"><?= htmlspecialchars($etudiant_data['statut_mere']) ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Tuteur -->
                    <div class="family-subsection tuteur">
                        <div class="subsection-title">🤝 Tuteur / Responsable Légal</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Nom complet</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['nom_tuteur']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Lien de parenté</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['lien_parente']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Profession</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['profession_tuteur']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Téléphone</div>
                                <div class="info-value highlight"><?= htmlspecialchars($etudiant_data['telephone_tuteur']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['email_tuteur']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Adresse</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant_data['adresse_tuteur']) ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Contact d'urgence</div>
                                <div class="info-value warning"><?= htmlspecialchars($etudiant_data['contact_urgence']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INFORMATIONS ACADÉMIQUES -->
                <div class="info-section academic">
                    <div class="section-header">
                        <div class="section-icon">🎓</div>
                        <div>
                            <div class="section-title">Parcours Académique</div>
                            <div class="section-subtitle">Baccalauréat et études secondaires</div>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Établissement d'origine</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['etablissement_origine']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Ville du lycée</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['ville_lycee']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Série du Baccalauréat</div>
                            <div class="info-value highlight"><?= htmlspecialchars($etudiant_data['serie_bac']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Année d'obtention</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['annee_bac']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Mention obtenue</div>
                            <div class="info-value success"><?= htmlspecialchars($etudiant_data['mention_bac']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Note du BAC</div>
                            <div class="info-value highlight"><?= htmlspecialchars($etudiant_data['note_bac']) ?>/20</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Numéro du diplôme</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['numero_diplome_bac']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Centre d'examen</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['centre_examen']) ?></div>
                        </div>
                    </div>
                </div>

                <!-- INFORMATIONS MÉDICALES -->
                <div class="info-section medical">
                    <div class="section-header">
                        <div class="section-icon">🏥</div>
                        <div>
                            <div class="section-title">Informations Médicales</div>
                            <div class="section-subtitle">Santé et assurance maladie</div>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Groupe sanguin</div>
                            <div class="info-value highlight"><?= htmlspecialchars($etudiant_data['groupe_sanguin']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Facteur Rhésus</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['facteur_rhesus']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Allergies connues</div>
                            <div class="info-value warning"><?= htmlspecialchars($etudiant_data['allergies']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Maladies chroniques</div>
                            <div class="info-value success"><?= htmlspecialchars($etudiant_data['maladies_chroniques']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Handicaps</div>
                            <div class="info-value success"><?= htmlspecialchars($etudiant_data['handicaps']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Traitement médical</div>
                            <div class="info-value success"><?= htmlspecialchars($etudiant_data['traitement_medical']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Assurance maladie</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['assurance_maladie']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Numéro d'assurance</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['numero_assurance']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Médecin traitant</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['medecin_traitant']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Contact médical d'urgence</div>
                            <div class="info-value warning"><?= htmlspecialchars($etudiant_data['contact_medical_urgence']) ?></div>
                        </div>
                    </div>
                </div>

                <!-- INFORMATIONS FINANCIÈRES -->
                <div class="info-section financial">
                    <div class="section-header">
                        <div class="section-icon">💰</div>
                        <div>
                            <div class="section-title">Situation Financière</div>
                            <div class="section-subtitle">Frais de scolarité et bourses</div>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Statut des frais</div>
                            <div class="info-value success"><?= htmlspecialchars($etudiant_data['statut_frais']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Montant annuel</div>
                            <div class="info-value highlight"><?= htmlspecialchars($etudiant_data['montant_frais_annuels']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Mode de paiement</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['mode_paiement']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Échéancier</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['echeancier']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Bourse d'études</div>
                            <div class="info-value success"><?= htmlspecialchars($etudiant_data['bourse_etudes']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Type de bourse</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['type_bourse']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Montant de la bourse</div>
                            <div class="info-value highlight"><?= htmlspecialchars($etudiant_data['montant_bourse']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Organisme</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['organisme_bourse']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Aide financière</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['aide_financiere']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Situation familiale</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['situation_financiere']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Activité rémunérée</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['activite_remuneree']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Compte bancaire</div>
                            <div class="info-value"><?= htmlspecialchars($etudiant_data['compte_bancaire']) ?></div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Template si données non trouvées -->
            <div class="profile-hero">
                <div class="photo-banner">
                    <div class="profile-photo-container">
                        <div class="photo-placeholder">❌</div>
                    </div>
                    <div class="student-identity">
                        <div class="student-name">Données non disponibles</div>
                        <div class="student-details">
                            <div class="detail-item">
                                <span>⚠️</span>
                                <span>Erreur de chargement</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="no-data-message">
                <div class="no-data-icon">📋❌</div>
                <div class="no-data-text">Impossible de charger le profil</div>
                <div class="no-data-subtitle">
                    Les informations de votre profil ne peuvent pas être affichées pour le moment.
                    <br><br>
                    <strong>Causes possibles :</strong><br>
                    • Problème de connexion à la base de données<br>
                    • Données manquantes ou corrompues<br>
                    • Erreur système temporaire<br><br>
                    
                    <strong>Solutions :</strong><br>
                    • Actualisez la page<br>
                    • Déconnectez-vous puis reconnectez-vous<br>
                    • Contactez l'administration si le problème persiste<br><br>
                    
                    📧 Support : support@universite.ma<br>
                    📞 Assistance : +212 5 39 XX XX XX
                </div>
            </div>

            <!-- Template avec champs vides pour démonstration -->
            <div class="info-sections" style="opacity: 0.4;">
                <div class="info-section personal">
                    <div class="section-header">
                        <div class="section-icon">👤</div>
                        <div>
                            <div class="section-title">Informations Personnelles</div>
                            <div class="section-subtitle">Données non disponibles</div>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nom complet</div>
                            <div class="info-value empty">Non défini</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Date de naissance</div>
                            <div class="info-value empty">Non définie</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lieu de naissance</div>
                            <div class="info-value empty">Non défini</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Nationalité</div>
                            <div class="info-value empty">Non définie</div>
                        </div>
                    </div>
                </div>

                <div class="info-section family">
                    <div class="section-header">
                        <div class="section-icon">👨‍👩‍👧‍👦</div>
                        <div>
                            <div class="section-title">Informations Familiales</div>
                            <div class="section-subtitle">Données non disponibles</div>
                        </div>
                    </div>
                    <div class="family-subsection pere">
                        <div class="subsection-title">👨 Informations du Père</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Nom complet</div>
                                <div class="info-value empty">Non défini</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Profession</div>
                                <div class="info-value empty">Non définie</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info-section academic">
                    <div class="section-header">
                        <div class="section-icon">🎓</div>
                        <div>
                            <div class="section-title">Parcours Académique</div>
                            <div class="section-subtitle">Données non disponibles</div>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Série du Baccalauréat</div>
                            <div class="info-value empty">Non définie</div>
                        </div>
                    </div>
                </div>

                <div class="info-section medical">
                    <div class="section-header">
                        <div class="section-icon">🏥</div>
                        <div>
                            <div class="section-title">Informations Médicales</div>
                            <div class="section-subtitle">Données non disponibles</div>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Groupe sanguin</div>
                            <div class="info-value empty">Non défini</div>
                        </div>
                    </div>
                </div>

                <div class="info-section financial">
                    <div class="section-header">
                        <div class="section-icon">💰</div>
                        <div>
                            <div class="section-title">Situation Financière</div>
                            <div class="section-subtitle">Données non disponibles</div>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Statut des frais</div>
                            <div class="info-value empty">Non défini</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Animation d'entrée progressive
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('.info-section');
            sections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(40px)';
                
                setTimeout(() => {
                    section.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 150);
            });

            // Animation des sous-sections famille
            const familySubsections = document.querySelectorAll('.family-subsection');
            familySubsections.forEach((subsection, index) => {
                subsection.style.opacity = '0';
                subsection.style.transform = 'translateX(-20px)';
                
                setTimeout(() => {
                    subsection.style.transition = 'all 0.6s ease';
                    subsection.style.opacity = '1';
                    subsection.style.transform = 'translateX(0)';
                }, 1000 + (index * 200));
            });
        });

        // Effet de hover amélioré
        document.querySelectorAll('.info-section').forEach(section => {
            section.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
                this.style.boxShadow = '0 30px 80px rgba(0, 0, 0, 0.15)';
            });
            
            section.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = '0 20px 50px rgba(0, 0, 0, 0.1)';
            });
        });

        // Copie au clic pour les informations importantes
        document.querySelectorAll('.info-value.highlight').forEach(element => {
            element.style.cursor = 'pointer';
            element.title = 'Cliquer pour copier';
            
            element.addEventListener('click', function() {
                navigator.clipboard.writeText(this.textContent).then(() => {
                    // Animation de confirmation
                    const original = this.textContent;
                    this.textContent = '✓ Copié !';
                    this.style.color = '#4CAF50';
                    
                    setTimeout(() => {
                        this.textContent = original;
                        this.style.color = '#2196F3';
                    }, 1500);
                });
            });
        });
    </script>
</body>
</html>