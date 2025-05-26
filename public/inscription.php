<?php 
require_once '../src/model/db_connect.php';
require_once '../src/model/authentification.php';

if ($auth->isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userData = [
        'email' => $_POST['email'] ?? '',
        'pseudo' => $_POST['pseudo'] ?? '',
        'nom' => $_POST['nom'] ?? '',
        'prenom' => $_POST['prenom'] ?? '',
        'password' => $_POST['password'] ?? '',
        'role' => $_POST['role'] ?? ''
    ];

    if ($userData['role'] === 'Etudiant') {
        $userData['numero_etudiant'] = $_POST['numero_etudiant'] ?? '';
        $userData['promotion'] = $_POST['promotion'] ?? '';
    } elseif ($userData['role'] === 'Enseignant') {
        $userData['qualification'] = $_POST['qualification'] ?? '';
        $userData['fonction'] = $_POST['fonction'] ?? '';
        $userData['telephone_pro_enseignant'] = $_POST['telephone_pro_enseignant'] ?? '';
    }

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
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .background-stripe {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            width: 100%;
            height: 300px;
            background-color: #0055a4;
            z-index: 0;
        }

        
        .form-container {
            position: relative;
            z-index: 1;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 120px;
            display: block;
            margin: 0 auto 20px auto;
        }

        .btn-primary {
            background-color: #0055a4;
            border: none;
        }

        .btn-outline-secondary {
            border-color: #0055a4;
            color: #0055a4;
        }

        .btn-outline-secondary:hover {
            background-color: #0055a4;
            color: white;
        }
    </style>
</head>
<body>
    
    <div class="background-stripe"></div>

    <!-- Conteneur du formulaire -->
    <div class="form-container">
        <div class="text-center">
            <img src="./images/logo_univ_gustave_eiffel.png" alt="Logo" class="logo">
        </div>

        <h1 class="text-center mb-4">Inscription</h1>

        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pseudo" class="form-label">Pseudo *</label>
                    <input type="text" name="pseudo" id="pseudo" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label">Nom *</label>
                    <input type="text" name="nom" id="nom" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="prenom" class="form-label">Prénom *</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Mot de passe *</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="confirm_password" class="form-label">Confirmer le mot de passe *</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>
                <div class="col-12 mb-3">
                    <label for="role" class="form-label">Rôle *</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">Sélectionnez un rôle</option>
                        <option value="Etudiant">Étudiant</option>
                        <option value="Enseignant">Enseignant</option>
                        <option value="Agent">Agent</option>
                    </select>
                </div>

                <!-- Étudiant -->
                <div id="etudiant_fields" style="display: none;">
                    <div class="col-md-6 mb-3">
                        <label for="numero_etudiant" class="form-label">Numéro étudiant</label>
                        <input type="text" name="numero_etudiant" id="numero_etudiant" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="promotion" class="form-label">Promotion</label>
                        <input type="text" name="promotion" id="promotion" class="form-control">
                    </div>
                </div>

                <!-- Enseignant -->
                <div id="enseignant_fields" style="display: none;">
                    <div class="col-md-6 mb-3">
                        <label for="qualification" class="form-label">Qualification</label>
                        <input type="text" name="qualification" id="qualification" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fonction" class="form-label">Fonction</label>
                        <input type="text" name="fonction" id="fonction" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telephone_pro_enseignant" class="form-label">Téléphone professionnel</label>
                        <input type="text" name="telephone_pro_enseignant" id="telephone_pro_enseignant" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 mb-2">
                    <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                </div>
                <div class="col-md-6 mb-2">
                    <a href="connexion.php" class="btn btn-outline-secondary w-100">Se connecter</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function () {
            const etudiantFields = document.getElementById('etudiant_fields');
            const enseignantFields = document.getElementById('enseignant_fields');
            const role = this.value;

            etudiantFields.style.display = role === 'Etudiant' ? 'block' : 'none';
            enseignantFields.style.display = role === 'Enseignant' ? 'block' : 'none';
        });
    </script>
</body>
</html>
