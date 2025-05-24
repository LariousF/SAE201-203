<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Définir le chemin racine
define('ROOT_PATH', dirname(__DIR__));

// Inclure les fichiers essentiels
require_once ROOT_PATH . '/src/model/connexion_bdd.php';
require_once ROOT_PATH . '/src/model/authentification.php';

// Vérifier l'authentification et les droits d'administrateur
if (!$auth->isLoggedIn()) {
    $message = "Vous devez être connecté pour accéder à cette page.";
    $message_type = 'danger';
} elseif (!$auth->isAdmin()) {
    $message = "Vous n'avez pas les droits d'accès à cette page.";
    $message_type = 'danger';
}

// Si l'utilisateur n'est pas authentifié ou n'est pas admin, afficher un message d'erreur
if (isset($message)) {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur d'accès</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="alert alert-<?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
    </div>
</body>
</html>
<?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
    <header class="bg-white border-bottom">
        <nav class="container navbar navbar-expand-lg navbar-light py-4">
            <div class="container-fluid px-0">
                <a class="navbar-logo me-4" href="index.php">
                    <img src="images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel" class="img-fluid" style="max-width: 200px; height: auto;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a href="deconnexion.php" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">Tableau de Bord Administrateur</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#validation-comptes">
                        <i class="bi bi-person-check"></i> Validation des Comptes
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#gestion-materiel">
                        <i class="bi bi-tools"></i> Gestion du Matériel
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#validation-reservations">
                        <i class="bi bi-calendar-check"></i> Validation des Réservations
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#retours-materiels">
                        <i class="bi bi-clipboard-check"></i> Retours Matériels
                    </a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="tab-content">
                    <!-- Section Validation des Comptes -->
                    <div class="tab-pane fade show active" id="validation-comptes">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Validation des Comptes</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Rôle</th>
                                                <th>Date d'inscription</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Le contenu sera chargé dynamiquement par JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Gestion du Matériel -->
                    <div class="tab-pane fade" id="gestion-materiel">
                        <div class="card">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Gestion du Matériel</h5>
                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#ajoutMaterielModal">
                                    <i class="bi bi-plus-lg"></i> Ajouter
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom</th>
                                                <th>Catégorie</th>
                                                <th>État</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Le contenu sera chargé dynamiquement par JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Validation des Réservations -->
                    <div class="tab-pane fade" id="validation-reservations">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Validation des Réservations</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Utilisateur</th>
                                                <th>Matériel/Salle</th>
                                                <th>Date début</th>
                                                <th>Date fin</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Le contenu sera chargé dynamiquement par JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Retours Matériels -->
                    <div class="tab-pane fade" id="retours-materiels">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Liste des Retours Matériels</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Matériel</th>
                                                <th>Utilisateur</th>
                                                <th>Date retour</th>
                                                <th>État retour</th>
                                                <th>Commentaire</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Le contenu sera chargé dynamiquement par JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajout/Modification Matériel -->
    <div class="modal fade" id="ajoutMaterielModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un Matériel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="materielForm">
                        <div class="mb-3">
                            <label class="form-label">Nom du matériel</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catégorie</label>
                            <select class="form-select" name="categorie" required>
                                <option value="">Sélectionner une catégorie</option>
                                <option value="VR">VR</option>
                                <option value="Audio">Audio</option>
                                <option value="Video">Vidéo</option>
                                <option value="Informatique">Informatique</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">État</label>
                            <select class="form-select" name="etat" required>
                                <option value="disponible">Disponible</option>
                                <option value="maintenance">En maintenance</option>
                                <option value="reserve">Réservé</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="sauvegarderMateriel()">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
</body>
</html> 