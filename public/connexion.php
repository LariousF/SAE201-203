<?php
// Page de connexion
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/connexion.css">
    
</head>
<body>
    <img class="w-25" src="./images/logo_univ_gustave_eiffel.png">
    <div class="blue-bar"></div>
    
    <div class="form_container p-4 rounded shadow-sm">
        <h1 class="text-center mb-4">Connexion</h1>
        <form>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Veuillez entrez votre email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Veuillez entrez votre mot de passe"  required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupere les values du formulaire
            $email = isset($_POST['email']);
            $password = isset($_POST['password']);
            
            $stmt = $pdo->prepare ("SELECT ID_Utilisateur, Email, Pseudo, Nom, Prénom, Mot_de_passe")
        
        }
        
    
    
    
    
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>