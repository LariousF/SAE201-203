<?php
require_once '../src/model/connexion_bdd.php';
require_once '../src/model/Salle.php';

$salleModel = new Salle($connexion);
$salles = $salleModel->getAllSalles();

// Organiser les salles par étage
$sallesParEtage = [];
foreach ($salles as $salle) {
    $etage = substr($salle['Nom_Salle'], 0, 1);
    $sallesParEtage[$etage][] = $salle;
}
ksort($sallesParEtage);
?>
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
                <?php foreach ($sallesParEtage as $etage => $sallesEtage): ?>
                    <div class="col-12">
                        <h3 class="mb-3">Étage <?= $etage ?></h3>
                    </div>
                    <?php foreach ($sallesEtage as $salle): ?>
                <div class="col-lg-4 col-md-6 item-container">
                        <div class="card h-100 shadow-sm" data-item="<?= strtolower($salle['Nom_Salle']) ?>" 
                             data-id="<?= $salle['ID_Salle'] ?>" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-door-open equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                    <span class="text-dark fw-medium"><?= htmlspecialchars($salle['Nom_Salle']) ?></span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
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
                            <img id="roomImage" src="" alt="" class="img-fluid rounded mb-3" style="width: 100%; height: 250px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h4 id="roomName" class="mb-3">Nom de la salle</h4>
                            <p id="roomDescription" class="text-muted">Description de la salle...</p>
                            <p class="mb-2">
                                <strong>Capacité :</strong> <span id="roomCapacity"></span> personnes
                            </p>
                            <p class="mb-2">
                                <strong>Équipements :</strong> <span id="roomEquipment"></span>
                            </p>
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

        // Fonction pour récupérer les détails de la salle
        async function getSalleDetails(id) {
            try {
                const response = await fetch(`api/salle.php?id=${id}`);
                if (!response.ok) throw new Error('Erreur réseau');
                return await response.json();
            } catch (error) {
                console.error('Erreur:', error);
                return null;
            }
        }

        itemCards.forEach(card => {
            card.addEventListener('click', async function() {
                const id = this.dataset.id;
                const salle = await getSalleDetails(id);
                
                if (salle) {
                    document.getElementById('roomName').textContent = salle.Nom_Salle;
                    document.getElementById('roomDescription').textContent = 
                        `Salle située au ${getEtageText(salle.Nom_Salle)} étage.`;
                    document.getElementById('roomCapacity').textContent = salle.Capacite;
                    document.getElementById('roomEquipment').textContent = salle.Equipements_Specifiques || 'Standard';
                    document.getElementById('roomImage').src = getImageByEtage(salle.Nom_Salle);
                    document.getElementById('roomImage').alt = salle.Nom_Salle;

                    const reserveButton = document.getElementById('reserveButton');
                    reserveButton.onclick = function() {
                        window.location.href = `calendrier.php?salle_id=${salle.ID_Salle}`;
                    };

                    const modal = new bootstrap.Modal(document.getElementById('equipmentModal'));
                    modal.show();
                }
            });

            card.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });

        function getEtageText(nomSalle) {
            const etage = nomSalle.charAt(0);
            switch (etage) {
                case '1': return 'premier';
                case '2': return 'deuxième';
                case '3': return 'troisième';
                default: return 'rez-de-chaussée';
            }
        }

        function getImageByEtage(nomSalle) {
            // Correspondance directe pour les salles spécifiques
            const salleImages = {
                '212': 'images/Salle212 photo360.jpg',
                '138': 'images/Salle138 photo360.JPG'
            };

            // Vérifier d'abord si on a une image spécifique pour cette salle
            if (salleImages[nomSalle.substring(1)]) {
                return salleImages[nomSalle.substring(1)];
            }

            // Si pas d'image spécifique, utiliser l'image par défaut
            return 'images/logo_univ_gustave_eiffel.png';
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
