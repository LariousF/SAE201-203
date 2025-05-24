<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Matériel VR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reserv_mat_vr.css">
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
            <h1 class="text-center fw-bold mb-4">Réserver un matériel VR</h1>

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
                    <div class="card h-100 shadow-sm" data-item="casque vr oculus quest 2" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-vr-cardboard equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Oculus Quest 2</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="casque vr htc vive" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-success rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-vr-cardboard equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">HTC Vive</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="casque vr valve index" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-warning rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-vr-cardboard equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Valve Index</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="contrôleurs vr oculus touch" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-hand-pointer equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Contrôleurs Oculus Touch</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="contrôleurs vr vive wand" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-secondary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-hand-pointer equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Contrôleurs Vive Wand</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="base stations vr lighthouse" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-info rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-broadcast-tower equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Base Stations Lighthouse</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="pc gaming vr ready" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-dark rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-desktop equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">PC Gaming (VR Ready)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 item-container">
                    <div class="card h-100 shadow-sm" data-item="accessoires vr câbles adaptateurs" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-danger rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-headphones-alt equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                <span class="text-dark fw-medium">Accessoires VR</span>
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
                    <h5 class="modal-title" id="equipmentModalLabel">Détails du matériel VR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="equipmentImage" src="" alt="" class="img-fluid rounded mb-3" style="width: 100%; height: 250px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h4 id="equipmentName" class="mb-3">Nom du matériel VR</h4>
                            <p id="equipmentDescription" class="text-muted">Description du matériel VR...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" id="reserveButton">
                        <i class="bi bi-calendar-check"></i> Réserver ce matériel VR
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

        // Function to generate equipment data (description/image)
        function getEquipmentData(card) {
            const name = card.querySelector('span').textContent.trim();
            const iconClass = card.querySelector('i').className;

            // Generate description based on name
            const description = `${name} est un équipement de réalité virtuelle de pointe, idéal pour des expériences immersives et des projets de recherche. Disponible pour tous les étudiants et le personnel de l'université Gustave Eiffel.`;

            // Image mapping for VR equipment
            const imageMap = {
                'fa-vr-cardboard': 'https://images.unsplash.com/photo-1617042375876-a1458998782f?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Generic VR headset
                'fa-hand-pointer': 'https://images.unsplash.com/photo-1616781429938-2df8d1c97a29?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // VR controllers
                'fa-broadcast-tower': 'https://images.unsplash.com/photo-1616781429938-2df8d1c97a29?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Base stations (can reuse controller image if no specific image)
                'fa-desktop': 'https://images.unsplash.com/photo-1593305841398-b0a6861e6879?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Gaming PC
                'fa-headphones-alt': 'https://images.unsplash.com/photo-1546435345-23c21a403487?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' // Accessories
            };

            let image = 'https://images.unsplash.com/photo-1617042375876-a1458998782f?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'; // Default VR image
            for (const key in imageMap) {
                if (iconClass.includes(key)) {
                    image = imageMap[key];
                    break;
                }
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
                // Generate equipment data
                const equipment = getEquipmentData(this);

                document.getElementById('equipmentName').textContent = equipment.name;
                document.getElementById('equipmentDescription').textContent = equipment.description;
                document.getElementById('equipmentImage').src = equipment.image;
                document.getElementById('equipmentImage').alt = equipment.name;

                const reserveButton = document.getElementById('reserveButton');
                reserveButton.onclick = function() {
                    window.location.href = `calendrier.php?equipment=${encodeURIComponent(equipment.name)}`;
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
                <h5>Aucun matériel VR trouvé</h5>
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