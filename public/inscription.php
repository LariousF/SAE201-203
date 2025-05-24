<?php 
require_once '../src/model/db_connect.php';
require_once '../src/model/authentification.php';

// Si l'utilisateur est déjà connecté, le rediriger vers l'accueil
if ($auth->isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation des champs
    if ($_POST['mot_de_passe'] !== $_POST['confirm_mot_de_passe']) {
        $message = "Les mots de passe ne correspondent pas.";
        $message_type = 'danger';
    } else {
        $userData = [
            'email' => $_POST['email'],
            'pseudo' => $_POST['pseudo'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'password' => $_POST['mot_de_passe'],
            'role' => $_POST['role'],
            'date_naissance' => $_POST['date_naissance'],
            'adresse_postale' => $_POST['adresse_postale']
        ];

        // Ajouter les champs spécifiques selon le rôle
        switch ($_POST['role']) {
            case 'Etudiant':
                $userData['numero_etudiant'] = $_POST['numero_etudiant'];
                $userData['promotion'] = $_POST['promotion'];
                $userData['td'] = $_POST['td'];
                $userData['tp'] = $_POST['tp'];
                break;
            case 'Enseignant':
                $userData['qualification'] = $_POST['qualification'];
                $userData['fonction'] = $_POST['fonction'];
                break;
        }

        $result = $auth->register($userData);
        
        if ($result['success']) {
            // Rediriger vers la page de connexion avec un message de succès
            $_SESSION['form_message'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            $_SESSION['form_message_type'] = 'success';
            header('Location: connexion.php');
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
    <title>Inscription - IUT Inventaires</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/inscription.css">
</head>
<body class="bg-light">

<div class="container">
    <div class="logo-container mt-4">
         <img src="images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel" class="logo-img">
    </div>

    <div class="inscription-form-container">
        <h2 class="mb-4 text-center">Créer un compte</h2>

        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" id="inscriptionForm">
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="nom@exemple.com" required>
            </div>
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="adresse_postale" class="form-label">Adresse postale</label>
                <input type="text" name="adresse_postale" id="adresse_postale" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_mot_de_passe" class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="confirm_mot_de_passe" id="confirm_mot_de_passe" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Je suis un(e)</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">-- Choisir un rôle --</option>
                    <option value="Etudiant">Étudiant</option>
                    <option value="Enseignant">Enseignant</option>
                    <option value="Agent">Agent</option>
                </select>
            </div>

            <div id="champsEtudiant" class="role-specific-fields">
                <h5>Informations Étudiant</h5>
                <div class="mb-3">
                    <label for="numero_etudiant" class="form-label">Numéro étudiant</label>
                    <input type="text" name="numero_etudiant" id="numero_etudiant" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="promotion" class="form-label">Promotion</label>
                    <input type="text" name="promotion" id="promotion" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="td" class="form-label">Groupe TD</label>
                    <input type="text" name="td" id="td" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="tp" class="form-label">Groupe TP</label>
                    <input type="text" name="tp" id="tp" class="form-control">
                </div>
            </div>

            <div id="champsEnseignant" class="role-specific-fields">
                <h5>Informations Enseignant</h5>
                <div class="mb-3">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" name="qualification" id="qualification" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="fonction" class="form-label">Fonction</label>
                    <input type="text" name="fonction" id="fonction" class="form-control">
                </div>
            </div>

            <div id="champsAgent" class="role-specific-fields">
                <h5>Informations Agent</h5>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-custom-primary btn-lg">S'inscrire</button>
            </div>
            <div class="text-center mt-3">
                <a href="connexion.php">Déjà un compte ? Se connecter</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/inscription_role.js"></script>

</body>
</html>