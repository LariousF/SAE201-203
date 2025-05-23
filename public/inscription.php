<?php require_once '../src/model/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<!-- Logo et CSS personnalisé -->
<style>
    body {
        background-color: #f5f5f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding-top: 20px;
    }

    .logo-container {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo {
        max-width: 180px;
        height: auto;
    }

    .inscription-container {
        max-width: 600px;
        margin: 0 auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: 600;
    }

    .form-control:focus {
        border-color: #2a5d90;
        box-shadow: 0 0 0 0.2rem rgba(42, 93, 144, 0.25);
    }

    .btn-custom {
        background-color: #2a5d90;
        color: #fff;
        border-radius: 8px;
    }

    .btn-custom:hover {
        background-color: #1e4b75;
    }
    
    /* CSS pour la bande bleue horizontale centrée en fond */
    .background-band {
    position: fixed;       /* toujours visible, même en scroll */
    top: 50%;              /* position verticale au milieu */
    left: 0;
    width: 100vw;          /* largeur de toute la fenêtre */
    height: 5cm;           /* hauteur fixe comme tu souhaitais */
    background-color: #1a4f9c;  /* bleu nuit clair */
    transform: translateY(-50%); /* ajuste pour bien centrer la bande */
    z-index: -1;           /* derrière tout le contenu */
    }
</style>
<div class="logo-container">
     <img src="images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel" class="img-fluid" style="max-width: 200px; height: auto;">
    </a>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-white p-4 rounded shadow-sm">
            <h2 class="mb-4 text-center">Créer un compte</h2>
            <div class="background-band"></div>
            <form method="POST" action="../src/config/inscription_bdd.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="nom@exemple.com" required>
                </div>
                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>
                    <div class="col mb-3">
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
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
