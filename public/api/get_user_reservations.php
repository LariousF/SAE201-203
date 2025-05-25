<?php
require_once '../../src/model/db_connect.php';
require_once '../../src/model/authentification.php';

header('Content-Type: application/json');

$auth = new Authentification($connexion);

if (!$auth->isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorisé']);
    exit;
}

try {
    $userId = $_SESSION['user_id'];
    
    // Récupérer toutes les réservations de l'utilisateur
    $query = "
        SELECT 
            CASE 
                WHEN r.ID_Salle IS NOT NULL THEN 'Salle'
                WHEN m.Type_Materiel = 'VR' THEN 'Matériel VR'
                ELSE 'Matériel'
            END as type,
            COALESCE(s.Nom_Salle, m.Designation) as ressource,
            r.Date_Debut as date_debut,
            r.Date_Fin as date_fin,
            r.Statut as statut,
            r.ID_Reservation as id
        FROM reservation r
        LEFT JOIN salle s ON r.ID_Salle = s.ID_Salle
        LEFT JOIN materiel m ON r.ID_Materiel = m.ID_Materiel
        WHERE r.ID_Demandeur = :user_id
        ORDER BY r.Date_Debut DESC
    ";
    
    $stmt = $connexion->prepare($query);
    $stmt->execute(['user_id' => $userId]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($reservations)) {
        echo json_encode([]);
    } else {
        echo json_encode($reservations);
    }
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Erreur lors de la récupération des réservations',
        'details' => $e->getMessage()
    ]);
} 