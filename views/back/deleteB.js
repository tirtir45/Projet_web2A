document.addEventListener("DOMContentLoaded", ()=>{
    const form = document.querySelector("form");
    
    form.addEventListener("submit",(Event)=>{
        const num= document.getElementById("number").value.trim();

        if(!num){
            alert("Please enter blog id");
            Event.preventDefault();
            return;
        }
        const numVal=parseFloat(num);

        if(numVal<0){
            alert("Please enter a positive number");
            Event.preventDefault();
            return;
        }
    });
});