<?php

use PDO;

class Reservation {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createReservation($userId, $materielId = null, $salleId = null, $dateDebut, $dateFin, $quantite = 1, $motif = '') {
        $sql = "INSERT INTO Reservation (ID_Demandeur, ID_Materiel, ID_Salle, Date_Debut, Date_Fin, 
                Quantite_Reservee, Motif, Statut, Date_Demande) 
                VALUES (?, ?, ?, ?, ?, ?, ?, 'En attente', NOW())";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId, $materielId, $salleId, $dateDebut, $dateFin, $quantite, $motif]);
    }

    public function checkDisponibilite($materielId = null, $salleId = null, $dateDebut, $dateFin) {
        $sql = "SELECT COUNT(*) as count FROM Reservation 
                WHERE ((ID_Materiel = ? AND ? IS NOT NULL) OR (ID_Salle = ? AND ? IS NOT NULL))
                AND Statut != 'Annulée'
                AND (
                    (Date_Debut <= ? AND Date_Fin >= ?)
                    OR (Date_Debut <= ? AND Date_Fin >= ?)
                    OR (Date_Debut >= ? AND Date_Fin <= ?)
                )";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$materielId, $materielId, $salleId, $salleId, 
                       $dateDebut, $dateDebut, $dateFin, $dateFin, $dateDebut, $dateFin]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] == 0;
    }

    public function getReservationsEnAttente() {
        $sql = "SELECT r.*, u.Nom, u.Prenom, 
                m.Designation as Materiel_Nom, 
                s.Nom_Salle as Salle_Nom
                FROM Reservation r
                LEFT JOIN Utilisateur u ON r.ID_Demandeur = u.ID_Utilisateur
                LEFT JOIN Materiel m ON r.ID_Materiel = m.ID_Materiel
                LEFT JOIN Salle s ON r.ID_Salle = s.ID_Salle
                WHERE r.Statut = 'En attente'
                ORDER BY r.Date_Demande DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validerReservation($id, $gestionnaireId) {
        $sql = "UPDATE Reservation 
                SET Statut = 'Validée', 
                    ID_Gestionnaire = ?, 
                    Date_Validation = NOW() 
                WHERE ID_Reservation = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$gestionnaireId, $id]);
    }

    public function refuserReservation($id, $gestionnaireId, $commentaire = '') {
        $sql = "UPDATE Reservation 
                SET Statut = 'Refusée', 
                    ID_Gestionnaire = ?, 
                    Date_Validation = NOW(),
                    Commentaire_Refus = ?
                WHERE ID_Reservation = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$gestionnaireId, $commentaire, $id]);
    }
} 