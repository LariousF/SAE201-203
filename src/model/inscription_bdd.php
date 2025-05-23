<?php
require_once 'db_connect.php';
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et validation
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $pseudo = trim($_POST['pseudo']);
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $mot_de_passe = $_POST['mot_de_passe'];
    $date_naissance = $_POST['date_naissance'] ?? null;
    $adresse_postale = trim($_POST['adresse_postale']);
    $role = 'Etudiant'; // valeur par défaut

    // Vérification de champs
    if (!$email || empty($pseudo) || empty($nom) || empty($prenom) || empty($mot_de_passe)) {
        die('Veuillez remplir tous les champs obligatoires et fournir un email valide.');
    }

    // Hachage du mot de passe
    $hash_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Requête préparée
    $sql = "INSERT INTO utilisateur (Email, Pseudo, Nom, Prenom, Mot_de_passe, Date_Naissance, Adresse_Postale, Role)
            VALUES (:email, :pseudo, :nom, :prenom, :mot_de_passe, :date_naissance, :adresse_postale, :role)";
    
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':email' => $email,
            ':pseudo' => $pseudo,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':mot_de_passe' => $hash_password,
            ':date_naissance' => $date_naissance,
            ':adresse_postale' => $adresse_postale,
            ':role' => $role,
        ]);

        // Redirection vers la page de connexion après succès
        header('Location: ../../public/connexion.php?message=inscription_reussie');
        exit;

    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            die("Erreur : cet email ou pseudo est déjà utilisé.");
        } else {
            die("Erreur lors de l'inscription : " . $e->getMessage());
        }
    }
} else {
    die("Méthode non autorisée.");
}
