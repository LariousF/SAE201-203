<?php
require_once '../src/model/db_connect.php';
require_once '../src/model/authentification.php';

$result = $auth->logout();

if ($result['success']) {
    header('Location: connexion.php?message=' . urlencode('Déconnexion réussie.'));
} else {
    header('Location: connexion.php?message=' . urlencode('Erreur lors de la déconnexion.'));
}
exit;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/connexion.css">
</head>
<body>
    <img class="w-25" src="./images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel">
    <div class="blue-bar"></div>
    
    <div class="form_container p-4 rounded shadow-sm">
        <h1 class="text-center mb-4">Déconnexion</h1>
        
        <div class="alert alert-<?php echo $result['success'] ? 'success' : 'danger'; ?> mb-3">
            <?php echo htmlspecialchars($result['message']); ?>
        </div>
        
        <div class="text-center">
            <a href="connexion.php" class="btn btn-primary">Retour à la connexion</a>
        </div>
    </div>
</body>
</html> 