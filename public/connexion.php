<?php 
require_once '../src/model/db_connect.php';
require_once '../src/model/authentification.php';

$message = '';

// Si l'utilisateur est déjà connecté, le rediriger vers l'accueil
if ($auth->isLoggedIn()) {
    header('Location: index.php');
    exit;
}

//Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($email) && !empty($password)) {
        $result = $auth->login($email, $password);
        
        if ($result['success']) {
            header("Location: index.php");
            exit;
        } else {
            $message = $result['message'];
        }
    } else {
        $message = "Veuillez remplir tous les champs";
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
            <div class="alert <?php echo strpos($message, 'succès') !== false ? 'alert-success' : 'alert-danger'; ?> mb-3">
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