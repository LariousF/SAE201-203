CREATE TABLE Utilisateur (
  ID_Utilisateur INT UNSIGNED AUTO_INCREMENT,
  Email VARCHAR(100) NOT NULL UNIQUE COMMENT 'Adresse email unique de connexion',
  Pseudo VARCHAR(50) NOT NULL UNIQUE COMMENT 'Pseudo unique choisi par l utilisateur (Nom.Prenom conseillé)',
  Nom VARCHAR(50) NOT NULL,
  Prenom VARCHAR(50) NOT NULL COMMENT 'Prénom de l utilisateur',
  Mot_de_passe VARCHAR(255) NOT NULL COMMENT 'HASH du mot de passe (NE JAMAIS stocker en clair)',
  Date_Naissance DATE NULL COMMENT 'Date de naissance de l utilisateur',
  Adresse_Postale TEXT NULL COMMENT 'Adresse postale complète',
  Role VARCHAR(20) NOT NULL COMMENT 'Rôle principal (Etudiant, Enseignant, Agent, Admin)',
  Est_Actif BOOLEAN NOT NULL DEFAULT TRUE COMMENT 'Indique si le compte est actif (1) ou non-actif (0)',
  Date_Inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de création du compte',
  PRIMARY KEY(ID_Utilisateur),
  INDEX idx_role (Role),
  INDEX idx_email (Email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Etudiant (
  ID_Utilisateur INT UNSIGNED,
  Numero_etudiant VARCHAR(20) NULL UNIQUE COMMENT 'Numéro étudiant unique',
  Promotion VARCHAR(50) NULL COMMENT 'Année ou nom de la promotion',
  TD VARCHAR(50) NULL COMMENT 'Groupe de TD',
  TP VARCHAR(50) NULL COMMENT 'Groupe de TP',
  PRIMARY KEY(ID_Utilisateur),
  FOREIGN KEY(ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Enseignant (
  ID_Utilisateur INT UNSIGNED,
  Qualification VARCHAR(100) NULL COMMENT 'Domaine de compétence ou diplôme',
  Fonction VARCHAR(100) NULL COMMENT 'Ex: Professeur, Maître de conférences',
  PRIMARY KEY(ID_Utilisateur),
  FOREIGN KEY(ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Administrateur (
  ID_Utilisateur INT UNSIGNED,
  Bureau VARCHAR(50) NULL COMMENT 'Numéro ou localisation du bureau',
  Telephone_pro VARCHAR(20) NULL COMMENT 'Numéro de téléphone professionnel',
  PRIMARY KEY(ID_Utilisateur),
  FOREIGN KEY(ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Agent (
  ID_Utilisateur INT UNSIGNED,
  PRIMARY KEY(ID_Utilisateur),
  FOREIGN KEY(ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Materiel (
  ID_Materiel INT UNSIGNED AUTO_INCREMENT,
  Reference_Materiel VARCHAR(50) NULL UNIQUE COMMENT 'Référence unique interne ou fabricant',
  Designation VARCHAR(100) NOT NULL COMMENT 'Nom clair du matériel',
  Type_Materiel VARCHAR(50) NULL COMMENT 'Catégorie (ex: Caméra, Micro, VR)',
  Date_Achat DATE NULL COMMENT 'Date d acquisition du matériel',
  Etat_Global VARCHAR(50) NOT NULL DEFAULT 'Bon' COMMENT 'Ex: Très bon, Bon, En panne, Réparation',
  Quantite_Totale INT UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Nombre total d unités de ce matériel',
  Descriptif TEXT NULL COMMENT 'Description détaillée, usages possibles',
  Photo_Path VARCHAR(255) NULL COMMENT 'Chemin relatif ou URL de la photo principale',
  Lien_Demo VARCHAR(512) NULL COMMENT 'URL vers une vidéo ou page de démonstration',
  PRIMARY KEY(ID_Materiel),
  INDEX idx_type_materiel (Type_Materiel)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Salle (
  ID_Salle INT UNSIGNED AUTO_INCREMENT,
  Nom_Salle VARCHAR(50) NOT NULL UNIQUE COMMENT 'Nom ou numéro unique de la salle',
  Type_Salle VARCHAR(50) NULL COMMENT 'Ex: Salle de réunion, Studio vidéo, Salle TP',
  Capacite INT UNSIGNED NULL COMMENT 'Nombre de places assises/personnes max',
  Equipements_Specifiques TEXT NULL COMMENT 'Liste des équipements fixes importants',
  Est_Reservable BOOLEAN NOT NULL DEFAULT TRUE COMMENT 'La salle peut-elle être réservée via l appli ?',
  PRIMARY KEY(ID_Salle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Reservation (
  ID_Reservation INT UNSIGNED AUTO_INCREMENT,
  ID_Demandeur INT UNSIGNED NOT NULL COMMENT 'Utilisateur (étudiant, enseignant) qui fait la demande',
  ID_Materiel INT UNSIGNED NULL COMMENT 'Matériel réservé (NULL si réservation de salle seule)',
  Quantite_Reservee INT UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Nombre d unités réservées pour ce matériel',
  ID_Salle INT UNSIGNED NULL COMMENT 'Salle réservée (NULL si réservation de matériel seul)',
  Date_Debut DATETIME NOT NULL COMMENT 'Date et heure de début de la réservation',
  Date_Fin DATETIME NOT NULL COMMENT 'Date et heure de fin de la réservation',
  Motif TEXT NULL COMMENT 'Raison de la réservation',
  Liste_Participants TEXT NULL COMMENT 'Noms ou numéros étudiants des autres participants (si pertinent)',
  Commentaire_Demandeur TEXT NULL COMMENT 'Commentaire libre du demandeur',
  Statut VARCHAR(20) NOT NULL DEFAULT 'En attente' COMMENT 'Statut actuel: En attente, Validée, Refusée, Annulée, Terminee',
  Date_Demande DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de la soumission de la demande',
  ID_Gestionnaire INT UNSIGNED NULL COMMENT 'Admin ou Enseignant qui a validé/refusé (selon les règles)',
  Date_Decision DATETIME NULL COMMENT 'Date et heure de la validation ou du refus',
  Commentaire_Gestionnaire TEXT NULL COMMENT 'Commentaire de l admin/enseignant lors de la décision',
  Signature_Demandeur TEXT NULL COMMENT 'Placeholder pour une éventuelle signature électronique (ex: hash, timestamp)',
  Signature_Gestionnaire TEXT NULL COMMENT 'Placeholder pour la signature électronique du gestionnaire',
  PRIMARY KEY(ID_Reservation),
  FOREIGN KEY(ID_Demandeur) REFERENCES Utilisateur(ID_Utilisateur)
    ON DELETE CASCADE,
  FOREIGN KEY(ID_Materiel) REFERENCES Materiel(ID_Materiel)
    ON DELETE SET NULL,
  FOREIGN KEY(ID_Salle) REFERENCES Salle(ID_Salle)
    ON DELETE SET NULL,
  FOREIGN KEY(ID_Gestionnaire) REFERENCES Utilisateur(ID_Utilisateur)
    ON DELETE SET NULL,
  INDEX idx_demandeur (ID_Demandeur),
  INDEX idx_materiel (ID_Materiel),
  INDEX idx_salle (ID_Salle),
  INDEX idx_statut (Statut),
  INDEX idx_dates (Date_Debut, Date_Fin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Message (
  ID_Message INT UNSIGNED AUTO_INCREMENT,
  ID_Reservation INT UNSIGNED NOT NULL,
  ID_Auteur INT UNSIGNED NOT NULL COMMENT 'Utilisateur qui a écrit le message',
  Contenu TEXT NOT NULL,
  Date_Message DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(ID_Message),
  FOREIGN KEY(ID_Reservation) REFERENCES Reservation(ID_Reservation)
    ON DELETE CASCADE,
  FOREIGN KEY(ID_Auteur) REFERENCES Utilisateur(ID_Utilisateur)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Consultation_Reservation_Agent (
  ID_Consultation INT UNSIGNED AUTO_INCREMENT,
  ID_Reservation INT UNSIGNED NOT NULL,
  ID_Agent INT UNSIGNED NOT NULL,
  Date_Consultation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  Action_Effectuee VARCHAR(100) NULL COMMENT 'Ex: Clé remise, Matériel vérifié au retour',
  PRIMARY KEY(ID_Consultation),
  UNIQUE KEY uk_consultation (ID_Reservation, ID_Agent, Action_Effectuee) COMMENT 'Evite les doublons exacts si nécessaire',
  FOREIGN KEY(ID_Reservation) REFERENCES Reservation(ID_Reservation)
    ON DELETE CASCADE,
  FOREIGN KEY(ID_Agent) REFERENCES Agent(ID_Utilisateur) 
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
