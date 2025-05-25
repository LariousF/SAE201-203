<?php 
require_once '../src/model/db_connect.php';
require_once '../src/model/authentification.php';

$message = '';

// Affichage temporaire pour débogage
echo "<pre>";
echo "Session actuelle : ";
print_r($_SESSION);
echo "</pre>";

// Si l'utilisateur est déjà connecté, le rediriger vers l'accueil
if ($auth->isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Vérification de base
    if (!empty($email) && !empty($password)) {
        try {
            // Recherche de l'utilisateur par email avec son rôle effectif
            $stmt = $connexion->prepare("
                SELECT u.*, 
                    CASE 
                        WHEN e.ID_Utilisateur IS NOT NULL THEN 'Etudiant'
                        WHEN en.ID_Utilisateur IS NOT NULL THEN 'Enseignant'
                        WHEN a.ID_Utilisateur IS NOT NULL THEN 'Administrateur'
                        ELSE u.Role
                    END as Role_Effectif
                FROM Utilisateur u
                LEFT JOIN Etudiant e ON u.ID_Utilisateur = e.ID_Utilisateur
                LEFT JOIN Enseignant en ON u.ID_Utilisateur = en.ID_Utilisateur
                LEFT JOIN Administrateur a ON u.ID_Utilisateur = a.ID_Utilisateur
                WHERE u.Email = ?
            ");
            $stmt->execute([$email]);
            $utilisateur = $stmt->fetch();
            
            // Vérification du mot de passe et du compte actif
            if ($utilisateur && password_verify($password, $utilisateur['Mot_de_passe'])) {
                if (!$utilisateur['Est_Actif']) {
                    $message = "Votre compte est en attente de validation par un administrateur.";
                    $message_type = 'warning';
                } else {
                    // Authentification réussie
                $_SESSION['user_id'] = $utilisateur['ID_Utilisateur'];
                $_SESSION['email'] = $utilisateur['Email'];
                    $_SESSION['user_role'] = $utilisateur['Role_Effectif'];
                    $_SESSION['user_pseudo'] = $utilisateur['Pseudo'];
                    $_SESSION['user_nom'] = $utilisateur['Nom'];
                    $_SESSION['user_prenom'] = $utilisateur['Prenom'];
                    $_SESSION['est_actif'] = $utilisateur['Est_Actif'];
                header("Location: index.php");
                exit;
                }
            } else {
                $message = "Email ou mot de passe incorrect.";
                $message_type = 'danger';
            }
        } catch (PDOException $e) {
            $message = "Une erreur est survenue lors de la connexion.";
            $message_type = 'danger';
            error_log("Erreur de connexion : " . $e->getMessage());
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
        $message_type = 'danger';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/connexion.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <img class="w-25" src="./images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel">
    <div class="blue-bar"></div>
    
    <div class="form_container p-4 rounded shadow-sm">
        <h1 class="text-center mb-4">Connexion</h1>
        
        <?php if (!empty($message)): ?>
            <div class="alert <?php echo strpos($message, 'réussie') !== false ? 'alert-success' : 'alert-danger'; ?> mb-3">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       placeholder="Veuillez entrer votre email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="Veuillez entrer votre mot de passe" required>
            </div>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </div>
                <div class="col-6">
                    <a href="inscription.php" class="btn btn-outline-secondary w-100">S'inscrire</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>