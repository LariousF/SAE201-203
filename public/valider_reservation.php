<?php
require_once '../model/connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if ($id > 0 && ($action === 'valider' || $action === 'refuser')) {
        if ($action === 'valider') {
            $sql = "UPDATE Reservation SET est_validee = 1 WHERE id = ?";
        } else {
            $sql = "UPDATE Reservation SET est_refusee = 1 WHERE id = ?";
        }
        
        $stmt = $connexion->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "success";
        } else {
            echo "error";
        }
    }
}

// Récupérer la liste des réservations en attente
function getReservationsEnAttente() {
    global $connexion;
    $sql = "SELECT r.id, u.nom as utilisateur, 
            CASE 
                WHEN r.materiel_id IS NOT NULL THEN m.nom
                WHEN r.salle_id IS NOT NULL THEN s.numero
            END as ressource,
            r.date_debut, r.date_fin
            FROM Reservation r
            JOIN Utilisateur u ON r.utilisateur_id = u.id
            LEFT JOIN Materiel m ON r.materiel_id = m.id
            LEFT JOIN Salle s ON r.salle_id = s.id
            WHERE r.est_validee = 0 AND r.est_refusee = 0
            ORDER BY r.date_debut ASC";
            
    $stmt = $connexion->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 