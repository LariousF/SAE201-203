<?php
// Ne pas démarrer une nouvelle session ici car elle est déjà démarrée dans les fichiers qui incluent celui-ci

// Définir les chemins de base s'ils ne sont pas déjà définis
if (!defined('BASE_URL')) {
    define('BASE_URL', '/Clone/SAE201-203');
}
if (!defined('PUBLIC_URL')) {
    define('PUBLIC_URL', BASE_URL . '/public');
}

require_once 'db_connect.php';
