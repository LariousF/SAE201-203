<?php
// Pas de header('Content-Type: application/json'); car nous ne renvoyons plus de JSON par défaut.
// Si vous voulez une réponse simple, vous pouvez juste echo du texte.

// Inclure votre fichier de connexion à la base de données
// Assurez-vous que ce chemin est correct
require_once 'db_connect.php'; // Remplacez par le nom réel de votre fichier de connexion

// Initialiser une variable pour le message de réponse
$response_message = '';

// Récupérer les données envoyées par la requête POST
$equipment_name = $_POST['equipment_name'] ?? '';
$reservation_date = $_POST['date'] ?? '';
$reservation_time = $_POST['heure'] ?? '';

// --- Simulation de l'utilisateur (À REMPLACER PAR VOTRE SYSTÈME D'AUTHENTIFICATION) ---
// Dans un vrai système, l'ID de l'utilisateur viendrait de votre session utilisateur après authentification.
// Par exemple : $_SESSION['user_id']
$user_id = 1; // Remplacez ceci par l'ID de l'utilisateur connecté
// --- FIN SIMULATION ---

if (empty($equipment_name) || empty($reservation_date) || empty($reservation_time)) {
    $response_message = 'Erreur: Tous les champs sont requis.';
    echo $response_message; // Renvoie le message directement
    exit;
}

// Validation basique du format de date et heure
if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $reservation_date) || !preg_match("/^\d{2}:\d{2}$/", $reservation_time)) {
    $response_message = 'Erreur: Format de date ou d\'heure invalide.';
    echo $response_message; // Renvoie le message directement
    exit;
}

// Vérifier la disponibilité (logique déjà présente dans calendrier.php, mais bonne pratique de la re-vérifier côté serveur)
// Pour l'exemple, on reprend la logique simple basée sur le jour du mois.
// Dans un cas réel, vous vérifieriez les conflits dans la base de données.
$day = (int)date('d', strtotime($reservation_date));
$is_available_day = (($day - 1) % 5) < 3; // Lundi, Mardi, Mercredi (jours 1-3) disponibles

$hour = (int)substr($reservation_time, 0, 2);
$is_available_hour = ($hour >= 8 && $hour <= 18);

if (!$is_available_day || !$is_available_hour) {
    $response_message = 'Réservation impossible pour cette date ou cette heure.';
    echo $response_message; // Renvoie le message directement
    exit;
}

// Insertion dans la base de données
try {
    // Connexion à la base de données (assurez-vous que $pdo est défini dans db_connect.php)
    $stmt = $pdo->prepare("INSERT INTO reservations (user_id, equipment_name, reservation_date, reservation_time) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $equipment_name, $reservation_date, $reservation_time]);

    $response_message = 'Votre réservation a été enregistrée avec succès !';

} catch (PDOException $e) {
    // Gérer les erreurs de base de données
    $response_message = 'Erreur lors de l\'enregistrement de la réservation : ' . $e->getMessage();
    // En développement, vous pouvez afficher l'erreur complète, en production, loguez-la.
    // error_log('Erreur PDO: ' . $e->getMessage());
}

echo $response_message; // Renvoie le message final (succès ou erreur)
?>