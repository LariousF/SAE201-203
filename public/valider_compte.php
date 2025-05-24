<?php
// Ne pas démarrer une nouvelle session ici car elle est déjà démarrée dans adminboard.php
// session_start();
require_once dirname(__DIR__) . '/model/connexion_bdd.php';
require_once dirname(__DIR__) . '/model/authentification.php';

// Traitement des actions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if ($id > 0 && ($action === 'valider' || $action === 'refuser')) {
        try {
            if ($action === 'valider') {
                $sql = "UPDATE Utilisateur SET Est_Actif = 1 WHERE ID_Utilisateur = ?";
                $message = "Compte validé avec succès";
            } else {
                $sql = "DELETE FROM Utilisateur WHERE ID_Utilisateur = ?";
                $message = "Compte refusé et supprimé";
            }
            
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$id])) {
                echo json_encode(['success' => true, 'message' => $message]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors du traitement']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Paramètres invalides']);
    }
    exit;
}

// Récupérer la liste des comptes en attente
function getComptesEnAttente() {
    global $pdo;
    
    try {
        $sql = "SELECT u.ID_Utilisateur, u.Email, u.Pseudo, u.Nom, u.Prenom, u.Role, u.Date_Inscription,
                CASE 
                    WHEN e.ID_Utilisateur IS NOT NULL THEN CONCAT('Étudiant - Promotion: ', e.Promotion)
                    WHEN en.ID_Utilisateur IS NOT NULL THEN CONCAT('Enseignant - ', en.Fonction)
                    WHEN a.ID_Utilisateur IS NOT NULL THEN 'Agent'
                END as details
                FROM Utilisateur u
                LEFT JOIN Etudiant e ON u.ID_Utilisateur = e.ID_Utilisateur
                LEFT JOIN Enseignant en ON u.ID_Utilisateur = en.ID_Utilisateur
                LEFT JOIN Agent a ON u.ID_Utilisateur = a.ID_Utilisateur
                WHERE u.Est_Actif = 0
                ORDER BY u.Date_Inscription DESC";
                
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération des comptes en attente : " . $e->getMessage());
        return [];
    }
} 