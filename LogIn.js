const cookiesRequest = document.getElementById("cookies");
const disableBtn = document.getElementById("disable");
const enableBtn = document.getElementById("enable");


const previewRequest = () => {
    cookiesRequest.classList.add('cookies-active');
};

// Popup after 3 seconds
setTimeout(previewRequest, 3000);

// Remove the cookies popup
disableBtn.addEventListener("click", (event) => {
    event.preventDefault();
    cookiesRequest.classList.remove('cookies-active');
});

// Enable button event listener
enableBtn.addEventListener("click", (event) => {
    event.preventDefault();
    return false;
});
