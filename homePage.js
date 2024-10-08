
/*  - - - - Profile Change - - - - */ 
function ChangeProfile() {
    const input = document.getElementById("uploadProfile");
    const profilePicture = document.getElementById("profile");
    
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            profilePicture.src = event.target.result;
        };
        reader.onerror = function(error) {
            console.error("Error reading the file: ", error);
        };
        reader.readAsDataURL(file);
    }
}