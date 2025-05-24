<?php

require_once 'db_connect.php';

$response_message = '';

$materiel_name = $_POST['equipment_name'] ?? '';
$date_debut = $_POST['date'] . ' ' . $_POST['heure'] . ':00';
$date_fin = $_POST['date'] . ' ' . ($_POST['heure'] + 1) . ':00'; // Par défaut 1h de réservation
$quantite = 1; // Par défaut une unité

if (!$auth->isLoggedIn()) {
    die('Vous devez être connecté pour faire une réservation.');
}
$id_demandeur = $_SESSION['user_id'];

if (empty($materiel_name) || empty($_POST['date']) || empty($_POST['heure'])) {
    $response_message = 'Erreur: Tous les champs sont requis.';
    echo $response_message;
    exit;
}

if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['date']) || !preg_match("/^\d{2}:\d{2}$/", $_POST['heure'])) {
    $response_message = 'Erreur: Format de date ou d\'heure invalide.';
    echo $response_message;
    exit;
}

try {
    // 1. Récupérer les informations du matériel
    $stmt = $pdo->prepare("
        SELECT ID_Materiel, Quantite_Totale, Etat_Global 
        FROM Materiel 
        WHERE Designation = ? 
        AND Type_Materiel = 'VR'
        AND Etat_Global != 'En panne'
    ");
    $stmt->execute([$materiel_name]);
    $materiel = $stmt->fetch();
    
    if (!$materiel) {
        throw new Exception('Matériel VR non trouvé ou indisponible.');
    }

    // 2. Vérifier la disponibilité (nombre d'unités déjà réservées pour cette période)
    $stmt = $pdo->prepare("
        SELECT SUM(Quantite_Reservee) as total_reserve
        FROM Reservation
        WHERE ID_Materiel = ?
        AND Statut IN ('En attente', 'Validée')
        AND (
            (Date_Debut <= ? AND Date_Fin >= ?) OR
            (Date_Debut <= ? AND Date_Fin >= ?) OR
            (Date_Debut >= ? AND Date_Fin <= ?)
        )
    ");
    $stmt->execute([
        $materiel['ID_Materiel'],
        $date_debut, $date_debut,
        $date_fin, $date_fin,
        $date_debut, $date_fin
    ]);
    $reservation_existante = $stmt->fetch();
    
    $quantite_disponible = $materiel['Quantite_Totale'] - ($reservation_existante['total_reserve'] ?? 0);
    
    if ($quantite_disponible < $quantite) {
        throw new Exception('Désolé, ce matériel n\'est pas disponible pour la période sélectionnée.');
    }

    // 3. Insérer la réservation
    $stmt = $pdo->prepare("
        INSERT INTO Reservation (
            ID_Demandeur, 
            ID_Materiel, 
            Quantite_Reservee,
            Date_Debut,
            Date_Fin,
            Motif,
            Statut,
            Date_Demande
        ) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    $stmt->execute([
        $id_demandeur,
        $materiel['ID_Materiel'],
        $quantite,
        $date_debut,
        $date_fin,
        'Réservation de matériel VR',
        'En attente'
    ]);

    $response_message = 'Votre réservation a été enregistrée avec succès ! Elle est en attente de validation.';

} catch (Exception $e) {
    $response_message = 'Erreur lors de l\'enregistrement de la réservation : ' . $e->getMessage();
    error_log('Erreur réservation : ' . $e->getMessage());
}

echo $response_message;
?>