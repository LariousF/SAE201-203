<?php
require_once '../model/connexion_bdd.php';

// Récupérer la liste des retours de matériel
function getRetoursMateriel() {
    global $connexion;
    $sql = "SELECT r.id, m.nom as materiel, u.nom as utilisateur,
            r.date_retour, r.etat_retour, r.commentaire
            FROM Retour r
            JOIN Materiel m ON r.materiel_id = m.id
            JOIN Utilisateur u ON r.utilisateur_id = u.id
            ORDER BY r.date_retour DESC";
            
    $stmt = $connexion->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ajouter un retour de matériel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $materiel_id = isset($_POST['materiel_id']) ? intval($_POST['materiel_id']) : 0;
    $utilisateur_id = isset($_POST['utilisateur_id']) ? intval($_POST['utilisateur_id']) : 0;
    $etat_retour = isset($_POST['etat_retour']) ? $_POST['etat_retour'] : '';
    $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : '';
    
    if ($materiel_id > 0 && $utilisateur_id > 0) {
        $sql = "INSERT INTO Retour (materiel_id, utilisateur_id, date_retour, etat_retour, commentaire) 
                VALUES (?, ?, NOW(), ?, ?)";
        
        $stmt = $connexion->prepare($sql);
        if ($stmt->execute([$materiel_id, $utilisateur_id, $etat_retour, $commentaire])) {
            // Mettre à jour l'état du matériel si nécessaire
            if ($etat_retour === 'defectueux') {
                $sql = "UPDATE Materiel SET etat = 'maintenance' WHERE id = ?";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([$materiel_id]);
            }
            echo "success";
        } else {
            echo "error";
        }
    }
} 