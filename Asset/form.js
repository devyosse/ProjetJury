let password = document.getElementById("id-password");
let passwordConfirm = document.getElementById("id-password-repeat");


function checkPassword() {
    if (password.value !== passwordConfirm.value){
        passwordConfirm.setCustomValidity("Les mots de passe ne correspondent pas.");
    }
    else{
        passwordConfirm.setCustomValidity('');
    }
}

password.addEventListener('change', checkPassword);
passwordConfirm.addEventListener('keyup', checkPassword);