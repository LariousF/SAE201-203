<?php
require_once '../model/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if ($id > 0 && ($action === 'valider' || $action === 'refuser')) {
        $db = Database::getInstance();
        
        if ($action === 'valider') {
            $sql = "UPDATE Utilisateur SET est_valide = 1 WHERE id = ?";
        } else {
            $sql = "DELETE FROM Utilisateur WHERE id = ?";
        }
        
        $stmt = $db->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "success";
        } else {
            echo "error";
        }
    }
}

// Récupérer la liste des comptes en attente
function getComptesEnAttente() {
    $db = Database::getInstance();
    $sql = "SELECT u.id, u.nom, u.email, u.date_inscription, 
            CASE 
                WHEN e.id IS NOT NULL THEN 'Étudiant'
                WHEN en.id IS NOT NULL THEN 'Enseignant'
                WHEN a.id IS NOT NULL THEN 'Agent'
            END as role
            FROM Utilisateur u
            LEFT JOIN Etudiant e ON u.id = e.utilisateur_id
            LEFT JOIN Enseignant en ON u.id = en.utilisateur_id
            LEFT JOIN Agent a ON u.id = a.utilisateur_id
            WHERE u.est_valide = 0
            ORDER BY u.date_inscription DESC";
            
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 