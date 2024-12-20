document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll("form");
    const badw=["fuck","shit","kill","murder","slave"];

    forms.forEach((form) => {
        form.addEventListener("submit", (e) => {
        const comment = form.querySelector("textarea").value.trim();

            if (!comment) {
                alert("Please enter a comment.");
                e.preventDefault();
                return;
            }
            const contbadw=badw.some(word =>new RegExp(`\\b${word}\\b`,"i").test(comment)
        );
        if(contbadw){
            alert("Your comment contains a bad word!");
            e.preventDefault();
            return;
        }
        });
    });
});
