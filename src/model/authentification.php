<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définir les chemins de base s'ils ne sont pas déjà définis
if (!defined('BASE_URL')) {
    define('BASE_URL', '/Clone/SAE201-203');
}
if (!defined('PUBLIC_URL')) {
    define('PUBLIC_URL', BASE_URL . '/public');
}

require_once 'db_connect.php';

class Authentification {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Connexion utilisateur
    public function login($email, $password) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT u.*, 
                    CASE 
                        WHEN e.ID_Utilisateur IS NOT NULL THEN 'Etudiant'
                        WHEN en.ID_Utilisateur IS NOT NULL THEN 'Enseignant'
                        WHEN a.ID_Utilisateur IS NOT NULL THEN 'Administrateur'
                        ELSE u.Role
                    END as Role_Effectif
                FROM Utilisateur u
                LEFT JOIN Etudiant e ON u.ID_Utilisateur = e.ID_Utilisateur
                LEFT JOIN Enseignant en ON u.ID_Utilisateur = en.ID_Utilisateur
                LEFT JOIN Administrateur a ON u.ID_Utilisateur = a.ID_Utilisateur
                WHERE u.Email = ?
            ");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['Mot_de_passe'])) {
                if (!$user['Est_Actif']) {
                    return ['success' => false, 'message' => 'Votre compte est en attente de validation par un administrateur.'];
                }
                
                // Stocker toutes les informations importantes dans la session
                $_SESSION['user_id'] = $user['ID_Utilisateur'];
                $_SESSION['user_role'] = $user['Role_Effectif'];
                $_SESSION['user_email'] = $user['Email'];
                $_SESSION['user_pseudo'] = $user['Pseudo'];
                $_SESSION['user_nom'] = $user['Nom'];
                $_SESSION['user_prenom'] = $user['Prenom'];
                $_SESSION['est_actif'] = $user['Est_Actif'];
                
                return ['success' => true, 'user' => $user];
            }
            
            return ['success' => false, 'message' => 'Email ou mot de passe incorrect.'];
            
        } catch (PDOException $e) {
            error_log("Erreur de connexion : " . $e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de la connexion.'];
        }
    }
    
    // Vérifier si l'utilisateur est connecté
    public function isLoggedIn() {
        return isset($_SESSION['user_id']) && isset($_SESSION['user_role']);
    }
    
    // Vérifier le rôle de l'utilisateur
    public function hasRole($role) {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
    }
    
    // Vérifier si l'utilisateur est administrateur
    public function isAdmin() {
        return $this->hasRole('Administrateur');
    }
    
    // Récupérer les informations de l'utilisateur connecté
    public function getCurrentUser() {
        if (!$this->isLoggedIn()) {
            return null;
        }
        
        try {
            $stmt = $this->pdo->prepare("
                SELECT u.*, 
                    e.Numero_etudiant, e.Promotion, e.TD, e.TP,
                    en.Qualification, en.Fonction,
                    a.Bureau
                FROM Utilisateur u
                LEFT JOIN Etudiant e ON u.ID_Utilisateur = e.ID_Utilisateur
                LEFT JOIN Enseignant en ON u.ID_Utilisateur = en.ID_Utilisateur
                LEFT JOIN Administrateur a ON u.ID_Utilisateur = a.ID_Utilisateur
                WHERE u.ID_Utilisateur = ?
            ");
            $stmt->execute([$_SESSION['user_id']]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des informations utilisateur : " . $e->getMessage());
            return null;
        }
    }
    
    // Déconnexion
    public function logout() {
        session_unset();
        session_destroy();
        return ['success' => true, 'message' => 'Déconnexion réussie.'];
    }
    
    // Inscription d'un nouvel utilisateur
    public function register($userData) {
        try {
            $this->pdo->beginTransaction();
            
            // Vérifier si l'email existe déjà
            $stmt = $this->pdo->prepare("SELECT ID_Utilisateur FROM Utilisateur WHERE Email = ?");
            $stmt->execute([$userData['email']]);
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'Cet email est déjà utilisé.'];
            }
            
            // Insérer l'utilisateur de base
            $stmt = $this->pdo->prepare("
                INSERT INTO Utilisateur (Email, Pseudo, Nom, Prenom, Mot_de_passe, Role, Est_Actif)
                VALUES (?, ?, ?, ?, ?, ?, FALSE)
            ");
            
            $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
            
            $stmt->execute([
                $userData['email'],
                $userData['pseudo'],
                $userData['nom'],
                $userData['prenom'],
                $hashedPassword,
                $userData['role']
            ]);
            
            $userId = $this->pdo->lastInsertId();
            
            // Insérer les informations spécifiques selon le rôle
            switch ($userData['role']) {
                case 'Etudiant':
                    $stmt = $this->pdo->prepare("
                        INSERT INTO Etudiant (ID_Utilisateur, Numero_etudiant, Promotion)
                        VALUES (?, ?, ?)
                    ");
                    $stmt->execute([$userId, $userData['numero_etudiant'], $userData['promotion']]);
                    break;
                    
                case 'Enseignant':
                    $stmt = $this->pdo->prepare("
                        INSERT INTO Enseignant (ID_Utilisateur, Qualification, Fonction)
                        VALUES (?, ?, ?)
                    ");
                    $stmt->execute([$userId, $userData['qualification'], $userData['fonction']]);
                    break;
            }
            
            $this->pdo->commit();
            return ['success' => true, 'message' => 'Inscription réussie !'];
            
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Erreur d'inscription : " . $e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de l\'inscription.'];
        }
    }
}

// Créer une instance de la classe d'authentification
$auth = new Authentification($connexion);

// Fonction utilitaire pour vérifier les permissions
function checkPermission($requiredRole = null) {
    global $auth;
    
    if (!$auth->isLoggedIn()) {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            return [
                'success' => false,
                'message' => 'Session expirée',
                'error_code' => 4
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Vous devez être connecté pour accéder à cette page.',
                'error_code' => 4
            ];
        }
    }
    
    if ($requiredRole && !$auth->hasRole($requiredRole)) {
        return [
            'success' => false,
            'message' => 'Vous n\'avez pas les permissions nécessaires.',
            'error_code' => 403
        ];
    }
    
    return ['success' => true];
}
?>