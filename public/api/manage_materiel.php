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

// Récupérer les données envoyées
$data = json_decode(file_get_contents('php://input'), true);
$action = isset($data['action']) ? $data['action'] : '';

try {
    switch ($action) {
        case 'add':
            $query = "INSERT INTO materiel (Reference_Materiel, Designation, Type_Materiel, Etat_Global, Quantite_Totale, Descriptif) 
                     VALUES (:reference, :designation, :type, :etat, :quantite, :descriptif)";
            $stmt = $connexion->prepare($query);
            $stmt->execute([
                'reference' => $data['reference'],
                'designation' => $data['designation'],
                'type' => $data['type'],
                'etat' => $data['etat'],
                'quantite' => $data['quantite'],
                'descriptif' => $data['descriptif']
            ]);
            echo json_encode(['success' => true, 'id' => $connexion->lastInsertId()]);
            break;

        case 'update':
            $query = "UPDATE materiel 
                     SET Reference_Materiel = :reference,
                         Designation = :designation,
                         Type_Materiel = :type,
                         Etat_Global = :etat,
                         Quantite_Totale = :quantite,
                         Descriptif = :descriptif
                     WHERE ID_Materiel = :id";
            $stmt = $connexion->prepare($query);
            $stmt->execute([
                'id' => $data['id'],
                'reference' => $data['reference'],
                'designation' => $data['designation'],
                'type' => $data['type'],
                'etat' => $data['etat'],
                'quantite' => $data['quantite'],
                'descriptif' => $data['descriptif']
            ]);
            echo json_encode(['success' => true]);
            break;

        case 'delete':
            // Vérifier d'abord s'il n'y a pas de réservations en cours
            $query = "SELECT COUNT(*) FROM reservation WHERE ID_Materiel = :id AND Statut IN ('En attente', 'Validée')";
            $stmt = $connexion->prepare($query);
            $stmt->execute(['id' => $data['id']]);
            if ($stmt->fetchColumn() > 0) {
                http_response_code(400);
                echo json_encode(['error' => 'Ce matériel a des réservations en cours et ne peut pas être supprimé.']);
                exit;
            }

            $query = "DELETE FROM materiel WHERE ID_Materiel = :id";
            $stmt = $connexion->prepare($query);
            $stmt->execute(['id' => $data['id']]);
            echo json_encode(['success' => true]);
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Action non valide']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la gestion du matériel: ' . $e->getMessage()]);
} 