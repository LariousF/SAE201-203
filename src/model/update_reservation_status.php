<?php
require_once 'connexion_bdd.php';
require_once 'authentification.php';

header('Content-Type: application/json');

// Vérifier si l'utilisateur est admin
if (!$auth->isAdmin()) {
    echo json_encode([
        'success' => false,
        'message' => 'Accès non autorisé'
    ]);
    exit;
}

// Vérifier les données reçues
$reservation_id = $_POST['reservation_id'] ?? null;
$status = $_POST['status'] ?? null;

if (!$reservation_id || !$status || !in_array($status, ['Validée', 'Refusée'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Données invalides'
    ]);
    exit;
}

try {
    // Mettre à jour le statut de la réservation
    $stmt = $connexion->prepare("
        UPDATE reservation 
        SET 
            Statut = ?,
            ID_Gestionnaire = ?,
            Date_Decision = NOW()
        WHERE ID_Reservation = ?
    ");
    
    $stmt->execute([
        $status,
        $auth->getCurrentUser()['ID_Utilisateur'],
        $reservation_id
    ]);

    if ($stmt->rowCount() > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Le statut de la réservation a été mis à jour avec succès'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Réservation non trouvée'
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de la mise à jour du statut'
    ]);
}
?> 