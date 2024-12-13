
document.addEventListener('DOMContentLoaded', (e) => {
    const form = document.getElementById('FormEventAdd');
    form.addEventListener('submit', (es) => {
        if (!document.getElementById('flexSwitchCheckDefault').checked) {
            document.getElementById('flexSwitchCheckDefault').value = 0;
            alert("No Seats Left");
        } else {
            document.getElementById('flexSwitchCheckDefault').value = 1;
                        alert("Seats Availables");
        }
        es.preventDefault();
        const titre = document.getElementById('title').value;
        const desc = document.getElementById('description').value;
        const price = document.getElementById('price').value;
        const messErr = document.getElementById('Err');
        messErr.style.display = 'none';
        messErr.textContent = NaN;
        if (!titre || !price || !desc) {
            messErr.textContent = 'Must fill all the blanks';
            messErr.style.display = 'block';
            form.style.borderColor = 'red';
            messErr.style.color = 'red';
        } else if ((!/^[a-zA-Z\s]+$/.test(titre)) || titre.length < 3) {
            messErr.textContent = 'Title Must contain at least 3 chars and no special character!';
            messErr.style.display = 'block';
            form.style.borderColor = 'red';
            messErr.style.color = 'red';
        }
        else if (price < 0) {
            messErr.textContent = 'Price cant be negative!';
            messErr.style.display = 'block';
            form.style.borderColor = 'red';
            messErr.style.color = 'red';
        }
        else if (desc.length < 3) {
            messErr.textContent = 'Description is too short!';
            messErr.style.display = 'block';
            messErr.style.color = 'red';
            form.style.borderColor = 'red';

        }
        else {
            messErr.textContent = 'Submission Successfull!';
            messErr.style.display = 'block';
            messErr.style.color = 'green';
            form.style.borderColor = 'green';

            form.submit();
        }
    })



    
})
       
function sortReservations(field, direction) {
    const container = document.getElementById('reservationList');
    const cards = Array.from(container.getElementsByClassName('card'));

    cards.sort((a, b) => {
        let fieldA = a.dataset[field].toLowerCase();
        let fieldB = b.dataset[field].toLowerCase();

        if (field === 'dateCreation') {
            fieldA = new Date(fieldA);
            fieldB = new Date(fieldB);
        }

        if (fieldA < fieldB) {
            return direction === 'asc' ? -1 : 1;
        }
        if (fieldA > fieldB) {
            return direction === 'asc' ? 1 : -1;
        }
        return 0;
    });

    container.innerHTML = '';
    cards.forEach(card => container.appendChild(card));
}   
function searchReservations() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('#reservationList .card');

    cards.forEach(card => {
        const title = card.dataset.eventTitle.toLowerCase();
        card.style.display = title.includes(input) ? '' : 'none';
    });
}

function Alert() {
    alert("Authentication is not working yet!");
}
function registerHere() {
        alert("Coming Soon!...");
}