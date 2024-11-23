

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    form.addEventListener("submit", (event) => {
        const title = document.getElementById("title").value.trim();
        const content = document.getElementById("content").value.trim();

        if (!title) {
            alert("The title field cannot be empty.");
            event.preventDefault();
            return;
        }

        if (!content) {
            alert("The content field cannot be empty.");
            event.preventDefault();
            return;
        }
    });
});
