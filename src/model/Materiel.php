<?php

class Materiel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllMateriel($type = null) {
        $sql = "SELECT * FROM Materiel WHERE 1=1";
        $params = [];
        
        if ($type) {
            $sql .= " AND Type_Materiel = ?";
            $params[] = $type;
        }
        
        $sql .= " AND Etat_Global != 'En panne' ORDER BY Designation";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMaterielVR() {
        return $this->getAllMateriel('VR');
    }

    public function getMaterielById($id) {
        $sql = "SELECT * FROM Materiel WHERE ID_Materiel = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getQuantiteDisponible($id, $dateDebut, $dateFin) {
        $sql = "SELECT m.Quantite_Totale - COALESCE(SUM(r.Quantite_Reservee), 0) as disponible
                FROM Materiel m
                LEFT JOIN Reservation r ON m.ID_Materiel = r.ID_Materiel
                AND r.Statut = 'Validée'
                AND (
                    (r.Date_Debut <= ? AND r.Date_Fin >= ?)
                    OR (r.Date_Debut <= ? AND r.Date_Fin >= ?)
                    OR (r.Date_Debut >= ? AND r.Date_Fin <= ?)
                )
                WHERE m.ID_Materiel = ?
                GROUP BY m.ID_Materiel, m.Quantite_Totale";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$dateDebut, $dateDebut, $dateFin, $dateFin, $dateDebut, $dateFin, $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? intval($result['disponible']) : 0;
    }
} 