
document.addEventListener('DOMContentLoaded', (e) => {
    const form = document.getElementById('FormResAdd');
    form.addEventListener('submit', (es) => {
        e.preventDefault();
        const det = document.getElementById('details').value;
        const dateC = document.getElementById('dateCreation').value;
        const messErr = document.getElementById('Err');
        messErr.style.display = 'none';
        messErr.textContent = NaN;
        if (!det || !dateC) {
            messErr.textContent = 'Must fill all the blanks!';
            messErr.style.display = 'block';
            messErr.style.color = 'red';
        } else if (det.length < 5) {
            messErr.textContent = 'Details are too short!';
            messErr.style.display = 'block';
            messErr.style.color = 'red';
        }
        else {
            messErr.textContent = 'Submission Successfull!';
            messErr.style.display = 'block';
            messErr.style.color = 'green';
            form.submit();

        }
    });
});








