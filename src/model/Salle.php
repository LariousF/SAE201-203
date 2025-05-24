<?php

class Salle {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllSalles() {
        $sql = "SELECT * FROM Salle WHERE Est_Reservable = 1 ORDER BY Nom_Salle";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSalleById($id) {
        $sql = "SELECT * FROM Salle WHERE ID_Salle = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkDisponibilite($salleId, $dateDebut, $dateFin) {
        $sql = "SELECT COUNT(*) as count 
                FROM Reservation 
                WHERE ID_Salle = ?
                AND Statut IN ('En attente', 'Validée')
                AND (
                    (Date_Debut <= ? AND Date_Fin >= ?)
                    OR (Date_Debut <= ? AND Date_Fin >= ?)
                    OR (Date_Debut >= ? AND Date_Fin <= ?)
                )";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$salleId, $dateDebut, $dateDebut, $dateFin, $dateFin, $dateDebut, $dateFin]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['count'] == 0;
    }

    public function getReservationsSalle($salleId, $date) {
        $sql = "SELECT r.Date_Debut, r.Date_Fin, u.Nom, u.Prenom
                FROM Reservation r
                JOIN Utilisateur u ON r.ID_Demandeur = u.ID_Utilisateur
                WHERE r.ID_Salle = ?
                AND DATE(r.Date_Debut) = ?
                AND r.Statut = 'Validée'
                ORDER BY r.Date_Debut ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$salleId, $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 