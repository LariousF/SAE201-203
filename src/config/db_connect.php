<?php

$db_host = 'localhost';         // Hôte de la base de données
$db_name = 'mmi_reservations';  // Nom de votre base de données
$db_user = 'root';              // Nom d'utilisateur
$db_pass = '';                  // Mot de passe
$db_charset = 'utf8mb4';        // Encodage

$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
    echo "Connexion à la base de données '$db_name' réussie.";

} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>
