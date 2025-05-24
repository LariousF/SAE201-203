<?php
require_once '../../src/model/connexion_bdd.php';
require_once '../../src/model/Salle.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID de salle invalide']);
    exit;
}

$salleModel = new Salle($connexion);
$salle = $salleModel->getSalleById($_GET['id']);

if (!$salle) {
    http_response_code(404);
    echo json_encode(['error' => 'Salle non trouvée']);
    exit;
}

// Si une période est spécifiée, vérifier la disponibilité
if (isset($_GET['date_debut']) && isset($_GET['date_fin'])) {
    $salle['disponible'] = $salleModel->checkDisponibilite(
        $_GET['id'],
        $_GET['date_debut'],
        $_GET['date_fin']
    );
}

echo json_encode($salle); 