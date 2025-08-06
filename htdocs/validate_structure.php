<?php
/**
 * Script de validation de la nouvelle structure
 * LYCEE MICHEL ALLAIRE - InfinityFree
 */

echo "<h1>Validation de la Structure InfinityFree</h1>";
echo "<style>body{font-family:Arial,sans-serif;margin:20px;} .success{color:green;} .error{color:red;} .warning{color:orange;}</style>";

$errors = [];
$warnings = [];
$success = [];

// 1. Vérifier la structure des dossiers
$required_dirs = [
    'assets/css',
    'assets/js', 
    'assets/images/gallery',
    'assets/images/presentation',
    'assets/images/students',
    'students/pages',
    'students/uploads/documents',
    'resources/pdfs',
    'resources/documents',
    'config',
    'includes'
];

echo "<h2>1. Vérification de la structure des dossiers</h2>";
foreach ($required_dirs as $dir) {
    if (is_dir($dir)) {
        echo "<div class='success'>✓ Dossier '$dir' existe</div>";
        $success[] = "Dossier $dir OK";
    } else {
        echo "<div class='error'>✗ Dossier '$dir' manquant</div>";
        $errors[] = "Dossier $dir manquant";
    }
}

// 2. Vérifier les fichiers essentiels
$required_files = [
    'index.html' => 'Page d\'accueil',
    'assets/css/style.css' => 'CSS principal',
    'assets/js/script.js' => 'JavaScript principal',
    'students/login.html' => 'Page de connexion étudiants',
    'students/login.php' => 'Script de connexion',
    'config/database.php' => 'Configuration base de données',
    'config/config.php' => 'Configuration générale',
    '.htaccess' => 'Protection principale',
    'config/.htaccess' => 'Protection config',
    'students/uploads/.htaccess' => 'Protection uploads'
];

echo "<h2>2. Vérification des fichiers essentiels</h2>";
foreach ($required_files as $file => $description) {
    if (file_exists($file)) {
        echo "<div class='success'>✓ $description ($file)</div>";
        $success[] = "$description OK";
    } else {
        echo "<div class='error'>✗ $description ($file) manquant</div>";
        $errors[] = "$description manquant";
    }
}

// 3. Vérifier les images de la galerie
echo "<h2>3. Vérification des images de galerie</h2>";
$gallery_images = glob('assets/images/gallery/school-life-*.jpg');
if (count($gallery_images) >= 8) {
    echo "<div class='success'>✓ " . count($gallery_images) . " images de galerie trouvées</div>";
    $success[] = "Images de galerie OK";
} else {
    echo "<div class='warning'>⚠ Seulement " . count($gallery_images) . " images de galerie (8 attendues)</div>";
    $warnings[] = "Images de galerie incomplètes";
}

// 4. Vérifier les images de présentation
echo "<h2>4. Vérification des images de présentation</h2>";
$presentation_images = ['lycee-facade.jpg', 'proviseur.jpg'];
foreach ($presentation_images as $img) {
    $path = "assets/images/presentation/$img";
    if (file_exists($path)) {
        echo "<div class='success'>✓ Image $img trouvée</div>";
        $success[] = "Image $img OK";
    } else {
        echo "<div class='error'>✗ Image $img manquante</div>";
        $errors[] = "Image $img manquante";
    }
}

// 5. Vérifier les ressources PDF
echo "<h2>5. Vérification des ressources PDF</h2>";
$pdf_files = glob('resources/pdfs/*.pdf');
if (count($pdf_files) > 0) {
    echo "<div class='success'>✓ " . count($pdf_files) . " fichiers PDF trouvés</div>";
    $success[] = "Ressources PDF OK";
    foreach ($pdf_files as $pdf) {
        echo "<div style='margin-left:20px;'>- " . basename($pdf) . "</div>";
    }
} else {
    echo "<div class='warning'>⚠ Aucun fichier PDF trouvé dans resources/pdfs/</div>";
    $warnings[] = "Ressources PDF manquantes";
}

// 6. Tester la configuration de base de données
echo "<h2>6. Test de configuration de base de données</h2>";
try {
    if (file_exists('config/database.php')) {
        $config_content = file_get_contents('config/database.php');
        if (strpos($config_content, 'if0_XXXXXXX') !== false) {
            echo "<div class='warning'>⚠ Configuration DB contient encore les placeholders (normal avant déploiement)</div>";
            $warnings[] = "Configuration DB à personnaliser";
        } else {
            echo "<div class='success'>✓ Configuration DB semble personnalisée</div>";
            $success[] = "Configuration DB OK";
        }
    }
} catch (Exception $e) {
    echo "<div class='error'>✗ Erreur lors du test de configuration DB: " . $e->getMessage() . "</div>";
    $errors[] = "Erreur configuration DB";
}

// 7. Vérifier les permissions (approximatif)
echo "<h2>7. Vérification des permissions</h2>";
$writable_dirs = ['students/uploads/documents', 'resources'];
foreach ($writable_dirs as $dir) {
    if (is_writable($dir)) {
        echo "<div class='success'>✓ Dossier '$dir' accessible en écriture</div>";
        $success[] = "Permissions $dir OK";
    } else {
        echo "<div class='warning'>⚠ Dossier '$dir' peut ne pas être accessible en écriture</div>";
        $warnings[] = "Permissions $dir à vérifier";
    }
}

// 8. Résumé final
echo "<h2>8. Résumé de validation</h2>";
echo "<div style='background:#f0f0f0;padding:15px;border-radius:5px;'>";
echo "<strong>Succès:</strong> " . count($success) . "<br>";
echo "<strong>Avertissements:</strong> " . count($warnings) . "<br>";
echo "<strong>Erreurs:</strong> " . count($errors) . "<br><br>";

if (count($errors) == 0) {
    echo "<div class='success'><strong>🎉 Structure validée avec succès !</strong></div>";
    echo "<p>La structure est prête pour le déploiement sur InfinityFree.</p>";
} else {
    echo "<div class='error'><strong>❌ Des erreurs doivent être corrigées avant le déploiement.</strong></div>";
}

if (count($warnings) > 0) {
    echo "<div class='warning'><strong>⚠ Points d'attention à vérifier :</strong></div>";
    foreach ($warnings as $warning) {
        echo "<div style='margin-left:20px;'>- $warning</div>";
    }
}
echo "</div>";

// 9. Instructions suivantes
echo "<h2>9. Prochaines étapes</h2>";
echo "<ol>";
echo "<li>Corriger les erreurs identifiées ci-dessus</li>";
echo "<li>Personnaliser la configuration de base de données dans config/database.php</li>";
echo "<li>Tester localement avec un serveur web (XAMPP/WAMP)</li>";
echo "<li>Uploader sur InfinityFree via FTP</li>";
echo "<li>Exécuter le script migration_mysql.sql dans phpMyAdmin</li>";
echo "<li>Tester le site en ligne</li>";
echo "</ol>";

echo "<hr>";
echo "<p><em>Script de validation généré le " . date('Y-m-d H:i:s') . "</em></p>";
?>