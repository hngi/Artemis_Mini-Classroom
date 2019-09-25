let signinEmail = document.getElementById('signinEmail');
let signinPassword = document.getElementById('signinPassword');
let signinSubmitBtn = document.getElementById('signinSubmitBtn');

let signinEmailError = document.getElementById('signinEmailError');
let signinPasswordError = document.getElementById('signinPasswordError');

let signinCleanEmail = false;
let signinCleanPassword = false;

function signinValidateEmail() {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(String(signinEmail.value).toLowerCase())) {
        signinEmailError.style.visibility = 'visible';
        signinEmailError.textContent = 'Please enter a valid email address';
        signinCleanEmail = false;
    } else {
        signinEmailError.style.visibility = 'hidden';
        signinCleanEmail = true;
    }
    signinValidate();
}

function signinValidatePassword() {
    if(signinPassword.value.length < 1) {
        signinPasswordError.textContent = 'Enter Your Password';
        signinPasswordError.style.visibility = 'visible';
        signinCleanPassword = false;
    } else {
        signinPasswordError.style.visibility = 'hidden';
        signinCleanPassword = true;
    }
    signinValidate();
}


function signinValidate() {
    if(signinCleanEmail == true && signinCleanPassword == true) {
        signinSubmitBtn.removeAttribute('disabled');
    } else {
        signinSubmitBtn.setAttribute('disabled', 'disabled');
    }
}
