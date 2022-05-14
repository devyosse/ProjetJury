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


let email = document.getElementById('id-email');

function validateEmail() {

    let mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(email.value.match(mailFormat))
    {
        return true;
    }
    else
    {
        email.setCustomValidity("Vous avez entrez une mauvaise adresse mail !");
        return false;
    }
}

email.addEventListener('change', validateEmail);


let age = document.getElementById('id-age');

function validateAge() {
    if(age.value < 18) {
        age.setCustomValidity("Désolé, vous n'est pas assez agé");
    }
    else {
        age.setCustomValidity('');
    }
}

age.addEventListener('change', validateAge);