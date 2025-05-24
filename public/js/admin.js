        function validerCompte(id) {
            if(confirm('Êtes-vous sûr de vouloir valider ce compte ?')) {
                fetch('/Clone/SAE201-203/src/admin/valider_compte.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${id}&action=valider`
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Compte validé avec succès');
                        // Recharger la liste des comptes
                        rechargerComptesEnAttente();
                    } else {
                        alert('Erreur : ' + result);
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue');
                });
            }
        }

        function refuserCompte(id) {
            if(confirm('Êtes-vous sûr de vouloir refuser ce compte ? Cette action est irréversible.')) {
                fetch('/Clone/SAE201-203/src/admin/valider_compte.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${id}&action=refuser`
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Compte refusé avec succès');
                        // Recharger la liste des comptes
                        rechargerComptesEnAttente();
                    } else {
                        alert('Erreur : ' + result);
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue');
                });
            }
        }

        function rechargerComptesEnAttente() {
            fetch('/Clone/SAE201-203/src/admin/valider_compte.php')
                .then(response => response.text())
                .then(html => {
                    const tbody = document.querySelector('#validation-comptes tbody');
                    if (tbody) {
                        tbody.innerHTML = html;
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du rechargement:', error);
                });
        }

        // Fonctions de gestion du matériel
        function modifierMateriel(id) {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('action', 'get');
            
            fetch('/Clone/SAE201-203/src/admin/gestion_materiel.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                if(result !== 'error') {
                    const materiel = unserialize(result);
                    const modal = document.getElementById('ajoutMaterielModal');
                    
                    // Remplir le formulaire
                    modal.querySelector('[name="nom"]').value = materiel.nom;
                    modal.querySelector('[name="categorie"]').value = materiel.categorie;
                    modal.querySelector('[name="description"]').value = materiel.description;
                    modal.querySelector('[name="etat"]').value = materiel.etat;
                    
                    // Changer le titre et l'action
                    modal.querySelector('.modal-title').textContent = 'Modifier le matériel';
                    const form = modal.querySelector('form');
                    form.dataset.action = 'modifier';
                    form.dataset.id = id;
                    
                    new bootstrap.Modal(modal).show();
                }
            });
        }

        function supprimerMateriel(id) {
            if(confirm('Êtes-vous sûr de vouloir supprimer ce matériel ?')) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('action', 'supprimer');
                
                fetch('/Clone/SAE201-203/src/admin/gestion_materiel.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Matériel supprimé avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de la suppression');
                    }
                });
            }
        }

        function sauvegarderMateriel() {
            const form = document.getElementById('materielForm');
            if(form.checkValidity()) {
                const formData = new FormData(form);
                formData.append('action', form.dataset.action || 'ajouter');
                if(form.dataset.id) {
                    formData.append('id', form.dataset.id);
                }
                
                fetch('/Clone/SAE201-203/src/admin/gestion_materiel.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Matériel sauvegardé avec succès');
                        bootstrap.Modal.getInstance(document.getElementById('ajoutMaterielModal')).hide();
                        location.reload();
                    } else {
                        alert('Erreur lors de la sauvegarde');
                    }
                });
            } else {
                form.reportValidity();
            }
        }

        // Fonctions de gestion des réservations
        function validerReservation(id) {
            if(confirm('Confirmer la validation de cette réservation ?')) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('action', 'valider');
                
                fetch('/Clone/SAE201-203/src/admin/valider_reservation.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Réservation validée avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de la validation');
                    }
                });
            }
        }

        function refuserReservation(id) {
            if(confirm('Confirmer le refus de cette réservation ?')) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('action', 'refuser');
                
                fetch('/Clone/SAE201-203/src/admin/valider_reservation.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    if(result === 'success') {
                        alert('Réservation refusée');
                        location.reload();
                    } else {
                        alert('Erreur lors du refus');
                    }
                });
            }
        }

        // Fonction utilitaire pour désérialiser les données PHP
        function unserialize(data) {
            const str = data.replace(/\n/g, '');
            const pairs = str.split(';');
            const obj = {};
            
            for(let i = 0; i < pairs.length; i++) {
                const pair = pairs[i].split(':');
                if(pair.length === 2) {
                    obj[pair[0]] = pair[1];
                }
            }
            
            return obj;
        }

        // Charger les données au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour gérer les erreurs de fetch
            function handleFetchError(response) {
                if (!response.ok) {
                    throw new Error(`Erreur HTTP: ${response.status}`);
                }
                return response.text();
            }

            // Charger les comptes en attente
            fetch('/Clone/SAE201-203/src/admin/valider_compte.php')
                .then(handleFetchError)
                .then(html => {
                    const tbody = document.querySelector('#validation-comptes tbody');
                    if (tbody) {
                        tbody.innerHTML = html;
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors du chargement des comptes en attente');
                });

            // Charger le matériel
            fetch('/Clone/SAE201-203/src/admin/gestion_materiel.php')
                .then(handleFetchError)
                .then(html => {
                    const tbody = document.querySelector('#gestion-materiel tbody');
                    if (tbody) {
                        tbody.innerHTML = html;
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors du chargement du matériel');
                });

            // Charger les réservations en attente
            loadPendingReservations();

            // Charger les retours de matériel
            fetch('/Clone/SAE201-203/src/admin/gestion_retours.php')
                .then(handleFetchError)
                .then(html => {
                    const tbody = document.querySelector('#retours-materiels tbody');
                    if (tbody) {
                        tbody.innerHTML = html;
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors du chargement des retours');
                });
        });

        function loadPendingReservations() {
            fetch('../src/model/get_pending_reservations.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('#validation-reservations table tbody');
                    tbody.innerHTML = '';

                    data.forEach(reservation => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${reservation.Prenom} ${reservation.Nom}</td>
                            <td>${reservation.Item_Name} (${reservation.Item_Type})</td>
                            <td>${formatDateTime(reservation.Date_Debut)}</td>
                            <td>${formatDateTime(reservation.Date_Fin)}</td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="handleReservation(${reservation.ID_Reservation}, 'Validée')">
                                    <i class="bi bi-check-lg"></i> Valider
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="handleReservation(${reservation.ID_Reservation}, 'Refusée')">
                                    <i class="bi bi-x-lg"></i> Refuser
                                </button>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue lors du chargement des réservations');
                });
        }

        function handleReservation(reservationId, status) {
            if (!confirm(`Êtes-vous sûr de vouloir ${status === 'Validée' ? 'valider' : 'refuser'} cette réservation ?`)) {
                return;
            }

            const formData = new FormData();
            formData.append('reservation_id', reservationId);
            formData.append('status', status);

            fetch('../src/model/update_reservation_status.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert(result.message);
                    loadPendingReservations(); // Recharger la liste
                } else {
                    alert(result.message || 'Une erreur est survenue');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de la mise à jour du statut');
            });
        }

        function formatDateTime(dateTime) {
            const date = new Date(dateTime);
            return date.toLocaleString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }