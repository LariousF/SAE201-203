<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Matériel</title>
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
                                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                    <a href="adminboard.php" class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-person-fill"></i> Tableau de bord Admin
                                    </a>
                                </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </div>
</html>