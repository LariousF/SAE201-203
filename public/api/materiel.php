<?php
require_once '../../src/model/connexion_bdd.php';
require_once '../../src/model/Materiel.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID de matériel invalide']);
    exit;
}

$materielModel = new Materiel($connexion);
$materiel = $materielModel->getMaterielById($_GET['id']);

if (!$materiel) {
    http_response_code(404);
    echo json_encode(['error' => 'Matériel non trouvé']);
    exit;
}

// Si une période est spécifiée, calculer la disponibilité
if (isset($_GET['date_debut']) && isset($_GET['date_fin'])) {
    $materiel['quantite_disponible'] = $materielModel->getQuantiteDisponible(
        $_GET['id'],
        $_GET['date_debut'],
        $_GET['date_fin']
    );
}

echo json_encode($materiel); 