<?php
require_once 'db_connect.php';

$userId = null;
$userRole = null;

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
  
    try {
        $stmt = $pdo->prepare("SELECT ID_Utilisateur, Role FROM Utilisateur WHERE ID_Utilisateur = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $userRole = $user['Role'];
        } else {
            session_unset();
            session_destroy();
        }
    } catch (PDOException $e) {
        error_log("Erreur de base de données: " . $e->getMessage());
    }
}


?>