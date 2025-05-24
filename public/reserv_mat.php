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

    <!-- Code pour description des matériels -->
    <div class="modal fade" id="equipmentModal" tabindex="-1" aria-labelledby="equipmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="equipmentModalLabel">Détails de l'équipement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="equipmentImage" src="" alt="" class="img-fluid rounded mb-3" style="width: 100%; height: 250px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h4 id="equipmentName" class="mb-3">Nom de l'équipement</h4>
                            <p id="equipmentDescription" class="text-muted">Description de l'équipement...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" id="reserveButton">
                        <i class="bi bi-calendar-check"></i> Réserver cet équipement
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

        // Fonction pour générer automatiquement les données d'équipement
        function getEquipmentData(card) {
            const name = card.querySelector('span').textContent.trim();
            const icon = card.querySelector('i').className;
            
            // Générer une description générique basée sur le nom
            const description = `${name} disponible pour réservation. Matériel de qualité professionnelle adapté aux besoins éducatifs et de recherche de l'université.`;
            
            // Générer une image par défaut basée sur l'icône
            const imageMap = {
                'fa-mobile-alt': 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&h=300&fit=crop',
                'fa-video': 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop',
                'fa-gamepad': 'https://images.unsplash.com/photo-1556438064-2d7646166914?w=400&h=300&fit=crop',
                'fa-camera': 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=400&h=300&fit=crop',
                'fa-hdd': 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=400&h=300&fit=crop',
                'fa-camera-retro': 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=400&h=300&fit=crop',
                'fa-vr-cardboard': 'https://images.unsplash.com/photo-1593508512255-86ab42a8e620?w=400&h=300&fit=crop',
                'fa-helicopter': 'https://images.unsplash.com/photo-1473968512647-3e447244af8f?w=400&h=300&fit=crop',
                'fa-chalkboard': 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop',
                'fa-headphones': 'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=400&h=300&fit=crop',
                'fa-laptop': 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop',
                'fa-desktop': 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=400&h=300&fit=crop',
                'fa-tools': 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400&h=300&fit=crop'
            };
            
            // Trouver l'icône correspondante
            let image = 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400&h=300&fit=crop'; // Image par défaut
            for (const iconClass in imageMap) {
                if (icon.includes(iconClass)) {
                    image = imageMap[iconClass];
                    break;
                }
            }
            
            return { name, description, image };
        }

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

        // Gestion générique des clics sur les cartes
        itemCards.forEach(card => {
            card.addEventListener('click', function() {
                // Générer automatiquement les données de l'équipement
                const equipment = getEquipmentData(this);
                
                // Remplir la modal avec les données générées
                document.getElementById('equipmentName').textContent = equipment.name;
                document.getElementById('equipmentDescription').textContent = equipment.description;
                document.getElementById('equipmentImage').src = equipment.image;
                document.getElementById('equipmentImage').alt = equipment.name;
                
                // Gérer le bouton de réservation
                const reserveButton = document.getElementById('reserveButton');
                reserveButton.onclick = function() {
                    // Rediriger vers la page de réservation avec le nom de l'équipement
                    window.location.href = `reservation.php?equipment=${encodeURIComponent(equipment.name)}`;
                };
                
                // Afficher la modal
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
</html>