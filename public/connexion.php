<<<<<<< HEAD
<?php
require_once 'src/config/db_connect.php';
require_once 'src/model/authentification.php';
=======
<?php 
require_once '../src/config/db_connect.php';

session_start();

$message = '';

//Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Recuper les values du formulaire
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($email) && !empty($password)) {
        try {
            //Recupere l'utilisateur par l'email
            $stmt = $pdo->prepare("SELECT ID_Utilisateur, Email, Mot_de_passe FROM Utilisateur WHERE Email = ?");
            $stmt->execute([$email]);
            $utilisateur = $stmt->fetch();
            
            //Verifie le mot de passe
            if ($utilisateur && password_verify($password, $utilisateur['Mot_de_passe'])) {
                // Connexion réussie
                $_SESSION['user_id'] = $utilisateur['ID_Utilisateur'];
                $_SESSION['email'] = $utilisateur['Email'];
                
                //Redirige vers la page accueil
                header("Location: accueil.php");
                exit;
            } else {
                $message = "Email ou mot de passe incorrect";
            }
        } catch (PDOException $e) {
            $message = "Erreur de connexion";
        }
    } else {
        $message = "Veuillez remplir tous les champs";
    }
}
>>>>>>> 31ee146134b0e95340828209a0bcd3e07cea3924
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>