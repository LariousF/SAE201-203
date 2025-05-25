<?php
require_once '../../src/model/db_connect.php';
require_once '../../src/model/authentification.php';

header('Content-Type: application/json');

$auth = new Authentification($connexion);

if (!$auth->isLoggedIn() || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Administrateur') {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorisé']);
    exit;
}

try {
    // Si un ID est fourni, récupérer un matériel spécifique
    if (isset($_GET['id'])) {
        $query = "SELECT * FROM materiel WHERE ID_Materiel = :id";
        $stmt = $connexion->prepare($query);
        $stmt->execute(['id' => $_GET['id']]);
        $materiel = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$materiel) {
            http_response_code(404);
            echo json_encode(['error' => 'Matériel non trouvé']);
            exit;
        }
        
        echo json_encode($materiel);
    } 
    // Sinon, récupérer tous les matériels
    else {
        $query = "SELECT * FROM materiel ORDER BY Type_Materiel, Designation";
        $stmt = $connexion->prepare($query);
        $stmt->execute();
        $materiel = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($materiel);
    }
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Erreur lors de la récupération du matériel',
        'details' => $e->getMessage()
    ]);
} 