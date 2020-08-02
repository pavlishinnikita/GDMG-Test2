let loginForm = document.getElementById('loginForm');
let itUsername = document.getElementById('itUsername');
let itPassword = document.getElementById('itPassword');
loginForm.onsubmit = (event) => {
    let isWrong = false;
    if(itUsername.value.length === 0) {
        itUsername.classList.toggle("wrongInput");
        isWrong = true;
    }
    if(itPassword.value.length === 0) {
        itPassword.classList.toggle("wrongInput");
        isWrong = true;
    }
    return !isWrong;
}
