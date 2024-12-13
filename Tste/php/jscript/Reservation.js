document.addEventListener('DOMContentLoaded', (e) => {
    const form = document.getElementById('FormResAdd');
    const messErr = document.getElementById('Err');

    form.addEventListener('submit', (es) => {
        const det = document.getElementById('details').value;
        const dateC = document.getElementById('dateCreation').value;

        messErr.style.display = 'none';
        messErr.textContent = '';

        let hsErr = 0;

        if (!det || !dateC) {
            messErr.textContent = 'Must fill all the blanks!';
            messErr.style.display = 'block';
            messErr.style.color = 'red';
            hsErr = 1;
        } else if (det.length < 5) {
            messErr.textContent = 'Details are too short!';
            messErr.style.display = 'block';
            messErr.style.color = 'red';
            hsErr = 1;
        }

        // Soumettre le formulaire uniquement si pas d'erreur
        if (hsErr === 0) {
            messErr.textContent = 'Submission Successful!';
            messErr.style.display = 'block';
            messErr.style.color = 'green';
            // Décommenter pour voir si cela fonctionne sans validation
            // form.submit();
        }

        if (hsErr) {
            es.preventDefault();
        }
    });

    toggleDateReservation();
});