<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUT Marne-la-Vallée - Connexion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        
        body {
            display: flex;
            flex-direction: column;
        }
        
        .main-container {
            flex: 1;
            display: flex;
            width: 100%;
        }
        
        .left-section {
            width: 20%;
            background-color: white;
            position: relative;
        }
        
        .logo-container {
            padding: 30px 20px;
        }
        
        .logo {
            max-width: 100%;
            height: auto;
        }
        
        .subtitle {
            color: #FFD700;
            font-weight: bold;
            font-size: 0.8rem;
        }
        
        .form-section {
            width: 80%;
            background-color: #f0f0f0;
            position: relative;
            padding: 20px 40px;
        }
        
        .blue-bar {
            position: absolute;
            background-color: #2A5D90;
            width: 100%;
            height: 30%;
            left: 0;
            top: 50%;
            z-index: 0;
            transform: translateY(-50%);
        }
        
        .connexion-title {
            color: #1e3655;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 50px;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .form-container {
            position: relative;
            z-index: 1;
            max-width: 500px;
            margin: 0 auto;
            padding-top: 70px;
        }
        
        .form-label {
            font-weight: bold;
            color: #333;
        }
        
        .form-control {
            border-radius: 4px;
            padding: 12px;
            margin-bottom: 25px;
        }
        
        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
        .btn-connect {
            background-color: #1e3655;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 30px;
            font-weight: bold;
            min-width: 150px;
        }
        
        .btn-signup {
            background-color: white;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px 30px;
            font-weight: bold;
            min-width: 150px;
        }
        
        .error-message {
            color: #dc3545;
            margin-top: 20px;
            text-align: center;
        }
        
        .required-text {
            font-size: 0.8rem;
            color: #666;
            text-align: right;
        }
    </style>
</head>
<body>
    <?php
    // Initialiser les variables
    $email = "";
    $password = "";
    $error = "";

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Ici, vous pouvez ajouter votre logique d'authentification
        // Pour l'exemple, nous allons simplement afficher un message d'erreur
        $error = "Votre adresse e-mail ou votre mot de passe sont erronés ou ne sont pas enregistrés";
    }
    ?>

    <div class="main-container">
        <!-- Section gauche avec logo -->
        <div class="left-section">
            <div class="logo-container">
                <img src="./images/logo_univ_gustave_eiffel.png" class="logo">
                <div class="subtitle">MARNE-LA-VALLÉE</div>
            </div>
            <!-- Partie bleue sous le logo -->
            <div class="blue-bar"></div>
        </div>
        
        <section class="row col-md-8">

            <div class="form-section">
                <!-- Barre bleue qui traverse le formulaire -->
                <div class="blue-bar"></div>
                
                <h1 class="connexion-title">Connexion</h1>
                
                <div class="form-container">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="email" class="form-label">Email</label>
                                <span class="required-text">*Champs obligatoires</span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Adresse mail" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <div class="btn-group">
                            <button type="submit" class="btn btn-connect">Se connecter</button>
                            <a href="inscription.php" class="btn btn-signup">S'inscrire</a>
                        </div>
                        
                        <?php if (!empty($error)): ?>
                            <div class="error-message mt-4"><?php echo $error; ?></div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </section>
            
            <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>