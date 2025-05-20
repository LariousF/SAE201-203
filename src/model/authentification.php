<?php
require_once 'src/config/dbconnect.php';

session_start();

$userId = null;
$userRole = null;
$isLoggedIn = false;

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $isLoggedIn = true;
    
    try {
        $stmt = $pdo->prepare("SELECT ID_Utilisateur, Role FROM Utilisateur WHERE ID_Utilisateur = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $userRole = $user['Role'];
        } else {
            session_unset();
            session_destroy();
            $isLoggedIn = false;
        }
    } catch (PDOException $e) {
        error_log("Erreur de base de données: " . $e->getMessage());
        $isLoggedIn = false;
    }
}
?>