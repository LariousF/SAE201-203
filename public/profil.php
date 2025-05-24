<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définir le chemin absolu vers le dossier src
define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/src/model/db_connect.php';
require_once ROOT_PATH . '/src/model/authentification.php';

// Débogage - Afficher les informations de session
error_log('Session ID: ' . session_id());
error_log('Session data: ' . print_r($_SESSION, true));

// Vérifier si l'utilisateur est connecté
if (!$auth->isLoggedIn()) {
    $message = "Vous devez être connecté pour accéder à cette page.";
    $message_type = 'danger';
} else {
    // Récupérer les informations de l'utilisateur
    $user = $auth->getCurrentUser();
    if (!$user) {
        $message = "Erreur lors de la récupération des informations utilisateur.";
        $message_type = 'danger';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUT Inventaires - Profil</title>
    <meta name="description" content="Gérez facilement les salles, le matériel VR et les autres ressources de l'IUT.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="bg-light min-vh-100 d-flex flex-column">
        <header class="bg-white border-bottom">
            <nav class="container navbar navbar-expand-lg navbar-light py-4">
                <div class="container-fluid px-0">
                    <a class="navbar-logo me-4" href="index.php">
                        <img src="images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel" class="img-fluid" style="max-width: 200px; height: auto;">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto align-items-center">
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Administrateur'): ?>
                                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                    <a href="adminboard.php" class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-gear-fill"></i> Tableau de bord Admin
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                <a href="deconnexion.php" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-box-arrow-right"></i> DÉCONNEXION
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="flex-grow-1">
            <?php if (isset($message)): ?>
                <div class="container mt-3">
                    <div class="alert alert-<?php echo $message_type; ?>" role="alert">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($auth->isLoggedIn() && $user): ?>
                <section class="bg-iut-blue text-white py-4">
                    <div class="container py-3">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center">
                                <div class="profile-circle mb-3">
                                    <img src="images/default-avatar.png" alt="Avatar" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-9 text-md-start text-center">
                                <h2 class="mb-1"><?php echo htmlspecialchars($user['Prenom']); ?></h2>
                                <h3 class="h4 mb-0"><?php echo htmlspecialchars($user['Nom']); ?></h3>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="info-section">
                                    <h4 class="info-section-title">Informations Générales</h4>
                                    <div class="info-grid">
                                        <div class="info-box">
                                            <div class="mb-3">
                                                <strong>Adresse mail</strong><br>
                                                <a href="mailto:<?php echo htmlspecialchars($user['Email']); ?>" class="text-decoration-none">
                                                    <?php echo htmlspecialchars($user['Email']); ?>
                                                </a>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Identifiant</strong><br>
                                                <?php echo htmlspecialchars($user['Pseudo']); ?>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Rôle</strong><br>
                                                <span class="status-badge <?php 
                                                    echo strtolower($user['Role']) === 'etudiant' ? 'student' : 
                                                        (strtolower($user['Role']) === 'enseignant' ? 'teacher' : 'admin'); 
                                                ?>">
                                                    <?php echo htmlspecialchars($user['Role']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($user['Role'] === 'Etudiant'): ?>
                                <div class="info-section">
                                    <h4 class="info-section-title">Informations Étudiant</h4>
                                    <div class="info-grid">
                                        <div class="info-box">
                                            <div class="mb-3">
                                                <strong>Numéro étudiant</strong><br>
                                                <?php echo htmlspecialchars($user['Numero_etudiant']); ?>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Promotion</strong><br>
                                                <?php echo htmlspecialchars($user['Promotion']); ?>
                                            </div>
                                            <?php if (isset($user['TD'])): ?>
                                            <div class="mb-3">
                                                <strong>Groupe TD</strong><br>
                                                <?php echo htmlspecialchars($user['TD']); ?>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (isset($user['TP'])): ?>
                                            <div class="mb-3">
                                                <strong>Groupe TP</strong><br>
                                                <?php echo htmlspecialchars($user['TP']); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php elseif ($user['Role'] === 'Enseignant'): ?>
                                <div class="info-section">
                                    <h4 class="info-section-title">Informations Enseignant</h4>
                                    <div class="info-grid">
                                        <div class="info-box">
                                            <div class="mb-3">
                                                <strong>Qualification</strong><br>
                                                <?php echo htmlspecialchars($user['Qualification']); ?>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Fonction</strong><br>
                                                <?php echo htmlspecialchars($user['Fonction']); ?>
                                            </div>
                                            <?php if (isset($user['Bureau'])): ?>
                                            <div class="mb-3">
                                                <strong>Bureau</strong><br>
                                                <?php echo htmlspecialchars($user['Bureau']); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php elseif ($user['Role'] === 'Administrateur'): ?>
                                <div class="info-section">
                                    <h4 class="info-section-title">Informations Administrateur</h4>
                                    <div class="info-grid">
                                        <div class="info-box">
                                            <?php if (isset($user['Bureau'])): ?>
                                            <div class="mb-3">
                                                <strong>Bureau</strong><br>
                                                <?php echo htmlspecialchars($user['Bureau']); ?>
                                            </div>
                                            <?php endif; ?>
                                            <div class="mb-3">
                                                <strong>Responsabilités</strong><br>
                                                Gestion des utilisateurs<br>
                                                Gestion du matériel<br>
                                                Validation des réservations
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </main>

        <footer class="bg-white pt-5 pb-4">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <h5>Qui sommes nous ?</h5>
                        <p>Université Gustave Eiffel<br>
                        Centre d'Innovation Pédagogique et Numérique (CIPEN)</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Support</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-decoration-none text-dark">FAQs</a></li>
                            <li><a href="#" class="text-decoration-none text-dark">Privacy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Restons en contact</h5>
                        <p>Tel: 01 60 95 72 54<br>
                        Lundi - Vendredi: 9h - 17h<br>
                        Email: cipen@univ-eiffel.fr</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Suivez nous</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-dark"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-dark"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-dark"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>