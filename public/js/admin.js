        function validerCompte(id) {
            if(confirm('Êtes-vous sûr de vouloir valider ce compte ?')) {
                fetch('/Clone/SAE201-203/src/admin/valider_compte.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${id}&action=valider`
                })
                .then(handleFetchError)
                .then(result => {
                    if(result === 'success') {
                        alert('Compte validé avec succès');
                        // Recharger uniquement le tableau des comptes
                        fetch('/Clone/SAE201-203/src/admin/valider_compte.php')
                            .then(handleFetchError)
                            .then(html => {
                                const tbody = document.querySelector('#validation-comptes tbody');
                                if (tbody) {
                                    tbody.innerHTML = html;
                                }
                            });
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
                .then(handleFetchError)
                .then(result => {
                    if(result === 'success') {
                        alert('Compte refusé avec succès');
                        // Recharger uniquement le tableau des comptes
                        fetch('/Clone/SAE201-203/src/admin/valider_compte.php')
                            .then(handleFetchError)
                            .then(html => {
                                const tbody = document.querySelector('#validation-comptes tbody');
                                if (tbody) {
                                    tbody.innerHTML = html;
                                }
                            });
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
            fetch('/Clone/SAE201-203/src/admin/valider_reservation.php')
                .then(handleFetchError)
                .then(html => {
                    const tbody = document.querySelector('#validation-reservations tbody');
                    if (tbody) {
                        tbody.innerHTML = html;
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors du chargement des réservations');
                });

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