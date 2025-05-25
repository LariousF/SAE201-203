<?php
require_once '../src/model/connexion_bdd.php';
require_once '../src/model/Materiel.php';
require_once '../src/model/authentification.php';

$materielModel = new Materiel($connexion);
$materiels = $materielModel->getAllMateriel();
$isLoggedIn = $auth->isLoggedIn();
$isAdmin = $isLoggedIn && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Administrateur';

// Organiser le matériel par catégorie
$materielsParCategorie = [];
foreach ($materiels as $materiel) {
    $type = $materiel['Type'] ?? 'Standard';
    $categorie = $materiel['Categorie'] ?? 'Autre';
    
    if ($type !== 'VR') { // Exclure le matériel VR qui a sa propre page
        $materielsParCategorie[$categorie][] = $materiel;
    }
}
ksort($materielsParCategorie);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Matériel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reserv_mat.css">
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
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="bg-white rounded shadow p-4 my-4">
            <h1 class="text-center fw-bold mb-4">Réserver du matériel</h1>
            
            <div class="d-flex justify-content-end mb-4">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" id="searchInput" placeholder="Rechercher...">
                    <span class="input-group-text">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                </div>
            </div>

            <div class="row g-4" id="inventoryGrid">
                <?php foreach ($materielsParCategorie as $categorie => $materielsCategorie): ?>
                    <div class="col-12">
                        <h3 class="mb-3"><?= htmlspecialchars($categorie) ?></h3>
                    </div>
                    <?php foreach ($materielsCategorie as $materiel): ?>
                <div class="col-lg-4 col-md-6 item-container">
                        <div class="card h-100 shadow-sm" data-item="<?= strtolower($materiel['Designation']) ?>" 
                             data-id="<?= $materiel['ID_Materiel'] ?>" role="button" tabindex="0">
                        <div class="card-body text-center">
                            <div class="item-image bg-primary rounded d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-laptop equipment-icon text-white"></i>
                            </div>
                            <div class="bg-light rounded p-2">
                                    <span class="text-dark fw-medium"><?= htmlspecialchars($materiel['Designation']) ?></span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="equipmentModal" tabindex="-1" aria-labelledby="equipmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="equipmentModalLabel">Détails du matériel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="equipmentImage" src="" alt="" class="img-fluid rounded mb-3" style="width: 100%; height: 250px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h4 id="equipmentName" class="mb-3">Nom du matériel</h4>
                            <p id="equipmentDescription" class="text-muted">Description du matériel...</p>
                            <p class="mb-2">
                                <strong>État :</strong> <span id="equipmentState"></span>
                            </p>
                            <p class="mb-2">
                                <strong>Catégorie :</strong> <span id="equipmentCategory"></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" id="reserveButton">
                        <i class="bi bi-calendar-check"></i> Réserver ce matériel
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

        // Fonction pour récupérer les détails du matériel
        async function getMaterielDetails(id) {
            try {
                const response = await fetch(`api/materiel.php?id=${id}`);
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
                const materiel = await getMaterielDetails(id);
                
                if (materiel) {
                    document.getElementById('equipmentName').textContent = materiel.Designation;
                    document.getElementById('equipmentDescription').textContent = materiel.Description || 'Aucune description disponible';
                    document.getElementById('equipmentState').textContent = materiel.Etat;
                    document.getElementById('equipmentCategory').textContent = materiel.Categorie;
                    document.getElementById('equipmentImage').src = getImageByCategory(materiel.Categorie);
                    document.getElementById('equipmentImage').alt = materiel.Designation;
                
                const reserveButton = document.getElementById('reserveButton');
                reserveButton.onclick = function() {
                        window.location.href = `calendrier.php?materiel_id=${materiel.ID_Materiel}`;
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

        // Fonction de recherche
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            itemContainers.forEach(container => {
                const item = container.querySelector('[data-item]');
                const itemName = item.dataset.item;
                if (itemName.includes(searchTerm)) {
                    container.style.display = '';
                } else {
                    container.style.display = 'none';
                }
            });
        });

        function getImageByCategory(category) {
            const categoryImages = {
                'Audio': 'images/casque audio.jpg',
                'Vidéo': 'images/video projecteur .jpg',
                'VR': 'images/casque vr occulus.JPG',
                'Photo': 'images/camera go pro.jpg',
                'Tablette': 'images/tablette android.JPG',
                'Accessoire': 'images/support.JPG'
            };
            
            // Chercher une image qui correspond partiellement à la catégorie
            for (const [key, value] of Object.entries(categoryImages)) {
                if (category.toLowerCase().includes(key.toLowerCase())) {
                    return value;
                }
            }
            
            // Image par défaut si aucune correspondance n'est trouvée
            return 'images/logo_univ_gustave_eiffel.png';
        }
    </script>
</body>
</html>