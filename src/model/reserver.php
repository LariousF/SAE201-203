<?php
require_once 'connexion_bdd.php';
require_once 'authentification.php';

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

// Vérifier si l'utilisateur est connecté
$authCheck = checkPermission();
if (!$authCheck['success']) {
    echo json_encode([
        'success' => false,
        'message' => 'Vous devez être connecté pour effectuer une réservation'
    ]);
    exit;
}

// Récupérer l'utilisateur courant
$currentUser = $auth->getCurrentUser();
if (!$currentUser) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de la récupération des informations utilisateur'
    ]);
    exit;
}

// Récupérer les données POST
$item_type = $_POST['item_type'] ?? '';
$item_id = intval($_POST['item_id'] ?? 0);
$date = $_POST['date'] ?? '';
$heure_debut = $_POST['heure_debut'] ?? '';
$heure_fin = $_POST['heure_fin'] ?? '';

// Validation des données
if (!$item_type || !$item_id || !$date || !$heure_debut || !$heure_fin) {
    echo json_encode([
        'success' => false,
        'message' => 'Données manquantes'
    ]);
    exit;
}

try {
    // Vérifier si l'élément existe
    $sql = "";
    if ($item_type === 'materiel') {
        $sql = "SELECT ID_Materiel FROM materiel WHERE ID_Materiel = ?";
    } else {
        $sql = "SELECT ID_Salle FROM salle WHERE ID_Salle = ?";
    }
    
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$item_id]);
    if (!$stmt->fetch()) {
        echo json_encode([
            'success' => false,
            'message' => "L'élément demandé n'existe pas"
        ]);
        exit;
    }

    // Vérifier les chevauchements
    $sql = "";
    if ($item_type === 'materiel') {
        $sql = "
            SELECT COUNT(*) as nb
            FROM reservation
            WHERE ID_Materiel = ?
            AND Date_Debut < ? AND Date_Fin > ?
            AND Statut NOT IN ('Refusée', 'Annulée')
        ";
    } else {
        $sql = "
            SELECT COUNT(*) as nb
            FROM reservation
            WHERE ID_Salle = ?
            AND Date_Debut < ? AND Date_Fin > ?
            AND Statut NOT IN ('Refusée', 'Annulée')
        ";
    }

    $date_debut = $date . ' ' . $heure_debut;
    $date_fin = $date . ' ' . $heure_fin;

    $stmt = $connexion->prepare($sql);
    $stmt->execute([$item_id, $date_fin, $date_debut]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['nb'] > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Cette plage horaire est déjà réservée'
        ]);
        exit;
    }

    // Insérer la réservation
    $sql = "";
    if ($item_type === 'materiel') {
        $sql = "
            INSERT INTO reservation (
                ID_Demandeur, ID_Materiel, Date_Demande,
                Date_Debut, Date_Fin, Statut
            ) VALUES (?, ?, NOW(), ?, ?, 'En attente')
        ";
    } else {
        $sql = "
            INSERT INTO reservation (
                ID_Demandeur, ID_Salle, Date_Demande,
                Date_Debut, Date_Fin, Statut
            ) VALUES (?, ?, NOW(), ?, ?, 'En attente')
        ";
    }

    $stmt = $connexion->prepare($sql);
    $stmt->execute([
        $currentUser['ID_Utilisateur'],
        $item_id,
        $date_debut,
        $date_fin
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Votre demande de réservation a été enregistrée et est en attente de validation'
    ]);

} catch (PDOException $e) {
    error_log("Erreur lors de la réservation : " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Une erreur est survenue lors de la réservation'
    ]);
} 