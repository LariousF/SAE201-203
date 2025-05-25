<?php
require_once '../src/model/db_connect.php';
require_once '../src/model/authentification.php';

$auth = new Authentification($connexion);
$isLoggedIn = $auth->isLoggedIn();
$isAdmin = $isLoggedIn && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Administrateur';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUT Reservation - Accueil</title>
    <meta name="description" content="Réservez facilement une salle, du matériel ou une autre ressource de l'IUT.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css");
    </style>
</head>
<body>
    <div class="bg-light">
        <header class="bg-white border-bottom">
            <nav class="container navbar navbar-expand-lg navbar-light py-4">
                <div class="container-fluid px-0">
                    <a class="navbar-logo me-4" href="index.php">
                        <img src="images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel" class="img-fluid" style="max-width: 200px; height: auto;">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto align-items-center">
                            <?php if ($isLoggedIn): ?>
                                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                    <a href="profil.php" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-person-fill"></i> PROFIL
                                    </a>
                                </li>
                                <?php if ($isAdmin): ?>
                                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                        <a href="adminboard.php" class="btn btn-outline-warning btn-sm">
                                            <i class="bi bi-gear-fill"></i> Tableau de bord Admin
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                    <a href="deconnexion.php" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                    <a href="connexion.php" class="btn btn-primary btn-sm">
                                        <i class="bi bi-box-arrow-in-right"></i> Connexion
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="flex-grow-1">
            <section class="banner text-white py-5">
                <div class="container text-center py-4">
                    <h1 class="h2 mb-3">Plateforme de réservation de l'IUT</h1>
                    <p class="lead mb-0">
                        Réservez facilement une salle, du matériel ou une autre ressource de l'IUT.
                    </p>
                </div>
            </section>

            <section class="py-5">
                <div class="container text-center">
                    <div class="row justify-content-center g-4 pt-4">
                        <div class="col-12 col-sm-6 col-md-4">
                            <a href="reserv_salle.php" class="card category-card h-100 border">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-door-open-fill card-icon mb-3"></i>
                                    <h3 class="card-title h5">Salles</h3>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <a href="reserv_mat_vr.php" class="card category-card h-100 border">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-headset-vr card-icon mb-3"></i>
                                    <h3 class="card-title h5">Matériel VR</h3>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <a href="reserv_mat.php" class="card category-card h-100 border">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-box-seam-fill card-icon mb-3"></i>
                                    <h3 class="card-title h5">Matériel (Général)</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <?php if ($isLoggedIn): ?>
            <section class="py-5 bg-white">
                <div class="container">
                    <h2 class="text-center mb-4">Mes Réservations</h2>
                    <div class="card">
                        <div class="card-header bg-iut-blue text-white">
                            <h5 class="card-title mb-0">État de mes demandes</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Ressource</th>
                                            <th>Date début</th>
                                            <th>Date fin</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="reservationsTableBody">
                                        <!-- Le contenu sera chargé dynamiquement par JavaScript -->
                                    </tbody>
                                </table>
                            </div>
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
                            <a href="https://www.facebook.com/UniversiteGustaveEiffel/" class="text-dark" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
                            <a href="https://bsky.app/profile/univeiffel.bsky.social" class="text-dark" target="_blank" rel="noopener noreferrer"><i class="bi bi-bluesky"></i></a>
                            <a href="https://www.linkedin.com/company/iut-de-marne-la-vallee/" class="text-dark" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php if ($isLoggedIn): ?>
    <script src="js/reservations.js"></script>
    <?php endif; ?>
</body>
</html>
