<?php
require_once '../src/model/db_connect.php';
require_once '../src/model/authentification.php';
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
                    <a class="navbar-logo me-4" href="accueil.php">
                        <img src="images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel" class="img-fluid" style="max-width: 200px; height: auto;">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto align-items-center">
                            <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                <a href="profil.php" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-person-fill"></i> PROFIL
                                </a>
                            </li>
                            <?php if ($userRole === 'Admin'): ?>
                                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                    <a href="adminboard.php" class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-person-fill"></i> Tableau de bord Admin
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
    </header>

    <main class="flex-grow-1">
            <section class="bg-iut-blue text-white py-4">
                <div class="container py-3">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <div class="profile-circle mb-3">
                                <img src="#" alt="Avatar" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-9 text-md-start text-center">
                            <h2 class="mb-1">Prenom</h2>
                            <h3 class="h4 mb-0">Nom</h3>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="info-box">
                                <div class="mb-3">
                                    <strong>Adresse mail</strong><br>
                                    <a href="mailto:#" class="text-decoration-none">#</a>
                                </div>
                                <div class="mb-3">
                                    <strong>Identifiant</strong><br>
                                    #
                                </div>
                                <div class="mb-3">
                                    <strong>Adresse postale</strong><br>
                                    #
                                </div>
                                <div class="mb-3">
                                    <strong>Rôle</strong><br>
                                    #
                                </div>
                            </div>
                        </div>
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
</body>
</html>