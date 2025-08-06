-- Migration de SQLite vers MySQL pour LYCEE MICHEL ALLAIRE
-- À exécuter dans phpMyAdmin d'InfinityFree

-- Création de la base de données (si pas déjà fait)
CREATE DATABASE IF NOT EXISTS `if0_39632285_lycee_allaire`
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `if0_39632285_lycee_allaire`;



-- la table avec les modifications
CREATE TABLE IF NOT EXISTS `etudiants` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `student_id` VARCHAR(50),
    `nom` VARCHAR(50) NOT NULL,
    `prenom` VARCHAR(50) NOT NULL,
    `classe` VARCHAR(20),
    `email_personnel` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `date_naissance` DATE,
    `lieu_naissance` VARCHAR(100),
    `sexe` ENUM('M', 'F', 'Autre'),
    `nationalite` VARCHAR(50),
    `cin` VARCHAR(20) UNIQUE,
    `date_delivrance_cin` DATE,
    `lieu_delivrance_cin` VARCHAR(100),
    `situation_matrimoniale` VARCHAR(50),
    `adresse_permanente` TEXT,
    `adresse_temporaire` TEXT,
    `region` VARCHAR(50),
    `telephone_personnel` VARCHAR(20),
    `telephone_secondaire` VARCHAR(20),
    `photo` VARCHAR(255),
    `statut` ENUM('actif', 'inactif', 'suspendu') DEFAULT 'actif',
    `nom_pere` VARCHAR(100),
    `profession_pere` VARCHAR(100),
    `telephone_pere` VARCHAR(20),
    `email_pere` VARCHAR(100),
    `statut_pere` VARCHAR(50),
    `nom_mere` VARCHAR(100),
    `profession_mere` VARCHAR(100),
    `telephone_mere` VARCHAR(20),
    `email_mere` VARCHAR(100),
    `statut_mere` VARCHAR(50),
    `nom_tuteur` VARCHAR(100),
    `lien_parente` VARCHAR(50),
    `profession_tuteur` VARCHAR(100),
    `telephone_tuteur` VARCHAR(20),
    `email_tuteur` VARCHAR(100),
    `adresse_tuteur` TEXT,
    `contact_urgence` VARCHAR(20),
    `etablissement_origine` VARCHAR(100),
    `adresse_etablissement_origine` VARCHAR(50),
    `bac_statut` ENUM('non_passé', 'en_cours', 'réussi', 'échoué') DEFAULT 'non_passé',
    `serie_bac` VARCHAR(50),
    `annee_bac` YEAR,
    `mention_bac` VARCHAR(50),
    `note_bac` DECIMAL(4,2),
    `numero_diplome_bac` VARCHAR(50),
    `centre_examen` VARCHAR(100),
    `bac_attempts` INT DEFAULT 0,
    `groupe_sanguin` VARCHAR(10),
    `facteur_rhesus` VARCHAR(10),
    `allergies` TEXT,
    `maladies_chroniques` TEXT,
    `handicaps` TEXT,
    `traitement_medical` TEXT,
    `assurance_maladie` VARCHAR(50),
    `numero_assurance` VARCHAR(50),
    `medecin_traitant` VARCHAR(100),
    `contact_medical_urgence` VARCHAR(20),
    `statut_frais` VARCHAR(50),
    `montant_frais_annuels` DECIMAL(10,2),
    `mode_paiement` VARCHAR(50),
    `echeancier` TEXT,
    `bourse_etudes` VARCHAR(50),
    `type_bourse` VARCHAR(50),
    `montant_bourse` DECIMAL(10,2),
    `organisme_bourse` VARCHAR(100),
    `aide_financiere` VARCHAR(50),
    `situation_financiere` VARCHAR(50),
    `activite_remuneree` VARCHAR(50),
    `compte_bancaire` VARCHAR(50),
    `date_creation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `date_modification` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_email_personnel` (`email_personnel`),
    INDEX `idx_cin` (`cin`),
    INDEX `idx_student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- Table des matières
CREATE TABLE IF NOT EXISTS `matieres` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nom_matiere` VARCHAR(100) NOT NULL,
    `code_matiere` VARCHAR(20) UNIQUE NOT NULL,
    `coefficient` DECIMAL(3,1) NOT NULL DEFAULT 1.0,
    `description` TEXT NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_code_matiere` (`code_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des notes (modifiée pour supprimer bulletin_id et ajouter etudiant_id)
CREATE TABLE IF NOT EXISTS `notes` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `etudiant_id` INT(11) NOT NULL,
    `matiere_id` INT(11) NOT NULL,
    `nom_matiere` VARCHAR(100) NOT NULL,
    `note` DECIMAL(4,2) NULL,
    `note_sur` DECIMAL(4,2) DEFAULT 20.00,
    `type_evaluation` ENUM('devoir', 'composition') NOT NULL,
    `date_evaluation` DATE NULL,
    `annee_scolaire` VARCHAR(9) NOT NULL,
    `periode` ENUM('p1', 'p2','p3') NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`matiere_id`) REFERENCES `matieres`(`id`) ON DELETE CASCADE,
    INDEX `idx_etudiant_matiere` (`etudiant_id`, `matiere_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des sessions de connexion (sécurité)
CREATE TABLE IF NOT EXISTS `sessions_log` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `etudiant_id` INT(11) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `user_agent` TEXT NULL,
    `date_connexion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `date_deconnexion` TIMESTAMP NULL,
    `statut` ENUM('active', 'expired', 'logout') DEFAULT 'active',
    PRIMARY KEY (`id`),
    FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants`(`id`) ON DELETE CASCADE,
    INDEX `idx_etudiant_date` (`etudiant_id`, `date_connexion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- Créer une table simplifiée pour l'emploi du temps
CREATE TABLE emploi_du_temps (
    id_emploi INT PRIMARY KEY AUTO_INCREMENT,
    id_classe INT NOT NULL,
    fichier VARCHAR(255) NOT NULL, -- Chemin vers l'image ou PDF (ex: 'Uploads/emplois/emploi_premiere_a.jpg')
    description TEXT, -- Description optionnelle de l'emploi du temps
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_classe) REFERENCES classes(id_classe) ON DELETE CASCADE,
    UNIQUE (id_classe) -- Une seule image par classe
);

-- Index pour optimiser les recherches par classe
CREATE INDEX idx_classe ON emploi_du_temps(id_classe);

INSERT INTO emploi_du_temps (id_classe, fichier, description)
VALUES (
    1, 
    'Uploads/emplois/emploi_10eL.jpg', 
    'Emploi du temps pour la classe 10eL (Lettres) - Année scolaire 2025-2026'
);

-- Exemple 2 : Emploi du temps pour la classe TSE (id_classe = 2)
INSERT INTO emploi_du_temps (id_classe, fichier, description)
VALUES (
    2, 
    'Uploads/emplois/emploi_TSE.pdf', 
    'Emploi du temps pour la classe TSE (Sciences Économiques) - Année scolaire 2025-2026'
);

-- Exemple 3 : Emploi du temps pour la classe TSS (id_classe = 3)
INSERT INTO emploi_du_temps (id_classe, fichier, description)
VALUES (
    3, 
    'Uploads/emplois/emploi_TSS.jpg', 
    'Emploi du temps pour la classe TSS - Année scolaire 2025-2026'
);


-- Créer la table inscriptions
CREATE TABLE inscriptions (
    id_etudiant INT NOT NULL,
    id_classe INT NOT NULL,
    date_inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    annee_scolaire VARCHAR(9) NOT NULL, -- Ex: "2025-2026"
    statut ENUM('Actif', 'Terminé', 'Suspendu') DEFAULT 'Actif',
    PRIMARY KEY (id_etudiant, id_classe, annee_scolaire),
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant) ON DELETE CASCADE,
    FOREIGN KEY (id_classe) REFERENCES classes(id_classe) ON DELETE CASCADE
);

-- Index pour optimiser les recherches
CREATE INDEX idx_etudiant_annee ON inscriptions(id_etudiant, annee_scolaire);
CREATE INDEX idx_classe_annee ON inscriptions(id_classe, annee_scolaire);



CREATE TABLE classes (
    id_classe INT PRIMARY KEY AUTO_INCREMENT,
    nom_classe VARCHAR(50) NOT NULL
);

-- Exemple d'insertions pour des classes maliennes
INSERT INTO inscriptions (id_etudiant, id_classe, date_inscription, annee_scolaire, statut)
VALUES 
    (1, 1, '2025-08-01 09:00:00', '2025-2026', 'Actif'), -- Étudiant 1 en 10eL
    (2, 2, '2025-08-01 09:30:00', '2025-2026', 'Actif'), -- Étudiant 2 en TSE
    (3, 3, '2025-08-02 10:00:00', '2025-2026', 'Actif'); -- Étudiant 3 en TSM


-- Insertion des matières de base
INSERT INTO `matieres` (`nom_matiere`, `code_matiere`, `coefficient`) VALUES
('Mathématiques', 'MATH', 4.0),
('Physique-Chimie', 'PC', 3.0),
('Sciences de la Vie et de la Terre', 'SVT', 2.0),
('Français', 'FR', 3.0),
('Anglais', 'ANG', 2.0),
('Histoire-Géographie', 'HG', 2.0),
('Philosophie', 'PHILO', 2.0),
('Éducation Physique et Sportive', 'EPS', 1.0),
('Informatique', 'INFO', 2.0),
('Économie', 'ECO', 3.0);

-- Insertion d'un étudiant de test
INSERT INTO `etudiants` (
    `nom`, `prenom`, `email_personnel`, `password`, `date_naissance`, `lieu_naissance`, `sexe`, `nationalite`, 
    `cin`, `date_delivrance_cin`, `lieu_delivrance_cin`, `situation_matrimoniale`, `adresse_permanente`, 
    `adresse_temporaire`, `region`, `telephone_personnel`, `telephone_secondaire`, `photo`, `statut`, 
    `nom_pere`, `profession_pere`, `telephone_pere`, `email_pere`, `statut_pere`, 
    `nom_mere`, `profession_mere`, `telephone_mere`, `email_mere`, `statut_mere`, 
    `nom_tuteur`, `lien_parente`, `profession_tuteur`, `telephone_tuteur`, `email_tuteur`, `adresse_tuteur`, `contact_urgence`, 
    `etablissement_origine`, `ville_lycee`, `serie_bac`, `annee_bac`, `mention_bac`, `note_bac`, `numero_diplome_bac`, `centre_examen`, 
    `bac_statut`, `bac_attempts`, 
    `groupe_sanguin`, `facteur_rhesus`, `allergies`, `maladies_chroniques`, `handicaps`, `traitement_medical`, 
    `assurance_maladie`, `numero_assurance`, `medecin_traitant`, `contact_medical_urgence`, 
    `statut_frais`, `montant_frais_annuels`, `mode_paiement`, `echeancier`, `bourse_etudes`, `type_bourse`, 
    `montant_bourse`, `organisme_bourse`, `aide_financiere`, `situation_financiere`, `activite_remuneree`, `compte_bancaire`
) VALUES (
    'Dupont', 'Marie', 'marie.dupont@example.com', '$2y$10$W7z8X9y0z1A2B3C4D5E6F7G8H9I0J1K2L3M4N5O6P7Q8R9S0T1U2', 
    '2007-03-15', 'Paris', 'F', 'Française', 
    '123456789012', '2023-06-01', 'Paris', 'Célibataire', 
    '12 Rue de la Paix, 75001 Paris', '45 Avenue des Champs-Élysées, 75008 Paris', 'Île-de-France', 
    '0601234567', NULL, 'photos/marie_dupont.jpg', 'actif', 
    'Jean Dupont', 'Ingénieur', '0612345678', 'jean.dupont@example.com', 'Vivant', 
    'Claire Dupont', 'Enseignante', '0623456789', NULL, 'Vivant', 
    'Paul Martin', 'Oncle', 'Commerçant', '0634567890', 'paul.martin@example.com', 
    '78 Boulevard Saint-Germain, 75005 Paris', '0634567890', 
    'Lycée Louis-le-Grand', 'Paris', 'S', NULL, NULL, NULL, NULL, NULL, 
    'en_cours', 0, 
    'A+', 'Positif', 'Aucune', 'Aucune', 'Aucun', 'Aucun', 
    'Mutuelle Étudiante', '987654321', 'Dr. Sophie Laurent', '0645678901', 
    'Payé', 1500.00, 'Virement bancaire', 'Mensuel', 'Oui', 'Mérite', 
    5000.00, 'Éducation Nationale', 'Non', 'Stable', 'Non', 'FR7612345678901234567890123'
);



-- Optimisation des performances
OPTIMIZE TABLE `etudiants`;
OPTIMIZE TABLE `matieres`;
OPTIMIZE TABLE `notes`;
OPTIMIZE TABLE `sessions_log`;