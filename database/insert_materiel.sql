-- Insertion du matériel dans la base de données
INSERT INTO materiel (Reference_Materiel, Designation, Type_Materiel, Etat_Global, Quantite_Totale, Descriptif, Photo_Path) VALUES
-- Matériel VR
('VR-META-01', 'Casque VR Meta', 'VR', 'Bon', 1, 'Casque de réalité virtuelle Meta Quest', 'images/casque vr meta.jpg'),
('VR-META-MAN-01', 'Manettes VR Meta', 'VR', 'Bon', 2, 'Paire de manettes pour casque VR Meta Quest', 'images/manette vr meta.jpg'),
('VR-OCULUS-01', 'Casque VR Oculus', 'VR', 'Bon', 1, 'Casque de réalité virtuelle Oculus', 'images/casque vr occulus.JPG'),
('VR-OCULUS-MAN-01', 'Manettes VR Oculus', 'VR', 'Bon', 2, 'Paire de manettes pour casque VR Oculus', 'images/manettes vr occulus.JPG'),
('VR-CABLE-01', 'Câble VR', 'VR', 'Bon', 1, 'Câble de connexion pour casque VR', 'images/cable vr.JPG'),

-- Matériel Audio
('AUDIO-CASQUE-01', 'Casque Audio', 'Audio', 'Bon', 1, 'Casque audio professionnel', 'images/casque audio.jpg'),
('AUDIO-CASQUE-02', 'Casque Audio 2', 'Audio', 'Bon', 1, 'Casque audio professionnel', 'images/casque audio 02.JPG'),
('AUDIO-MICRO-01', 'Microphone', 'Audio', 'Bon', 1, 'Microphone professionnel', 'images/micro.jpg'),

-- Matériel Photo/Vidéo
('VIDEO-CAM-GOPRO-01', 'Caméra GoPro', 'Vidéo', 'Bon', 1, 'Caméra d''action GoPro', 'images/camera go pro.jpg'),
('VIDEO-CAM-SONNETTE-01', 'Caméra Sonnette', 'Vidéo', 'Bon', 1, 'Caméra de type sonnette connectée', 'images/camera sonette.JPG'),
('VIDEO-PROJ-01', 'Vidéoprojecteur', 'Vidéo', 'Bon', 1, 'Vidéoprojecteur professionnel', 'images/video projecteur .jpg'),
('VIDEO-PIED-01', 'Pied Caméra', 'Vidéo', 'Bon', 1, 'Pied/Trépied pour caméra', 'images/pied camera.jpg'),
('VIDEO-PERCHE-01', 'Perche', 'Vidéo', 'Bon', 1, 'Perche pour prise de vue', 'images/perche 02.JPG'),
('VIDEO-WEBCAM-01', 'Webcam', 'Vidéo', 'Bon', 1, 'Webcam haute définition', 'images/Webcam.JPG'),

-- Matériel Gaming
('GAMING-MANETTE-01', 'Manette de Jeux', 'Gaming', 'Bon', 1, 'Manette de jeux vidéo', 'images/manette jeux .jpg'),

-- Matériel Tablettes
('TAB-GRAPH-01', 'Tablette Graphique', 'Tablette', 'Bon', 1, 'Tablette graphique pour dessin numérique', 'images/tablette graphique.JPG'),
('TAB-AND-01', 'Tablette Android', 'Tablette', 'Bon', 1, 'Tablette Android', 'images/tablette android.JPG'),

-- Autres équipements
('DRONE-01', 'Drone', 'Drone', 'Bon', 1, 'Drone pour prise de vue aérienne', 'images/drone .JPG'),
('SUPPORT-01', 'Support', 'Support', 'Bon', 1, 'Support universel', 'images/support.JPG'),
('LOGITECH-01', 'Équipement Logitech', 'Périphérique', 'Bon', 1, 'Périphérique Logitech', 'images/logitech 01.JPG');

-- Insertion des salles
INSERT INTO salle (Nom_Salle, Type_Salle, Capacite, Est_Reservable) VALUES
('Salle 138', 'Salle de cours', 30, 1),
('Salle 212', 'Salle de cours', 30, 1); 