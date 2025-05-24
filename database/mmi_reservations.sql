-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 24 mai 2025 à 21:38
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mmi_reservations`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `ID_Utilisateur` int(10) UNSIGNED NOT NULL,
  `Bureau` varchar(50) DEFAULT NULL COMMENT 'Numéro ou localisation du bureau',
  `Telephone_pro` varchar(20) DEFAULT NULL COMMENT 'Numéro de téléphone professionnel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`ID_Utilisateur`, `Bureau`, `Telephone_pro`) VALUES
(2, 'Bureau 101', '0601020304');

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `ID_Utilisateur` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consultation_reservation_agent`
--

CREATE TABLE `consultation_reservation_agent` (
  `ID_Consultation` int(10) UNSIGNED NOT NULL,
  `ID_Reservation` int(10) UNSIGNED NOT NULL,
  `ID_Agent` int(10) UNSIGNED NOT NULL,
  `Date_Consultation` datetime NOT NULL DEFAULT current_timestamp(),
  `Action_Effectuee` varchar(100) DEFAULT NULL COMMENT 'Ex: Clé remise, Matériel vérifié au retour'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `ID_Utilisateur` int(10) UNSIGNED NOT NULL,
  `Qualification` varchar(100) DEFAULT NULL COMMENT 'Domaine de compétence ou diplôme',
  `Fonction` varchar(100) DEFAULT NULL COMMENT 'Ex: Professeur, Maître de conférences',
  `Telephone_pro_enseignant` varchar(20) DEFAULT NULL COMMENT 'Numéro de téléphone professionnel de l enseignant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `ID_Utilisateur` int(10) UNSIGNED NOT NULL,
  `Numero_etudiant` varchar(20) DEFAULT NULL COMMENT 'Numéro étudiant unique',
  `Promotion` varchar(50) DEFAULT NULL COMMENT 'Année ou nom de la promotion',
  `TD` varchar(50) DEFAULT NULL COMMENT 'Groupe de TD',
  `TP` varchar(50) DEFAULT NULL COMMENT 'Groupe de TP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`ID_Utilisateur`, `Numero_etudiant`, `Promotion`, `TD`, `TP`) VALUES
(3, '085123', 'MM1', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `ID_Materiel` int(10) UNSIGNED NOT NULL,
  `Reference_Materiel` varchar(50) DEFAULT NULL COMMENT 'Référence unique interne ou fabricant',
  `Designation` varchar(100) NOT NULL COMMENT 'Nom clair du matériel',
  `Type_Materiel` varchar(50) DEFAULT NULL COMMENT 'Catégorie (ex: Caméra, Micro, VR)',
  `Date_Achat` date DEFAULT NULL COMMENT 'Date d acquisition du matériel',
  `Etat_Global` varchar(50) NOT NULL DEFAULT 'Bon' COMMENT 'Ex: Très bon, Bon, En panne, Réparation',
  `Quantite_Totale` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Nombre total d unités de ce matériel',
  `Descriptif` text DEFAULT NULL COMMENT 'Description détaillée, usages possibles',
  `Photo_Path` varchar(255) DEFAULT NULL COMMENT 'Chemin relatif ou URL de la photo principale',
  `Lien_Demo` varchar(512) DEFAULT NULL COMMENT 'URL vers une vidéo ou page de démonstration'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `ID_Message` int(10) UNSIGNED NOT NULL,
  `ID_Reservation` int(10) UNSIGNED NOT NULL,
  `ID_Auteur` int(10) UNSIGNED NOT NULL COMMENT 'Utilisateur qui a écrit le message',
  `Contenu` text NOT NULL,
  `Date_Message` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ID_Reservation` int(10) UNSIGNED NOT NULL,
  `ID_Demandeur` int(10) UNSIGNED NOT NULL COMMENT 'Utilisateur (étudiant, enseignant) qui fait la demande',
  `ID_Materiel` int(10) UNSIGNED DEFAULT NULL COMMENT 'Matériel réservé (NULL si réservation de salle seule)',
  `Quantite_Reservee` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Nombre d unités réservées pour ce matériel',
  `ID_Salle` int(10) UNSIGNED DEFAULT NULL COMMENT 'Salle réservée (NULL si réservation de matériel seul)',
  `Date_Debut` datetime NOT NULL COMMENT 'Date et heure de début de la réservation',
  `Date_Fin` datetime NOT NULL COMMENT 'Date et heure de fin de la réservation',
  `Motif` text DEFAULT NULL COMMENT 'Raison de la réservation',
  `Liste_Participants` text DEFAULT NULL COMMENT 'Noms ou numéros étudiants des autres participants (si pertinent)',
  `Commentaire_Demandeur` text DEFAULT NULL COMMENT 'Commentaire libre du demandeur',
  `Statut` varchar(20) NOT NULL DEFAULT 'En attente' COMMENT 'Statut actuel: En attente, Validée, Refusée, Annulée, Terminee',
  `Date_Demande` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Date et heure de la soumission de la demande',
  `ID_Gestionnaire` int(10) UNSIGNED DEFAULT NULL COMMENT 'Admin ou Enseignant qui a validé/refusé (selon les règles)',
  `Date_Decision` datetime DEFAULT NULL COMMENT 'Date et heure de la validation ou du refus',
  `Commentaire_Gestionnaire` text DEFAULT NULL COMMENT 'Commentaire de l admin/enseignant lors de la décision',
  `Signature_Demandeur` text DEFAULT NULL COMMENT 'Placeholder pour une éventuelle signature électronique (ex: hash, timestamp)',
  `Signature_Gestionnaire` text DEFAULT NULL COMMENT 'Placeholder pour la signature électronique du gestionnaire'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `ID_Salle` int(10) UNSIGNED NOT NULL,
  `Nom_Salle` varchar(50) NOT NULL COMMENT 'Nom ou numéro unique de la salle',
  `Type_Salle` varchar(50) DEFAULT NULL COMMENT 'Ex: Salle de réunion, Studio vidéo, Salle TP',
  `Capacite` int(10) UNSIGNED DEFAULT NULL COMMENT 'Nombre de places assises/personnes max',
  `Equipements_Specifiques` text DEFAULT NULL COMMENT 'Liste des équipements fixes importants',
  `Est_Reservable` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'La salle peut-elle être réservée via l appli ?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID_Utilisateur` int(10) UNSIGNED NOT NULL,
  `Email` varchar(100) NOT NULL COMMENT 'Adresse email unique de connexion',
  `Pseudo` varchar(50) NOT NULL COMMENT 'Pseudo unique choisi par l utilisateur',
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL COMMENT 'Prénom de l utilisateur',
  `Mot_de_passe` varchar(255) NOT NULL COMMENT 'HASH du mot de passe (NE JAMAIS stocker en clair)',
  `Date_Naissance` date DEFAULT NULL COMMENT 'Date de naissance de l utilisateur',
  `Adresse_Postale` text DEFAULT NULL COMMENT 'Adresse postale complète',
  `Role` varchar(20) NOT NULL COMMENT 'Rôle principal (Etudiant, Enseignant, Agent, Admin)',
  `Est_Actif` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Indique si le compte est actif (1) ou désactivé (0)',
  `Date_Inscription` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Date et heure de création du compte'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_Utilisateur`, `Email`, `Pseudo`, `Nom`, `Prenom`, `Mot_de_passe`, `Date_Naissance`, `Adresse_Postale`, `Role`, `Est_Actif`, `Date_Inscription`) VALUES
(2, 'b.raphaelmail@gmail.com', 'raphael.boullard', 'BOULLARD', 'Raphael', '$2y$10$iS7sguFf1MHgexSoD5a.QuiYB8l5YyuF6Mglj4/4SN4qQgjme3Id2', NULL, NULL, 'Administrateur', 1, '2025-05-24 12:24:26'),
(3, 'gotty@gmail.com', 'bordel', 'Boulbi', 'Fejj', '$2y$10$CUy9zOJ.mv76DlfiICjTg.ffLegg1TjMlaCWOwy3f4o5HNaFqBJO.', NULL, NULL, 'Etudiant', 1, '2025-05-24 14:43:09');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`ID_Utilisateur`);

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`ID_Utilisateur`);

--
-- Index pour la table `consultation_reservation_agent`
--
ALTER TABLE `consultation_reservation_agent`
  ADD PRIMARY KEY (`ID_Consultation`),
  ADD UNIQUE KEY `uk_consultation` (`ID_Reservation`,`ID_Agent`,`Action_Effectuee`) COMMENT 'Evite les doublons exacts si nécessaire',
  ADD KEY `ID_Agent` (`ID_Agent`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`ID_Utilisateur`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`ID_Utilisateur`),
  ADD UNIQUE KEY `Numero_etudiant` (`Numero_etudiant`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`ID_Materiel`),
  ADD UNIQUE KEY `Reference_Materiel` (`Reference_Materiel`),
  ADD KEY `idx_type_materiel` (`Type_Materiel`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID_Message`),
  ADD KEY `ID_Reservation` (`ID_Reservation`),
  ADD KEY `ID_Auteur` (`ID_Auteur`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ID_Reservation`),
  ADD KEY `ID_Gestionnaire` (`ID_Gestionnaire`),
  ADD KEY `idx_demandeur` (`ID_Demandeur`),
  ADD KEY `idx_materiel` (`ID_Materiel`),
  ADD KEY `idx_salle` (`ID_Salle`),
  ADD KEY `idx_statut` (`Statut`),
  ADD KEY `idx_dates` (`Date_Debut`,`Date_Fin`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`ID_Salle`),
  ADD UNIQUE KEY `Nom_Salle` (`Nom_Salle`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID_Utilisateur`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Pseudo` (`Pseudo`),
  ADD KEY `idx_role` (`Role`),
  ADD KEY `idx_email` (`Email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `consultation_reservation_agent`
--
ALTER TABLE `consultation_reservation_agent`
  MODIFY `ID_Consultation` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `ID_Materiel` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `ID_Message` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID_Reservation` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `ID_Salle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID_Utilisateur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateur` (`ID_Utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateur` (`ID_Utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `consultation_reservation_agent`
--
ALTER TABLE `consultation_reservation_agent`
  ADD CONSTRAINT `consultation_reservation_agent_ibfk_1` FOREIGN KEY (`ID_Reservation`) REFERENCES `reservation` (`ID_Reservation`) ON DELETE CASCADE,
  ADD CONSTRAINT `consultation_reservation_agent_ibfk_2` FOREIGN KEY (`ID_Agent`) REFERENCES `agent` (`ID_Utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateur` (`ID_Utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateur` (`ID_Utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`ID_Reservation`) REFERENCES `reservation` (`ID_Reservation`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`ID_Auteur`) REFERENCES `utilisateur` (`ID_Utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`ID_Demandeur`) REFERENCES `utilisateur` (`ID_Utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`ID_Materiel`) REFERENCES `materiel` (`ID_Materiel`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`ID_Salle`) REFERENCES `salle` (`ID_Salle`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`ID_Gestionnaire`) REFERENCES `utilisateur` (`ID_Utilisateur`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
