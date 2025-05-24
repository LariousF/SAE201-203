<?php 
require_once '../src/model/db_connect.php';
require_once '../src/model/authentification.php';

// Si l'utilisateur est déjà connecté, le rediriger vers l'accueil
if ($auth->isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userData = [
        'email' => $_POST['email'] ?? '',
        'pseudo' => $_POST['pseudo'] ?? '',
        'nom' => $_POST['nom'] ?? '',
        'prenom' => $_POST['prenom'] ?? '',
        'password' => $_POST['password'] ?? '',
        'role' => $_POST['role'] ?? ''
    ];

    // Ajouter les champs spécifiques selon le rôle
    if ($userData['role'] === 'Etudiant') {
        $userData['numero_etudiant'] = $_POST['numero_etudiant'] ?? '';
        $userData['promotion'] = $_POST['promotion'] ?? '';
    } elseif ($userData['role'] === 'Enseignant') {
        $userData['qualification'] = $_POST['qualification'] ?? '';
        $userData['fonction'] = $_POST['fonction'] ?? '';
    }

    // Vérifier que les mots de passe correspondent
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $message = "Les mots de passe ne correspondent pas.";
        $message_type = 'danger';
    } else {
        $result = $auth->register($userData);
        if ($result['success']) {
            header('Location: connexion.php?message=' . urlencode('Inscription réussie ! Vous pouvez maintenant vous connecter.'));
            exit;
        } else {
            $message = $result['message'];
            $message_type = 'danger';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Inscription</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/connexion.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <img class="w-25" src="./images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel">
    <div class="blue-bar"></div>
    
    <div class="form_container p-4 rounded shadow-sm">
        <h1 class="text-center mb-4">Inscription</h1>
        
        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo $message_type; ?> mb-3">
                <?php echo htmlspecialchars($message); ?>
    </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
             <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="">Sélectionnez un rôle</option>
                    <option value="Etudiant">Étudiant</option>
                    <option value="Enseignant">Enseignant</option>
                </select>
            </div>

            <!-- Champs spécifiques pour les étudiants -->
            <div id="etudiant_fields" style="display: none;">
                <div class="mb-3">
                    <label for="numero_etudiant" class="form-label">Numéro étudiant</label>
                    <input type="text" class="form-control" id="numero_etudiant" name="numero_etudiant">
                </div>
                <div class="mb-3">
                    <label for="promotion" class="form-label">Promotion</label>
                    <input type="text" class="form-control" id="promotion" name="promotion">
                </div>
            </div>

            <!-- Champs spécifiques pour les enseignants -->
            <div id="enseignant_fields" style="display: none;">
                <div class="mb-3">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" class="form-control" id="qualification" name="qualification">
                </div>
                <div class="mb-3">
                    <label for="fonction" class="form-label">Fonction</label>
                    <input type="text" class="form-control" id="fonction" name="fonction">
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
            </div>
                <div class="col-6">
                    <a href="connexion.php" class="btn btn-outline-secondary w-100">Se connecter</a>
            </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function() {
            const etudiantFields = document.getElementById('etudiant_fields');
            const enseignantFields = document.getElementById('enseignant_fields');
            
            if (this.value === 'Etudiant') {
                etudiantFields.style.display = 'block';
                enseignantFields.style.display = 'none';
            } else if (this.value === 'Enseignant') {
                etudiantFields.style.display = 'none';
                enseignantFields.style.display = 'block';
            } else {
                etudiantFields.style.display = 'none';
                enseignantFields.style.display = 'none';
            }
        });
    </script>
</body>
</html>