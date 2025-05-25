<?php
session_start();

// Définir les chemins de base s'ils ne sont pas déjà définis
if (!defined('BASE_URL')) {
    define('BASE_URL', '/Clone/SAE201-203');
}
if (!defined('PUBLIC_URL')) {
    define('PUBLIC_URL', BASE_URL . '/public');
}

require_once 'db_connect.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $pseudo = trim($_POST['pseudo'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $confirm_mot_de_passe = $_POST['confirm_mot_de_passe'] ?? '';
    $date_naissance_str = trim($_POST['date_naissance'] ?? '');
    $adresse_postale = trim($_POST['adresse_postale'] ?? '');
    $role = trim($_POST['role'] ?? '');

    $errors = [];
    if (!$email) {
        $errors[] = "L'adresse email n'est pas valide.";
    }
    if (empty($pseudo)) { $errors[] = "Le pseudo est requis."; }
    if (empty($nom)) { $errors[] = "Le nom est requis."; }
    if (empty($prenom)) { $errors[] = "Le prénom est requis."; }
    
    // Validation améliorée de la date de naissance
    if (empty($date_naissance_str)) {
        $errors[] = "La date de naissance est requise.";
    } elseif (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date_naissance_str)) {
        $errors[] = "Le format de la date de naissance n'est pas valide (AAAA-MM-JJ).";
    } else {
        $date_obj = DateTime::createFromFormat('Y-m-d', $date_naissance_str);
        if (!$date_obj || $date_obj->format('Y-m-d') !== $date_naissance_str) {
            $errors[] = "La date de naissance n'est pas valide.";
        } else {
            $date_naissance = $date_naissance_str;
        }
    }

    // Validation améliorée de l'adresse postale
    if (empty($adresse_postale)) {
        $errors[] = "L'adresse postale est requise.";
    } elseif (strlen($adresse_postale) < 10) {
        $errors[] = "L'adresse postale doit contenir au moins 10 caractères.";
    }

    if (empty($role) || !in_array($role, ['Etudiant', 'Enseignant', 'Administrateur', 'Agent'])) {
        $errors[] = "Veuillez sélectionner un rôle valide.";
    }
    if (empty($mot_de_passe)) {
        $errors[] = "Le mot de passe est requis.";
    } elseif (strlen($mot_de_passe) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
    }
    if ($mot_de_passe !== $confirm_mot_de_passe) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    $specific_fields_valid = true;
    switch ($role) {
        case 'Etudiant':
            $numero_etudiant = trim($_POST['numero_etudiant'] ?? '');
            $promotion = trim($_POST['promotion'] ?? '');
            $td = trim($_POST['td'] ?? '');
            $tp = trim($_POST['tp'] ?? '');
            if (empty($numero_etudiant)) { $errors[] = "Le numéro étudiant est requis."; $specific_fields_valid = false;}
            if (empty($promotion)) { $errors[] = "La promotion est requise."; $specific_fields_valid = false;}
            if (empty($td)) { $errors[] = "Le groupe TD est requis."; $specific_fields_valid = false;}
            if (empty($tp)) { $errors[] = "Le groupe TP est requis."; $specific_fields_valid = false;}
            break;
        case 'Enseignant':
            $qualification = trim($_POST['qualification'] ?? '');
            $fonction = trim($_POST['fonction'] ?? '');
            $telephone_pro = trim($_POST['telephone_pro'] ?? '');
            if (empty($qualification)) { $errors[] = "La qualification est requise."; $specific_fields_valid = false;}
            if (empty($telephone_pro)) { $errors[] = "Le téléphone professionnel est requis."; $specific_fields_valid = false;}
            if (empty($fonction)) { $errors[] = "La fonction est requise."; $specific_fields_valid = false;}
            break;
        case 'Administrateur':
            $bureau = trim($_POST['bureau'] ?? '');         
            if (empty($bureau)) { $errors[] = "Le bureau est requis."; $specific_fields_valid = false;}
            break;
        case 'Agent':
            break;
    }

    if (!empty($errors)) {
        $_SESSION['form_message'] = implode("<br>", $errors);
        $_SESSION['form_message_type'] = 'danger';
        return ['success' => false, 'message' => 'Une erreur est survenue lors de l\'inscription.'];
    }

    $hash_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    try {
        $pdo->beginTransaction();

        $sqlUser = "INSERT INTO Utilisateur (Email, Pseudo, Nom, Prenom, Mot_de_passe, Date_Naissance, Adresse_Postale, Role, Est_Actif)
                    VALUES (:email, :pseudo, :nom, :prenom, :mot_de_passe, :date_naissance, :adresse_postale, :role, FALSE)";
        
        $stmtUser = $pdo->prepare($sqlUser);
        $stmtUser->execute([
            ':email' => $email,
            ':pseudo' => $pseudo,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':mot_de_passe' => $hash_password,
            ':date_naissance' => $date_naissance,
            ':adresse_postale' => $adresse_postale,
            ':role' => $role,
        ]);

        $id_utilisateur = $pdo->lastInsertId();

        switch ($role) {
            case 'Etudiant':
                $sqlRole = "INSERT INTO Etudiant (ID_Utilisateur, Numero_etudiant, Promotion, TD, TP) VALUES (:id_utilisateur, :num_etudiant, :promo, :td, :tp)";
                $stmtRole = $pdo->prepare($sqlRole);
                $stmtRole->execute([
                    ':id_utilisateur' => $id_utilisateur,
                    ':num_etudiant' => $numero_etudiant,
                    ':promo' => $promotion,
                    ':td' => $td,
                    ':tp' => $tp
                ]);
                break;
            case 'Enseignant':
                $sqlRole = "INSERT INTO Enseignant (ID_Utilisateur, Qualification, Fonction, Telephone_pro_enseignant) VALUES (:id_utilisateur, :qualification, :fonction, :tel_pro)";
                $stmtRole = $pdo->prepare($sqlRole);
                $stmtRole->execute([
                    ':id_utilisateur' => $id_utilisateur,
                    ':qualification' => $qualification,
                    ':fonction' => $fonction,
                    ':tel_pro_enseignant' => $telephone_pro_enseignant
                ]);
                break;
            case 'Administrateur':
                $sqlRole = "INSERT INTO Administrateur (ID_Utilisateur, Bureau, Telephone_pro) VALUES (:id_utilisateur, :bureau, :tel_pro)";
                $stmtRole = $pdo->prepare($sqlRole);
                $stmtRole->execute([
                    ':id_utilisateur' => $id_utilisateur,
                    ':bureau' => $bureau,
                    ':tel_pro' => $telephone_pro
                ]);
                break;
            case 'Agent':
                $sqlRole = "INSERT INTO Agent (ID_Utilisateur) VALUES (:id_utilisateur)";
                $stmtRole = $pdo->prepare($sqlRole);
                $stmtRole->execute([':id_utilisateur' => $id_utilisateur]);
                break;
        }

        $pdo->commit();

        return ['success' => true, 'message' => 'Inscription réussie ! Vous pouvez maintenant vous connecter.'];

    } catch (PDOException $e) {
        $pdo->rollBack();
        if ($e->errorInfo[1] == 1062) {
             $_SESSION['form_message'] = "Erreur : cet email ou pseudo est déjà utilisé.";
        } else {
             $_SESSION['form_message'] = "Erreur lors de l'inscription : " . $e->getMessage();
        }
        $_SESSION['form_message_type'] = 'danger';
        return ['success' => false, 'message' => 'Une erreur est survenue lors de l\'inscription.'];
    }
} else {
    $_SESSION['form_message'] = "Méthode non autorisée pour accéder à cette page.";
    $_SESSION['form_message_type'] = 'warning';
    return ['success' => false, 'message' => 'Méthode non autorisée pour accéder à cette page.'];
}
?>