<?php
require_once 'src/config/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUT Inventaires - Accueil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: sans-serif;
        }
        .category-card {
            transition: transform 0.2s ease-in-out;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .category-card:hover {
            transform: translateY(-4px);
        }
        .category-card .card-icon {
            font-size: 3rem;
            color: #6c757d;
        }
        .navbar-logo img {
            max-height: 35px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <header class="bg-white border-bottom">
        <nav class="container navbar navbar-expand-lg navbar-light py-3">
            <div class="container-fluid px-0">
                <a class="navbar-logo me-4" href="#">
                    <img src="https://elearning.univ-eiffel.fr/pluginfile.php/1/theme_boost_union/logo/0x200/1742812575/logo_univ_gustave_eiffel_rvb.png" alt="Logo Université Gustave Eiffel" class="img-fluid">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                PROFIL
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        <section class="bg-dark text-white py-5">
            <div class="container text-center py-4">
                <h1 class="h2 mb-3">Gestion des inventaires de l'IUT</h1>
                <p class="lead mb-0">
                    Gérez facilement les salles, le matériel VR et les autres ressources de l'IUT.
                </p>
            </div>
        </section>

        <section class="py-5">
            <div class="container text-center">
                 <div class="row justify-content-center g-4 pt-4"> <div class="col-12 col-sm-6 col-md-4">
                        <a href="#" class="card category-card h-100 border">
                            <div class="card-body text-center p-4">
                                 <i class="bi bi-door-open card-icon mb-3"></i>
                                <h3 class="card-title h5">Salles</h3>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                         <a href="#" class="card category-card h-100 border">
                             <div class="card-body text-center p-4">
                                 <i class="bi bi-headset-vr card-icon mb-3"></i>
                                <h3 class="card-title h5">Matériel VR</h3>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="#" class="card category-card h-100 border">
                             <div class="card-body text-center p-4">
                                 <i class="bi bi-box-seam card-icon mb-3"></i>
                                <h3 class="card-title h5">Matériaux</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

     </body>
</html>