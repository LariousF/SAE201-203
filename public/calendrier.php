<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Réservation - Inventaire IUT</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f5f5f5; /* fond modifié */
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      width: 90%;
      max-width: 600px;
      padding: 20px;
      background-color: white;
      border: 2px solid #ccc; /* encadrement général */
      border-radius: 8px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-section {
      margin-top: 10px;
      margin-bottom: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      width: 100%;
    }

    label {
      font-weight: 600;
      align-self: flex-start;
    }

    input, button {
      padding: 10px;
      font-size: 16px;
      width: 100%;
      box-sizing: border-box;
      border-radius: 4px;
      border: 1px solid #ccc;
      font-family: 'Poppins', sans-serif;
    }

    input[type="date"] {
      color: black;
    }

    button {
      background-color: white;
      border: 2px solid #1a4f9c; /* bleu bordure */
      color: #1a4f9c;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    button:hover {
      background-color: #1a4f9c;
      color: white;
    }

    .message {
      margin-top: 15px;
      font-weight: bold;
      text-align: center;
    }

    .success {
      color: green;
    }

    .error {
      color: red;
    }

    .background-band {
    position: fixed;       /* toujours visible, même en scroll */
    top: 50%;              /* position verticale au milieu */
    left: 0;
    width: 100vw;          /* largeur de toute la fenêtre */
    height: 5cm;           /* hauteur fixe comme tu souhaitais */
    background-color: #1a4f9c;  /* bleu nuit clair */
    transform: translateY(-50%); /* ajuste pour bien centrer la bande */
    z-index: -1;           /* derrière tout le contenu */
    }

    </style>
<div class="logo-container">
     <img src="images/logo_univ_gustave_eiffel.png" alt="Logo Université Gustave Eiffel" class="img-fluid" style="max-width: 200px; height: auto;margin:10% 0 10% 25%">
    </a>
  </style>
</head>
<body>
  <div class="container">
    <h1>Réservation - Inventaire IUT</h1>
    <div class="background-band"> </div>
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

    function reserver() {
      const date = document.getElementById("date").value;
      const heure = document.getElementById("heure").value;
      const message = document.getElementById("message");

      if (!date || !heure) {
        message.textContent = "Veuillez remplir tous les champs.";
        message.className = "message error";
        return;
      }

      const jour = parseInt(date.split("-")[2]);
      const disponible = estDateDisponible(jour);

      const [h, m] = heure.split(":").map(Number);
      const heureValide = h >= 8 && h <= 18;

      if (!heureValide || !disponible) {
        message.textContent = "Réservation impossible";
        message.className = "message error";
      } else {
        message.textContent = "Réservation validée";
        message.className = "message success";
      }
    }
  </script>
</body>
</html>
