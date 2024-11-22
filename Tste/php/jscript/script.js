
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
        const desc = document.getElementById('descr').value;
        const price = document.getElementById('price').value;
        const messErr = document.getElementById('Err');
        messErr.style.display = 'none';
        messErr.textContent = NaN;
        if (!titre || !price || !desc) {
            messErr.textContent = 'Must fill all the blanks';
            messErr.style.display = 'block';
            messErr.style.color = 'red';
        } else if ((!/^[a-zA-Z\s]+$/.test(titre)) || titre.length < 3) {
            messErr.textContent = 'Title Must contain at least 3 chars and no special character!';
            messErr.style.display = 'block';
            messErr.style.color = 'red';
        }
        else if (price < 0) {
            messErr.textContent = 'Price cant be negative!';
            messErr.style.display = 'block';
            messErr.style.color = 'red';
        }
        else if (desc.length < 3) {
            messErr.textContent = 'Description is too short!';
            messErr.style.display = 'block';
            messErr.style.color = 'red';

        }
        else {
            messErr.textContent = 'Submission Successful!';
            messErr.style.display = 'block';
            messErr.style.color = 'green';
            form.submit();
        }
    })



    
})
       
           


function Alert() {
    alert("Authentication is not working yet!");
}
function registerHere() {
        alert("Coming Soon!...");
}