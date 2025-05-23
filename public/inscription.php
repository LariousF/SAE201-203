<?php require_once '../src/model/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/inscription.css" rel="stylesheet">

</head>
<body class="bg-light">
<div class="logo-container">
        <img src="images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel" class="img-fluid" style="max-width: 200px; height: auto;">
        </a>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-white p-4 rounded shadow-sm">
            <h2 class="mb-4 text-center">Créer un compte</h2>
            <div class="background-band"></div>
            <form method="POST" action="../src/model/inscription_bdd.php">
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
