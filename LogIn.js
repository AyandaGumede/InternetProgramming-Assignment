const submit = document.getElementById("submit-btn");

submit.addEventListener("click", (e) => {
    const userPass = document.getElementById("curr-pass").value;
    if(userPass >1 && userPass < 6){
        window.alert("Password must be atleast 6 characters long");
    }
});


/* Cookies Pop up action */
const cookiesRequest = document.getElementById("cookies");
const disableBtn = document.getElementById("disable");

// ---- Cookies Request Display-------
const previewRequest = () => {
    cookiesRequest.classList.add('cookies-active');
}
setTimeout(previewRequest, 1000);

// ----Cookies Request Removal---------
disableBtn.addEventListener("click", (event) => {
    event.preventDefault();
    cookiesRequest.classList.remove('cookies-active');
});
