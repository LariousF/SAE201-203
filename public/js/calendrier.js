// Variables globales pour la sélection
let currentDate = new Date();
let selectedDate = null;
let startTime = null;
let endTime = null;
let isDragging = false;

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    updateCalendar();
    document.getElementById('prevMonth').addEventListener('click', () => changeMonth(-1));
    document.getElementById('nextMonth').addEventListener('click', () => changeMonth(1));
    
    // Ajouter l'écouteur d'événement pour le bouton de réservation
    const reservationButton = document.getElementById('reservation-button');
    reservationButton.addEventListener('click', function(e) {
        e.preventDefault();
        confirmerReservation();
    });
});

function updateCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    
    // Mise à jour du titre du mois
    const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                      'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;

    // Calcul des jours du mois
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const startingDay = firstDay.getDay() || 7; // Convertir 0 (dimanche) en 7
    
    // Génération du calendrier
    const calendarDates = document.getElementById('calendar-dates');
    calendarDates.innerHTML = '';

    // Ajouter les cases vides pour le début du mois
    for (let i = 1; i < startingDay; i++) {
        const emptyDay = document.createElement('div');
        emptyDay.className = 'calendar-day empty';
        calendarDates.appendChild(emptyDay);
    }

    // Ajouter les jours du mois
    for (let day = 1; day <= lastDay.getDate(); day++) {
        const dateDiv = document.createElement('div');
        dateDiv.className = 'calendar-day';
        const currentDateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        
        // Vérifier si c'est un jour ouvré
        const dayDate = new Date(year, month, day);
        const isWeekend = dayDate.getDay() === 0 || dayDate.getDay() === 6;
        const isPast = dayDate < new Date().setHours(0,0,0,0);

        if (isWeekend || isPast) {
            dateDiv.classList.add('disabled');
        } else {
            dateDiv.classList.add('available');
            dateDiv.addEventListener('click', () => selectDate(currentDateString));
        }

        // Ajouter un indicateur si il y a des réservations ce jour
        const hasReservations = reservations.some(r => r.Date_Debut.startsWith(currentDateString));
        if (hasReservations) {
            const indicator = document.createElement('div');
            indicator.className = 'reservation-indicator';
            dateDiv.appendChild(indicator);
        }

        dateDiv.innerHTML += day;
        calendarDates.appendChild(dateDiv);
    }
}

function selectDate(dateString) {
    selectedDate = dateString;
    document.querySelectorAll('.calendar-day').forEach(day => day.classList.remove('selected'));
    event.currentTarget.classList.add('selected');
    updateTimeGrid(dateString);
}

function updateTimeGrid(dateString) {
    const container = document.getElementById('reservations-container');
    container.innerHTML = `
        <div id="time-cursor" class="time-cursor" style="display: none;"></div>
        <div id="time-slot-selector" class="time-slot-selector" style="display: none;"></div>
    `;

    // Filtrer les réservations pour la date sélectionnée
    const dayReservations = reservations.filter(r => r.Date_Debut.startsWith(dateString));

    dayReservations.forEach(reservation => {
        const startTime = new Date(reservation.Date_Debut);
        const endTime = new Date(reservation.Date_Fin);
        const duration = (endTime - startTime) / (1000 * 60 * 60);
        const startHour = startTime.getHours();
        const startMinutes = startTime.getMinutes();

        const reservationEl = document.createElement('div');
        reservationEl.className = 'reservation-block';
        reservationEl.style.top = `${(startHour - 8 + startMinutes/60) * 60}px`;
        reservationEl.style.height = `${duration * 60}px`;
        reservationEl.style.backgroundColor = reservation.Statut === 'Validée' ? '#4CAF50' : '#FFA726';
        
        const tooltip = document.createElement('div');
        tooltip.className = 'reservation-tooltip';
        tooltip.textContent = `${reservation.Prenom} ${reservation.Nom}
                             ${startTime.getHours()}:${String(startTime.getMinutes()).padStart(2, '0')} - 
                             ${endTime.getHours()}:${String(endTime.getMinutes()).padStart(2, '0')}
                             (${reservation.Statut})`;
        
        reservationEl.appendChild(tooltip);
        container.appendChild(reservationEl);
    });

    // Ajouter les événements de sélection
    setupTimeSelection(container);
}

function setupTimeSelection(container) {
    const cursor = document.getElementById('time-cursor');
    const selector = document.getElementById('time-slot-selector');
    
    function calculateTimeFromPosition(y, rect) {
        // On travaille avec 11.25 heures (de 8h à 19h15)
        const totalHours = 11.25;
        const startHour = 8;
        
        // Calculer la position relative (0 à 1)
        const relativePosition = y / rect.height;
        
        // Convertir en heures (0 à 11.25)
        const hourDecimal = relativePosition * totalHours;
        
        // Calculer l'heure exacte (8 à 19)
        const hour = Math.floor(hourDecimal) + startHour;
        
        // Calculer les minutes (0 à 59)
        const minutes = Math.floor((hourDecimal % 1) * 60);
        // Arrondir aux 15 minutes les plus proches
        const roundedMinutes = Math.floor(minutes / 15) * 15;
        
        // Calculer le pourcentage exact pour le positionnement
        const exactPercentage = (hourDecimal / totalHours) * 100;
        
        return {
            hour: Math.min(19, Math.max(8, hour)),
            minutes: hour === 19 ? Math.min(15, roundedMinutes) : roundedMinutes,
            percentage: Math.min(100, Math.max(0, exactPercentage))
        };
    }

    container.addEventListener('mousemove', (e) => {
        const rect = container.getBoundingClientRect();
        const y = e.clientY - rect.top;
        
        // S'assurer que y est dans les limites
        const boundedY = Math.min(rect.height, Math.max(0, y));
        const time = calculateTimeFromPosition(boundedY, rect);
        
        cursor.style.top = `${time.percentage}%`;
        cursor.style.display = 'block';
        cursor.setAttribute('data-time', 
            `${String(time.hour).padStart(2, '0')}:${String(time.minutes).padStart(2, '0')}`);
    });

    container.addEventListener('mousedown', (e) => {
        const rect = container.getBoundingClientRect();
        const boundedY = Math.min(rect.height, Math.max(0, e.clientY - rect.top));
        const time = calculateTimeFromPosition(boundedY, rect);
        
        startTime = time.percentage;
        isDragging = true;
        
        selector.style.top = `${time.percentage}%`;
        selector.style.height = '0';
        selector.style.display = 'block';
    });

    container.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        
        const rect = container.getBoundingClientRect();
        const y = e.clientY - rect.top;
        const time = calculateTimeFromPosition(y, rect);
        
        const top = Math.min(startTime, time.percentage);
        const height = Math.abs(time.percentage - startTime);
        
        selector.style.top = `${top}%`;
        selector.style.height = `${height}%`;
        
        updateSelectedTimeText(startTime, time.percentage);
    });

    document.addEventListener('mouseup', () => {
        if (!isDragging) return;
        isDragging = false;

        const top = parseFloat(selector.style.top);
        const height = parseFloat(selector.style.height);
        endTime = top + height;
        
        document.getElementById('reservation-button').disabled = false;
    });
}

function updateSelectedTimeText(startPercentage, endPercentage) {
    // Convertir les pourcentages en minutes (675 minutes = 11.25 heures)
    const startMinutes = (startPercentage / 100) * 675;
    const endMinutes = (endPercentage / 100) * 675;
    
    // Calculer les heures et minutes
    const startHour = Math.floor(startMinutes / 60) + 8;
    const startMin = Math.floor((startMinutes % 60) / 15) * 15;
    const endHour = Math.floor(endMinutes / 60) + 8;
    const endMin = Math.floor((endMinutes % 60) / 15) * 15;
    
    // Limiter à 19h15
    const finalEndHour = Math.min(19, endHour);
    const finalEndMin = finalEndHour === 19 ? Math.min(15, endMin) : endMin;
    
    document.getElementById('selected-time-text').textContent = 
        `Plage sélectionnée : ${String(startHour).padStart(2, '0')}:${String(startMin).padStart(2, '0')} - ${String(finalEndHour).padStart(2, '0')}:${String(finalEndMin).padStart(2, '0')}`;
}

function changeMonth(delta) {
    currentDate.setMonth(currentDate.getMonth() + delta);
    updateCalendar();
}

async function confirmerReservation() {
    if (!selectedDate || startTime === null || endTime === null) {
        document.getElementById('message').textContent = "Veuillez sélectionner une date et une plage horaire";
        return;
    }

    // Convertir les pourcentages en heures et minutes
    const minutesStart = (startTime / 100) * (11.25 * 60);
    const minutesEnd = (endTime / 100) * (11.25 * 60);
    
    // Calculer les heures et minutes de début
    const startHour = Math.floor(minutesStart / 60) + 8;
    const startMinutes = Math.floor((minutesStart % 60) / 15) * 15;
    
    // Calculer les heures et minutes de fin
    const endHour = Math.floor(minutesEnd / 60) + 8;
    const endMinutes = Math.floor((minutesEnd % 60) / 15) * 15;

    // Limiter à 19h15
    const finalEndHour = Math.min(19, endHour);
    const finalEndMinutes = finalEndHour === 19 ? Math.min(15, endMinutes) : endMinutes;

    const formData = new FormData();
    formData.append('item_name', itemName);
    formData.append('item_type', itemType);
    formData.append('item_id', itemId);
    formData.append('date', selectedDate);
    formData.append('heure_debut', `${String(startHour).padStart(2, '0')}:${String(startMinutes).padStart(2, '0')}`);
    formData.append('heure_fin', `${String(finalEndHour).padStart(2, '0')}:${String(finalEndMinutes).padStart(2, '0')}`);

    try {
        const response = await fetch('../src/model/reserver.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        const messageDiv = document.getElementById('message');
        
        if (result.success) {
            messageDiv.textContent = result.message;
            messageDiv.className = 'message success';
            
            // Attendre 2 secondes avant de rediriger
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 2000);
        } else {
            messageDiv.textContent = result.message;
            messageDiv.className = 'message error';
        }
    } catch (error) {
        const messageDiv = document.getElementById('message');
        messageDiv.textContent = "Une erreur est survenue lors de la communication avec le serveur";
        messageDiv.className = 'message error';
    }
} 