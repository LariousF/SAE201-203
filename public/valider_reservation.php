<?php
require_once '../src/model/connexion_bdd.php';
require_once '../src/model/Reservation.php';

session_start();

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

$reservationModel = new Reservation($connexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if ($id > 0 && ($action === 'valider' || $action === 'refuser')) {
        $gestionnaireId = $_SESSION['user_id'];
        
        if ($action === 'valider') {
            $success = $reservationModel->validerReservation($id, $gestionnaireId);
        } else {
            $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : '';
            $success = $reservationModel->refuserReservation($id, $gestionnaireId, $commentaire);
        }
        
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            echo $success ? "success" : "error";
            exit;
        }
    }
}

// Récupérer la liste des réservations en attente
$reservationsEnAttente = $reservationModel->getReservationsEnAttente();

// Si c'est une requête AJAX, retourner uniquement les données
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    header('Content-Type: application/json');
    echo json_encode($reservationsEnAttente);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des Réservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
    <?php include 'includes/header.php'; ?>

    <div class="container my-4">
        <div class="bg-white rounded shadow p-4">
            <h1 class="text-center mb-4">Validation des Réservations</h1>

            <?php if (empty($reservationsEnAttente)): ?>
                <div class="alert alert-info">
                    Aucune réservation en attente de validation.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date de demande</th>
                                <th>Demandeur</th>
                                <th>Ressource</th>
                                <th>Période</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservationsEnAttente as $reservation): ?>
                                <tr>
                                    <td><?= date('d/m/Y H:i', strtotime($reservation['Date_Demande'])) ?></td>
                                    <td><?= htmlspecialchars($reservation['Nom'] . ' ' . $reservation['Prenom']) ?></td>
                                    <td>
                                        <?php if ($reservation['Materiel_Nom']): ?>
                                            <?= htmlspecialchars($reservation['Materiel_Nom']) ?>
                                            (<?= $reservation['Quantite_Reservee'] ?> unité(s))
                                        <?php else: ?>
                                            Salle <?= htmlspecialchars($reservation['Salle_Nom']) ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        Du <?= date('d/m/Y H:i', strtotime($reservation['Date_Debut'])) ?>
                                        <br>
                                        Au <?= date('d/m/Y H:i', strtotime($reservation['Date_Fin'])) ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm validate-btn" 
                                                data-id="<?= $reservation['ID_Reservation'] ?>">
                                            <i class="bi bi-check-lg"></i> Valider
                                        </button>
                                        <button class="btn btn-danger btn-sm refuse-btn" 
                                                data-id="<?= $reservation['ID_Reservation'] ?>">
                                            <i class="bi bi-x-lg"></i> Refuser
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal de refus -->
    <div class="modal fade" id="refuseModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Motif du refus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="refuseComment" rows="3" 
                              placeholder="Veuillez indiquer le motif du refus..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmRefuse">Confirmer le refus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const refuseModal = new bootstrap.Modal(document.getElementById('refuseModal'));
            let currentReservationId = null;

            // Gestionnaire pour le bouton Valider
            document.querySelectorAll('.validate-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    handleReservation(id, 'valider');
                });
            });

            // Gestionnaire pour le bouton Refuser
            document.querySelectorAll('.refuse-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    currentReservationId = this.dataset.id;
                    refuseModal.show();
                });
            });

            // Gestionnaire pour la confirmation du refus
            document.getElementById('confirmRefuse').addEventListener('click', function() {
                const commentaire = document.getElementById('refuseComment').value;
                handleReservation(currentReservationId, 'refuser', commentaire);
                refuseModal.hide();
            });

            function handleReservation(id, action, commentaire = '') {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('action', action);
                if (commentaire) {
                    formData.append('commentaire', commentaire);
                }

                fetch('valider_reservation.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if (result === 'success') {
                        // Recharger la page pour mettre à jour la liste
                        window.location.reload();
                    } else {
                        alert('Une erreur est survenue');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue');
                });
            }
        });
    </script>
</body>
</html> 