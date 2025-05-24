document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role');
    const etudiantFields = document.getElementById('champsEtudiant');
    const enseignantFields = document.getElementById('champsEnseignant');
    const adminFields = document.getElementById('champsAgent');

    const allSpecificFieldsContainers = [etudiantFields, enseignantFields, agentFields];

    function toggleFields() {
        allSpecificFieldsContainers.forEach(container => {
            if (container) {
                container.style.display = 'none';
                container.querySelectorAll('input, select, textarea').forEach(input => {
                    input.required = false;
                });
            }
        });

        const selectedRole = roleSelect.value;
        let currentFieldsContainer = null;

        if (selectedRole === 'Etudiant') {
            currentFieldsContainer = etudiantFields;
        } else if (selectedRole === 'Enseignant') {
            currentFieldsContainer = enseignantFields;
        } else if (selectedRole === 'Agent') {
            currentFieldsContainer = agentFields;
        }

        if (currentFieldsContainer) {
            currentFieldsContainer.style.display = 'block';
            currentFieldsContainer.querySelectorAll('input, select, textarea').forEach(input => {
                input.required = true;
            });
        }
    }

    if (roleSelect) {
        roleSelect.addEventListener('change', toggleFields);
        toggleFields();
    }
});