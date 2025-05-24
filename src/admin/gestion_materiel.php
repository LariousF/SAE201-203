<?php
require_once '../model/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $db = Database::getInstance();
    
    switch($action) {
        case 'ajouter':
        case 'modifier':
            $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
            $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $etat = isset($_POST['etat']) ? $_POST['etat'] : '';
            
            if ($action === 'ajouter') {
                $sql = "INSERT INTO Materiel (nom, categorie, description, etat) VALUES (?, ?, ?, ?)";
                $params = [$nom, $categorie, $description, $etat];
            } else {
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $sql = "UPDATE Materiel SET nom = ?, categorie = ?, description = ?, etat = ? WHERE id = ?";
                $params = [$nom, $categorie, $description, $etat, $id];
            }
            
            $stmt = $db->prepare($sql);
            if ($stmt->execute($params)) {
                echo "success";
            } else {
                echo "error";
            }
            break;
            
        case 'supprimer':
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            if ($id > 0) {
                $sql = "DELETE FROM Materiel WHERE id = ?";
                $stmt = $db->prepare($sql);
                if ($stmt->execute([$id])) {
                    echo "success";
                } else {
                    echo "error";
                }
            }
            break;
            
        case 'get':
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            if ($id > 0) {
                $sql = "SELECT * FROM Materiel WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$id]);
                $materiel = $stmt->fetch(PDO::FETCH_ASSOC);
                echo $materiel ? serialize($materiel) : "error";
            }
            break;
    }
}

// Récupérer la liste du matériel
function getMateriel() {
    $db = Database::getInstance();
    $sql = "SELECT * FROM Materiel ORDER BY categorie, nom";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 