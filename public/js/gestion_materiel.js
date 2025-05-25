document.addEventListener('DOMContentLoaded', function() {
    chargerMateriel();
});

function chargerMateriel() {
    fetch('api/get_materiel.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#gestion-materiel table tbody');
            tbody.innerHTML = '';

            data.forEach(item => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${item.Reference_Materiel || ''}</td>
                    <td>${item.Designation}</td>
                    <td>${item.Type_Materiel || ''}</td>
                    <td>
                        <span class="badge ${getEtatBadgeClass(item.Etat_Global)}">
                            ${item.Etat_Global}
                        </span>
                    </td>
                    <td>${item.Quantite_Totale}</td>
                    <td>
                        <button class="btn btn-sm btn-primary me-1" onclick="modifierMateriel(${item.ID_Materiel})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="supprimerMateriel(${item.ID_Materiel})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement du matériel');
        });
}

function getEtatBadgeClass(etat) {
    switch(etat.toLowerCase()) {
        case 'très bon':
            return 'bg-success';
        case 'bon':
            return 'bg-info';
        case 'en panne':
            return 'bg-danger';
        case 'réparation':
            return 'bg-warning text-dark';
        default:
            return 'bg-secondary';
    }
}

function ajouterMateriel() {
    const form = document.getElementById('ajoutMaterielForm');
    const formData = new FormData(form);
    const data = {
        action: 'add',
        reference: formData.get('reference'),
        designation: formData.get('designation'),
        type: formData.get('type'),
        etat: formData.get('etat'),
        quantite: parseInt(formData.get('quantite')),
        descriptif: formData.get('descriptif')
    };

    fetch('api/manage_materiel.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('ajoutMaterielModal'));
            modal.hide();
            form.reset();
            chargerMateriel();
        } else {
            alert('Erreur: ' + (result.error || 'Une erreur est survenue'));
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la sauvegarde');
    });
}

function modifierMateriel(id) {
    fetch(`api/get_materiel.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (!data || data.error) {
                alert('Erreur lors de la récupération des données du matériel');
                return;
            }

            const form = document.getElementById('modifMaterielForm');
            
            // Remplir le formulaire avec les données existantes
            form.querySelector('[name="id"]').value = data.ID_Materiel;
            form.querySelector('[name="reference"]').value = data.Reference_Materiel || '';
            form.querySelector('[name="designation"]').value = data.Designation || '';
            form.querySelector('[name="type"]').value = data.Type_Materiel || '';
            form.querySelector('[name="etat"]').value = data.Etat_Global || '';
            form.querySelector('[name="quantite"]').value = data.Quantite_Totale || 1;
            form.querySelector('[name="descriptif"]').value = data.Descriptif || '';
            
            // Afficher le modal de modification
            const modal = new bootstrap.Modal(document.getElementById('modifMaterielModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de la récupération des données du matériel');
        });
}

function sauvegarderModification() {
    const form = document.getElementById('modifMaterielForm');
    const formData = new FormData(form);
    const data = {
        action: 'update',
        id: parseInt(formData.get('id')),
        reference: formData.get('reference'),
        designation: formData.get('designation'),
        type: formData.get('type'),
        etat: formData.get('etat'),
        quantite: parseInt(formData.get('quantite')),
        descriptif: formData.get('descriptif')
    };

    fetch('api/manage_materiel.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('modifMaterielModal'));
            modal.hide();
            chargerMateriel();
        } else {
            alert('Erreur: ' + (result.error || 'Une erreur est survenue'));
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la modification');
    });
}

function supprimerMateriel(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce matériel ?')) {
        fetch('api/manage_materiel.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'delete',
                id: id
            })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                chargerMateriel();
            } else {
                alert('Erreur: ' + (result.error || 'Une erreur est survenue'));
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de la suppression');
        });
    }
}

// Réinitialiser le formulaire lors de l'ouverture du modal d'ajout
document.getElementById('ajoutMaterielModal').addEventListener('show.bs.modal', function (event) {
    const form = document.getElementById('materielForm');
    form.reset();
    form.dataset.mode = 'add';
    delete form.dataset.id;
}); 