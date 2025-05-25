document.addEventListener('DOMContentLoaded', function() {
    chargerReservations();
});

function chargerReservations() {
    fetch('api/get_user_reservations.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('reservationsTableBody');
            tbody.innerHTML = '';

            data.forEach(reservation => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${reservation.type}</td>
                    <td>${reservation.ressource}</td>
                    <td>${formatDate(reservation.date_debut)}</td>
                    <td>${formatDate(reservation.date_fin)}</td>
                    <td>
                        <span class="badge ${getBadgeClass(reservation.statut)}">
                            ${reservation.statut}
                        </span>
                    </td>
                    <td>
                        ${getActions(reservation)}
                    </td>
                `;
                tbody.appendChild(tr);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des réservations:', error);
            const tbody = document.getElementById('reservationsTableBody');
            tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Erreur lors du chargement des réservations</td></tr>';
        });
}

function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleString('fr-FR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function getBadgeClass(statut) {
    switch(statut.toLowerCase()) {
        case 'en attente':
            return 'bg-warning text-dark';
        case 'validé':
            return 'bg-success';
        case 'refusé':
            return 'bg-danger';
        case 'terminé':
            return 'bg-secondary';
        default:
            return 'bg-primary';
    }
}

function getActions(reservation) {
    let actions = '';
    
    if (reservation.statut.toLowerCase() === 'en attente') {
        actions += `
            <button class="btn btn-sm btn-danger" onclick="annulerReservation(${reservation.id})">
                <i class="bi bi-x-circle"></i> Annuler
            </button>
        `;
    }
    
    if (reservation.statut.toLowerCase() === 'validé') {
        actions += `
            <button class="btn btn-sm btn-info" onclick="voirDetails(${reservation.id})">
                <i class="bi bi-eye"></i> Détails
            </button>
        `;
    }
    
    return actions;
}

function annulerReservation(id) {
    if (confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')) {
        fetch('api/cancel_reservation.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                chargerReservations();
            } else {
                alert('Erreur lors de l\'annulation : ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de l\'annulation');
        });
    }
}

function voirDetails(id) {
    window.location.href = `details_reservation.php?id=${id}`;
} 