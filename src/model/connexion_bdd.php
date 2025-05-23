<?php
session_start(); // Démarre la session pour gérer les connexions

require_once 'db_connect.php';

$message = '';
// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérification de base
    if (!empty($email) && !empty($password)) {
        try {
            // Recherche de l'utilisateur par email
            $stmt = $pdo->prepare("SELECT ID_Utilisateur, Email, Mot_de_passe FROM Utilisateur WHERE Email = ?");
            $stmt->execute([$email]);
            $utilisateur = $stmt->fetch();

            // Vérification du mot de passe
            if ($utilisateur && password_verify($password, $utilisateur['Mot_de_passe'])) {
                // Authentification réussie
                $_SESSION['user_id'] = $utilisateur['ID_Utilisateur'];
                $_SESSION['email'] = $utilisateur['Email'];
                header("Location: ../../public/index.php");
                exit;
            } else {
                // Erreur d'identifiants
                header("Location: connexion.php?erreur=1");
                exit;
            }
        } catch (PDOException $e) {
            // Erreur de requête SQL
            header("Location: connexion.php?erreur=2");
            exit;
        }
    } else {
        // Champs non remplis
        header("Location: connexion.php?erreur=3");
        exit;
    }
} else {
    // Requête non autorisée
    header("Location: connexion.php?erreur=4");
    exit;
}
