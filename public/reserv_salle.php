<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Salles de Cours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reserv_salle.css">
</head>
<body>
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

    <body class="bg-light">
    <div class="container">
        <div class="bg-white rounded shadow p-4 my-4">
            <h1 class="text-center fw-bold mb-4">Réserver une salle de cours</h1>

            <div class="d-flex justify-content-end mb-4">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" id="searchInput" placeholder="Rechercher...">
                    <span class="input-group-text">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                </div>
            </div>

            <div class="row g-4" id="inventoryGrid">
            
                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 106 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle A4</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 106 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle B4</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 104 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 104</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 105 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 105</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 106 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 106</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 107 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 107</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 108 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-secondary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 108</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 109 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-info rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 109</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 110 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 110</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 111 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 111</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 112 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 112</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 113 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 113</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 114 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-secondary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 114</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 115 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-info rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 115</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 116 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 116</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 117 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 117</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 118 premier étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 118</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 204 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 204</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 205 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-secondary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 205</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 206 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-info rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 206</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 207 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 207</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 208 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 208</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 209 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 209</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 210 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 210</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 211 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-secondary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 211</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 212 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-info rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 212</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 213 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 213</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 214 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 214</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 215 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 215</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 216 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 216</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 217 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-secondary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 217</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 218 deuxième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-info rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 218</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 304 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 304</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 305 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 305</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 306 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 306</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 307 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 307</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 308 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-secondary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 308</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 309 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-info rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 309</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 310 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 310</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 311 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 311</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 312 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 312</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 313 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 313</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 314 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-secondary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 314</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 315 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-info rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 315</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 316 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 316</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 317 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 317</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="salle 318 troisième étage" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Salle 318</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-outline-primary px-4 py-2">
                    Page Suivante
                    <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="equipmentModal" tabindex="-1" aria-labelledby="equipmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="equipmentModalLabel">Détails de la salle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="equipmentImage" src="" alt="" class="img-fluid rounded mb-3" style="width: 100%; height: 250px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h4 id="equipmentName" class="mb-3">Nom de la salle</h4>
                            <p id="equipmentDescription" class="text-muted">Description de la salle...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" id="reserveButton">
                        <i class="bi bi-calendar-check"></i> Réserver cette salle
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <script>
        const searchInput = document.getElementById('searchInput');
        const itemContainers = document.querySelectorAll('.item-container');
        const itemCards = document.querySelectorAll('[data-item]');

        //Fonction pour generer automatiquement la description/image des salles
        function getEquipmentData(card) {
            const name = card.querySelector('span').textContent.trim();
            const floor = name.startsWith('Salle 1') ? 'premier' : name.startsWith('Salle 2') ? 'deuxième' : 'troisième';

            //Génèrer une description grace au nom et à l'étage
            const description = `${name} est une salle de cours située au ${floor} étage, disponible pour réservation. Idéale pour les cours magistraux, travaux dirigés ou réunions, elle est équipée pour répondre aux besoins académiques.`;

            // Générer une image basée sur l'étage ou un générique
            const imageMap = {
                'premier': 'https://images.unsplash.com/photo-1540546522-f6735e236319?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'deuxième': 'https://images.unsplash.com/photo-1610484738595-341e974e5088?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'troisième': 'https://plus.unsplash.com/photos/room-with-chairs-and-tables-rT36S_0dCxU?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            };

            let image = 'https://images.unsplash.com/photo-1579762715118-a6f17d16b17a?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'; // Image par défaut
            if (imageMap[floor]) {
                image = imageMap[floor];
            }

            return { name, description, image };
        }

        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();

            itemContainers.forEach(container => {
                const card = container.querySelector('[data-item]');
                const searchData = card.getAttribute('data-item').toLowerCase();
                const label = card.querySelector('span').textContent.toLowerCase();

                if (searchData.includes(searchTerm) || label.includes(searchTerm)) {
                    container.classList.remove('d-none');
                } else {
                    container.classList.add('d-none');
                }
            });

            const visibleItems = document.querySelectorAll('.item-container:not(.d-none)');
            if (visibleItems.length === 0 && searchTerm !== '') {
                showNoResults();
            } else {
                hideNoResults();
            }
        });

        itemCards.forEach(card => {
            card.addEventListener('click', function() {
                // Génère les données de la salle
                const equipment = getEquipmentData(this);

                document.getElementById('equipmentName').textContent = equipment.name;
                document.getElementById('equipmentDescription').textContent = equipment.description;
                document.getElementById('equipmentImage').src = equipment.image;
                document.getElementById('equipmentImage').alt = equipment.name;

                const reserveButton = document.getElementById('reserveButton');
                reserveButton.onclick = function() {
                    window.location.href = `calendrier.php?salle=${encodeURIComponent(equipment.name)}`;
                };

                const modal = new bootstrap.Modal(document.getElementById('equipmentModal'));
                modal.show();
            });

            card.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });

        function showNoResults() {
            hideNoResults();
            const noResultsDiv = document.createElement('div');
            noResultsDiv.id = 'noResults';
            noResultsDiv.className = 'col-12 text-center py-5 text-muted';
            noResultsDiv.innerHTML = `
                <i class="fas fa-search fa-3x mb-3"></i>
                <h5>Aucune salle trouvée</h5>
                <p>Essayez avec d'autres mots-clés</p>
            `;
            document.getElementById('inventoryGrid').appendChild(noResultsDiv);
        }

        function hideNoResults() {
            const existing = document.getElementById('noResults');
            if (existing) existing.remove();
        }

        document.querySelector('.btn-outline-primary').addEventListener('click', function() {
            alert('Fonctionnalité de pagination à implémenter');
        });
    </script>
</body>
</html>
