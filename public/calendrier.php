<?php
require_once '../src/model/authentification.php';
require_once '../src/model/connexion_bdd.php';

// Vérifier si l'utilisateur est connecté
$authCheck = checkPermission();
if (!$authCheck['success']) {
    header('Location: login.php');
    exit;
}

// Récupérer les informations de l'utilisateur connecté
$currentUser = $auth->getCurrentUser();

// Récupérer les IDs depuis l'URL
$materiel_id = isset($_GET['materiel_id']) ? intval($_GET['materiel_id']) : 0;
$salle_id = isset($_GET['salle_id']) ? intval($_GET['salle_id']) : 0;

// Variables pour stocker les informations de l'élément à réserver
$item_name = '';
$item_type = '';
$item_id = 0;

// Récupérer les informations selon le type
try {
    if ($materiel_id > 0) {
        $stmt = $connexion->prepare("SELECT ID_Materiel as id, Designation as name, 'materiel' as type FROM materiel WHERE ID_Materiel = ?");
        $stmt->execute([$materiel_id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($item) {
            $item_name = $item['name'];
            $item_type = $item['type'];
            $item_id = $item['id'];
        }
    } elseif ($salle_id > 0) {
        $stmt = $connexion->prepare("SELECT ID_Salle as id, Nom_Salle as name, 'salle' as type FROM salle WHERE ID_Salle = ?");
        $stmt->execute([$salle_id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($item) {
            $item_name = $item['name'];
            $item_type = $item['type'];
            $item_id = $item['id'];
        }
    }

    if (!$item_name) {
        header('Location: index.php');
        exit;
    }

    // Récupérer les réservations existantes
    $sql = "";
    if ($item_type === 'materiel') {
        $sql = "
            SELECT r.Date_Debut, r.Date_Fin, r.Statut, 
                   u.Nom, u.Prenom
            FROM reservation r
            INNER JOIN materiel m ON r.ID_Materiel = m.ID_Materiel
            INNER JOIN utilisateur u ON r.ID_Demandeur = u.ID_Utilisateur
            WHERE m.ID_Materiel = ?
            AND r.Date_Debut >= CURDATE()
            AND r.Statut NOT IN ('Refusée', 'Annulée')
            ORDER BY r.Date_Debut ASC
        ";
    } else {
        $sql = "
            SELECT r.Date_Debut, r.Date_Fin, r.Statut, 
                   u.Nom, u.Prenom
            FROM reservation r
            INNER JOIN salle s ON r.ID_Salle = s.ID_Salle
            INNER JOIN utilisateur u ON r.ID_Demandeur = u.ID_Utilisateur
            WHERE s.ID_Salle = ?
            AND r.Date_Debut >= CURDATE()
            AND r.Statut NOT IN ('Refusée', 'Annulée')
            ORDER BY r.Date_Debut ASC
        ";
    }
    
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$item_id]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $reservations = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Réservation - <?php echo htmlspecialchars($item_name); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link href="css/calendrier.css" rel="stylesheet"/>
</head>
<body>
    <div class="logo-container">
        <img src="images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel" class="img-fluid">
    </div>
    <div class="container">
        <h1>Réservation - <?php echo htmlspecialchars($item_name); ?></h1>
        <div class="background-band"></div>

        <div id="calendar-container">
            <div class="calendar-header">
                <button id="prevMonth">&lt;</button>
                <h2 id="currentMonth"></h2>
                <button id="nextMonth">&gt;</button>
            </div>
            <div class="calendar-grid">
                <div class="calendar-days">
                    <div>Lun</div>
                    <div>Mar</div>
                    <div>Mer</div>
                    <div>Jeu</div>
                    <div>Ven</div>
                    <div>Sam</div>
                    <div>Dim</div>
                </div>
                <div id="calendar-dates" class="calendar-dates"></div>
            </div>
        </div>

        <div id="time-grid" class="time-grid">
            <div class="time-grid-hours">
                <?php for($h = 8; $h <= 18; $h++): ?>
                    <div class="hour-label"><?php echo sprintf("%02d:00", $h); ?></div>
                <?php endfor; ?>
            </div>
            <div id="reservations-container" class="reservations-container">
                <!-- Les réservations seront ajoutées ici dynamiquement -->
                <div id="time-cursor" class="time-cursor" style="display: none;"></div>
                <div id="time-slot-selector" class="time-slot-selector" style="display: none;"></div>
            </div>
        </div>

        <div class="reservation-controls">
            <div class="selected-time-display">
                <span id="selected-time-text">Sélectionnez une plage horaire en cliquant sur la grille</span>
            </div>
            <button type="button" id="reservation-button" class="reservation-button" disabled>
                Réserver cette plage
            </button>
        </div>

        <div id="message" class="message"></div>
    </div>

    <script>
        // Données des réservations depuis PHP
        const reservations = <?php echo json_encode($reservations); ?>;
        const itemName = <?php echo json_encode($item_name); ?>;
        const itemType = <?php echo json_encode($item_type); ?>;
        const itemId = <?php echo json_encode($item_id); ?>;
    </script>
    <script src="js/calendrier.js"></script>
</body>
</html>