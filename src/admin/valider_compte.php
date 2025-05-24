<?php
// Désactiver l'affichage des erreurs
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Définir le gestionnaire d'erreurs
function handleError($errno, $errstr, $errfile, $errline) {
    echo "Erreur : " . $errstr;
    exit;
}
set_error_handler('handleError');

// Définir le gestionnaire d'exceptions
function handleException($e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}
set_exception_handler('handleException');

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définir les chemins de base
define('BASE_URL', '/Clone/SAE201-203');
define('PUBLIC_URL', BASE_URL . '/public');

try {
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
                } else {
                    $sql = "DELETE FROM Utilisateur WHERE ID_Utilisateur = ?";
                }
                
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute([$id])) {
                    echo 'success';
                } else {
                    echo 'Erreur lors du traitement';
                }
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
        } else {
            echo 'Paramètres invalides';
        }
        exit;
    }

    // Récupérer la liste des comptes en attente
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
    $comptes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Générer le HTML pour le tableau
    $html = '';
    foreach ($comptes as $compte) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($compte['Nom'] . ' ' . $compte['Prenom']) . '</td>';
        $html .= '<td>' . htmlspecialchars($compte['Email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($compte['Role']) . '</td>';
        $html .= '<td>' . htmlspecialchars($compte['Date_Inscription']) . '</td>';
        $html .= '<td>';
        $html .= '<button class="btn btn-success btn-sm me-2" onclick="validerCompte(' . $compte['ID_Utilisateur'] . ')">';
        $html .= '<i class="bi bi-check-lg"></i>';
        $html .= '</button>';
        $html .= '<button class="btn btn-danger btn-sm" onclick="refuserCompte(' . $compte['ID_Utilisateur'] . ')">';
        $html .= '<i class="bi bi-x-lg"></i>';
        $html .= '</button>';
        $html .= '</td>';
        $html .= '</tr>';
    }
    
    echo $html;

} catch (Exception $e) {
    error_log("Erreur dans valider_compte.php : " . $e->getMessage());
    echo "Une erreur est survenue";
} 