<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
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
                        <li class="nav-item">
                            <a href="deconnexion.php" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">Tableau de Bord Administrateur</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#validation-comptes">
                        <i class="bi bi-person-check"></i> Validation des Comptes
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#gestion-materiel">
                        <i class="bi bi-tools"></i> Gestion du Matériel
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#validation-reservations">
                        <i class="bi bi-calendar-check"></i> Validation des Réservations
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#retours-materiels">
                        <i class="bi bi-clipboard-check"></i> Retours Matériels
                    </a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="tab-content">
                    <!-- Section Validation des Comptes -->
                    <div class="tab-pane fade show active" id="validation-comptes">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Validation des Comptes</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Rôle</th>
                                                <th>Date d'inscription</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Martin Dupont</td>
                                                <td>martin.dupont@univ-eiffel.fr</td>
                                                <td>Étudiant</td>
                                                <td>2024-01-15</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" onclick="validerCompte(1)">
                                                        <i class="bi bi-check-lg"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="refuserCompte(1)">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Gestion du Matériel -->
                    <div class="tab-pane fade" id="gestion-materiel">
                        <div class="card">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Gestion du Matériel</h5>
                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#ajoutMaterielModal">
                                    <i class="bi bi-plus-lg"></i> Ajouter
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom</th>
                                                <th>Catégorie</th>
                                                <th>État</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Oculus Quest 2</td>
                                                <td>VR</td>
                                                <td><span class="badge bg-success">Disponible</span></td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm" onclick="modifierMateriel(1)">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="supprimerMateriel(1)">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Validation des Réservations -->
                    <div class="tab-pane fade" id="validation-reservations">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Validation des Réservations</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Utilisateur</th>
                                                <th>Matériel/Salle</th>
                                                <th>Date début</th>
                                                <th>Date fin</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Sophie Martin</td>
                                                <td>Salle 101</td>
                                                <td>2024-01-20 14:00</td>
                                                <td>2024-01-20 16:00</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" onclick="validerReservation(1)">
                                                        <i class="bi bi-check-lg"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="refuserReservation(1)">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Retours Matériels -->
                    <div class="tab-pane fade" id="retours-materiels">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Liste des Retours Matériels</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Matériel</th>
                                                <th>Utilisateur</th>
                                                <th>Date retour</th>
                                                <th>État retour</th>
                                                <th>Commentaire</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>HTC Vive</td>
                                                <td>Pierre Dubois</td>
                                                <td>2024-01-18</td>
                                                <td><span class="badge bg-warning">Léger défaut</span></td>
                                                <td>Rayure sur la lentille droite</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajout/Modification Matériel -->
    <div class="modal fade" id="ajoutMaterielModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un Matériel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="materielForm">
                        <div class="mb-3">
                            <label class="form-label">Nom du matériel</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catégorie</label>
                            <select class="form-select" name="categorie" required>
                                <option value="">Sélectionner une catégorie</option>
                                <option value="VR">VR</option>
                                <option value="Audio">Audio</option>
                                <option value="Video">Vidéo</option>
                                <option value="Informatique">Informatique</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">État</label>
                            <select class="form-select" name="etat" required>
                                <option value="disponible">Disponible</option>
                                <option value="maintenance">En maintenance</option>
                                <option value="reserve">Réservé</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="sauvegarderMateriel()">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonctions de gestion des comptes
        function validerCompte(id) {
            if(confirm('Confirmer la validation de ce compte ?')) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('action', 'valider');
                
                fetch('../src/admin/valider_compte.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Compte validé avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de la validation');
                    }
                });
            }
        }

        function refuserCompte(id) {
            if(confirm('Confirmer le refus de ce compte ?')) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('action', 'refuser');
                
                fetch('../src/admin/valider_compte.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Compte refusé');
                        location.reload();
                    } else {
                        alert('Erreur lors du refus');
                    }
                });
            }
        }

        // Fonctions de gestion du matériel
        function modifierMateriel(id) {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('action', 'get');
            
            fetch('../src/admin/gestion_materiel.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                if(result !== 'error') {
                    const materiel = unserialize(result);
                    const modal = document.getElementById('ajoutMaterielModal');
                    
                    // Remplir le formulaire
                    modal.querySelector('[name="nom"]').value = materiel.nom;
                    modal.querySelector('[name="categorie"]').value = materiel.categorie;
                    modal.querySelector('[name="description"]').value = materiel.description;
                    modal.querySelector('[name="etat"]').value = materiel.etat;
                    
                    // Changer le titre et l'action
                    modal.querySelector('.modal-title').textContent = 'Modifier le matériel';
                    const form = modal.querySelector('form');
                    form.dataset.action = 'modifier';
                    form.dataset.id = id;
                    
                    new bootstrap.Modal(modal).show();
                }
            });
        }

        function supprimerMateriel(id) {
            if(confirm('Êtes-vous sûr de vouloir supprimer ce matériel ?')) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('action', 'supprimer');
                
                fetch('../src/admin/gestion_materiel.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Matériel supprimé avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de la suppression');
                    }
                });
            }
        }

        function sauvegarderMateriel() {
            const form = document.getElementById('materielForm');
            if(form.checkValidity()) {
                const formData = new FormData(form);
                formData.append('action', form.dataset.action || 'ajouter');
                if(form.dataset.id) {
                    formData.append('id', form.dataset.id);
                }
                
                fetch('../src/admin/gestion_materiel.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Matériel sauvegardé avec succès');
                        bootstrap.Modal.getInstance(document.getElementById('ajoutMaterielModal')).hide();
                        location.reload();
                    } else {
                        alert('Erreur lors de la sauvegarde');
                    }
                });
            } else {
                form.reportValidity();
            }
        }

        // Fonctions de gestion des réservations
        function validerReservation(id) {
            if(confirm('Confirmer la validation de cette réservation ?')) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('action', 'valider');
                
                fetch('../src/admin/valider_reservation.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Réservation validée avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de la validation');
                    }
                });
            }
        }

        function refuserReservation(id) {
            if(confirm('Confirmer le refus de cette réservation ?')) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('action', 'refuser');
                
                fetch('../src/admin/valider_reservation.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Réservation refusée');
                        location.reload();
                    } else {
                        alert('Erreur lors du refus');
                    }
                });
            }
        }

        // Fonction utilitaire pour désérialiser les données PHP
        function unserialize(data) {
            const str = data.replace(/\n/g, '');
            const pairs = str.split(';');
            const obj = {};
            
            for(let i = 0; i < pairs.length; i++) {
                const pair = pairs[i].split(':');
                if(pair.length === 2) {
                    obj[pair[0]] = pair[1];
                }
            }
            
            return obj;
        }

        // Charger les données au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            // Charger les comptes en attente
            fetch('../src/admin/valider_compte.php')
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#validation-comptes tbody').innerHTML = html;
                });

            // Charger le matériel
            fetch('../src/admin/gestion_materiel.php')
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#gestion-materiel tbody').innerHTML = html;
                });

            // Charger les réservations en attente
            fetch('../src/admin/valider_reservation.php')
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#validation-reservations tbody').innerHTML = html;
                });

            // Charger les retours de matériel
            fetch('../src/admin/gestion_retours.php')
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#retours-materiels tbody').innerHTML = html;
                });
        });
    </script>
</body>
</html> 