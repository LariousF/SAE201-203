<?php
error_reporting(E_ALL);
ini_set('display_errors', 0); // Désactiver l'affichage des erreurs

require_once 'connexion_bdd.php';
require_once 'authentification.php';

header('Content-Type: application/json');

function sendJsonResponse($success, $message) {
    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);
    exit;
}

// Vérifier si l'utilisateur est connecté
$authCheck = checkPermission();
if (!$authCheck['success']) {
    sendJsonResponse(false, 'Vous devez être connecté pour effectuer une réservation');
}

// Récupérer l'utilisateur courant
$currentUser = $auth->getCurrentUser();
if (!$currentUser) {
    sendJsonResponse(false, 'Impossible de récupérer les informations de l\'utilisateur');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(false, 'Méthode non autorisée');
}

$equipment_name = $_POST['equipment_name'] ?? '';
$date = $_POST['date'] ?? '';
$heure_debut = $_POST['heure_debut'] ?? '';
$heure_fin = $_POST['heure_fin'] ?? '';

if (empty($equipment_name) || empty($date) || empty($heure_debut) || empty($heure_fin)) {
    sendJsonResponse(false, 'Tous les champs sont obligatoires');
}

try {
    // Récupérer l'ID du matériel
    $stmt = $connexion->prepare("SELECT ID_Materiel FROM materiel WHERE Designation = ?");
    $stmt->execute([$equipment_name]);
    $materiel = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$materiel) {
        sendJsonResponse(false, 'Matériel non trouvé');
    }

    // Créer les dates complètes pour la BDD
    $date_debut = $date . ' ' . $heure_debut . ':00';
    $date_fin = $date . ' ' . $heure_fin . ':00';

    // Vérifier si le créneau est disponible
    $stmt = $connexion->prepare("
        SELECT COUNT(*) as nb_reservations 
        FROM reservation 
        WHERE ID_Materiel = ? 
        AND (
            (Date_Debut <= ? AND Date_Fin >= ?) 
            OR (Date_Debut <= ? AND Date_Fin >= ?)
            OR (Date_Debut >= ? AND Date_Fin <= ?)
        )
        AND Statut NOT IN ('Refusée', 'Annulée')
    ");
    
    $stmt->execute([
        $materiel['ID_Materiel'],
        $date_debut, $date_debut,
        $date_fin, $date_fin,
        $date_debut, $date_fin
    ]);
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['nb_reservations'] > 0) {
        sendJsonResponse(false, 'Ce créneau est déjà réservé');
    }

    // Insérer la réservation
    $stmt = $connexion->prepare("
        INSERT INTO reservation (
            ID_Demandeur,
            ID_Materiel,
            Date_Debut,
            Date_Fin,
            Motif,
            Statut,
            Date_Demande
        ) VALUES (?, ?, ?, ?, ?, ?, NOW())
    ");

    $stmt->execute([
        $currentUser['ID_Utilisateur'],
        $materiel['ID_Materiel'],
        $date_debut,
        $date_fin,
        'Réservation de matériel VR',
        'En attente'
    ]);

    sendJsonResponse(true, 'Votre demande de réservation a été enregistrée et est en attente de validation par un administrateur.');

} catch (PDOException $e) {
    error_log("Erreur SQL : " . $e->getMessage());
    sendJsonResponse(false, 'Une erreur est survenue lors de l\'enregistrement de la réservation');
}
?>