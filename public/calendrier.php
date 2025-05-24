<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Réservation - Inventaire IUT</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link href="css/calendrier.css" rel="stylesheet"/>

</head>
<body>
    <div class="logo-container">
        <img src="images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel" class="img-fluid" style="max-width: 200px; height: auto;margin:10% 0 10% 25%">
    </div>
    <div class="container">
        <h1>Réservation - Inventaire IUT</h1>
        <div class="background-band"> </div>

        <?php
            // Récupérer le nom du matériel VR depuis le paramètre d'URL
            $equipment_name = isset($_GET['equipment_name']) ? htmlspecialchars($_GET['equipment_name']) : 'Matériel VR inconnu';
        ?>
        <div class="equipment-display">
            Matériel VR sélectionné : <span id="selectedEquipmentName"><?php echo $equipment_name; ?></span>
        </div>

        <div class="form-section">
            <label for="date">Choisir une date :</label>
            <input type="date" id="date" onchange="verifierDisponibilite()" />

            <label for="heure">Choisir une heure :</label>
            <input type="time" id="heure" min="08:00" max="18:00" />

            <button onclick="reserver()">Réserver</button>
            <div class="message" id="message"></div>
        </div>
    </div>

    <script>
        function estDateDisponible(jour) {
            const mod = (jour - 1) % 5;
            return mod < 3; // 1-3 disponibles, 4-5 non
        }

        function verifierDisponibilite() {
            const inputDate = document.getElementById("date");
            const selectedDate = inputDate.value;
            const jour = parseInt(selectedDate.split("-")[2]);
            if (isNaN(jour)) return;
            inputDate.style.color = estDateDisponible(jour) ? "green" : "red";
        }

        async function reserver() {
            const date = document.getElementById("date").value;
            const heure = document.getElementById("heure").value;
            const messageDiv = document.getElementById("message");
            const equipmentName = document.getElementById("selectedEquipmentName").textContent; // Récupérer le nom du matériel

            if (!date || !heure) {
                messageDiv.textContent = "Veuillez remplir tous les champs.";
                messageDiv.className = "message error";
                return;
            }

            const jour = parseInt(date.split("-")[2]);
            const disponible = estDateDisponible(jour);

            const [h, m] = heure.split(":").map(Number);
            const heureValide = h >= 8 && h <= 18;

            if (!heureValide || !disponible) {
                messageDiv.textContent = "Réservation impossible (date ou heure non valide).";
                messageDiv.className = "message error";
                return;
            }

            // --- CHANGEMENT ICI : Préparation des données pour un envoi POST non-JSON ---
            const formData = new URLSearchParams();
            formData.append('equipment_name', equipmentName);
            formData.append('date', date);
            formData.append('heure', heure);
            // --- FIN DU CHANGEMENT ---

            // Envoi des données au serveur via Fetch API
            try {
                const response = await fetch('process_reservation_vr.php', {
                    method: 'POST',
                    headers: {
                        // --- CHANGEMENT ICI : Le Content-Type pour les données de formulaire URL-encodées ---
                        'Content-Type': 'application/x-www-form-urlencoded',
                        // --- FIN DU CHANGEMENT ---
                    },
                    // --- CHANGEMENT ICI : Le corps de la requête est maintenant formData ---
                    body: formData.toString(),
                    // --- FIN DU CHANGEMENT ---
                });

                // Puisque nous n'attendons plus du JSON, nous lisons la réponse comme du texte
                const resultText = await response.text();

                // Vous devrez analyser la réponse textuelle si vous voulez des messages structurés
                // Pour un cas simple, nous pouvons juste afficher le texte, ou vérifier s'il contient "succès"
                if (resultText.includes("succès")) { // Adaptez cette condition à ce que votre PHP renvoie
                    messageDiv.textContent = resultText;
                    messageDiv.className = "message success";
                } else {
                    messageDiv.textContent = resultText;
                    messageDiv.className = "message error";
                }

            } catch (error) {
                console.error('Erreur lors de l\'envoi de la réservation:', error);
                messageDiv.textContent = "Une erreur est survenue lors de la réservation.";
                messageDiv.className = "message error";
            }
        }
    </script>
</body>
</html>