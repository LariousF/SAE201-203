<?php
require_once '../src/model/db_connect.php';
require_once '../src/model/authentification.php';

$auth->logout();

header('Location: connexion.php');
exit;
?> 