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

try {
    $stmt = $connexion->prepare("
        SELECT 
            r.ID_Reservation,
            r.Date_Debut,
            r.Date_Fin,
            r.Statut,
            u.Nom,
            u.Prenom,
            CASE 
                WHEN m.ID_Materiel IS NOT NULL THEN m.Designation
                WHEN s.ID_Salle IS NOT NULL THEN s.Nom_Salle
            END as Item_Name,
            CASE 
                WHEN m.ID_Materiel IS NOT NULL THEN 'Matériel'
                WHEN s.ID_Salle IS NOT NULL THEN 'Salle'
            END as Item_Type
        FROM reservation r
        INNER JOIN utilisateur u ON r.ID_Demandeur = u.ID_Utilisateur
        LEFT JOIN materiel m ON r.ID_Materiel = m.ID_Materiel
        LEFT JOIN salle s ON r.ID_Salle = s.ID_Salle
        WHERE r.Statut = 'En attente'
        ORDER BY r.Date_Demande DESC
    ");
    
    $stmt->execute();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($reservations);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de la récupération des réservations'
    ]);
}
?> 