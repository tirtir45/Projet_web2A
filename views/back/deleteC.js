document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    form.addEventListener("submit", (event) => {
        const commentIdInput = document.getElementById("comment_id");
        const commentId = commentIdInput.value.trim();
        if (!commentId) {
            alert("Please enter the comment id");
            event.preventDefault();
            return;
        }
        const commentIdNumber = Number(commentId);
        if (isNaN(commentIdNumber) || commentIdNumber <= 0) {
            alert("Please enter a positive number");
            event.preventDefault();
            return;
        }
    });
});
