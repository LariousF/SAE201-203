<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Matériel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reserv_mat.css">
</head>
<body>
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

    <body class="bg-light">
    <div class="container">
        <div class="bg-white rounded shadow p-4 my-4">
            <h1 class="text-center fw-bold mb-4">Réserver un matériel</h1>
            
            <!-- Barre de recherche -->
            <div class="d-flex justify-content-end mb-4">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" id="searchInput" placeholder="Rechercher...">
                    <span class="input-group-text">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                </div>
            </div>

            <!-- Grille d'inventaire -->
            <div class="row g-4" id="inventoryGrid">
                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="smartphone tablette" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-mobile-alt equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Smartphone/Tablette</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="projecteur" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-video equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Projecteur</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="manette jeu" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-gamepad equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Manette de jeu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="console jeu" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-gamepad equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Console de jeu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="caméra web webcam" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-secondary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-camera equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Caméra Web</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="disque dur externe" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-info rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-hdd equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Disque dur externe</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="trépied support" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-camera-retro equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Trépied</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="casque vr réalité virtuelle" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-vr-cardboard equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Casque VR</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="drone" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-helicopter equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Drone</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="support trépied" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-dark rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-video equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Support/Trépied</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="fond vert green screen" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-chalkboard equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Fond vert</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="casque audio écouteurs" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-secondary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-headphones equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Casque audio</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="ordinateur portable laptop" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-dark rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-laptop equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Ordinateur portable</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="écran moniteur" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-info rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-desktop equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Écran/Moniteur</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="équipement divers matériel" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-tools equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Équipement divers</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-outline-primary px-4 py-2">
                    Page Suivante
                    <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const searchInput = document.getElementById('searchInput');
        const itemContainers = document.querySelectorAll('.item-container');
        const itemCards = document.querySelectorAll('[data-item]');

        // Recherche
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

            // Message aucun résultat
            const visibleItems = document.querySelectorAll('.item-container:not(.d-none)');
            if (visibleItems.length === 0 && searchTerm !== '') {
                showNoResults();
            } else {
                hideNoResults();
            }
        });

        // Clics sur cartes
        itemCards.forEach(card => {
            card.addEventListener('click', function() {
                const itemName = this.querySelector('span').textContent;
                if (confirm(`Voulez-vous réserver : ${itemName} ?`)) {
                    alert(`Réservation confirmée pour : ${itemName}`);
                }
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
                <h5>Aucun équipement trouvé</h5>
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
</body>
</html>