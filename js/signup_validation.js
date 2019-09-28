let firstName = document.getElementById('firstName');
let lastName = document.getElementById('lastName');
let email = document.getElementById('email');
let password = document.getElementById('password');
let confirmPassword = document.getElementById('confirmPassword');
let submitBtn = document.getElementById('submitBtn');

let firstNameError = document.getElementById('firstNameError');
let lastNameError = document.getElementById('lastNameError');
let emailError = document.getElementById('emailError');
let passwordError = document.getElementById('passwordError');
let confirmPasswordError = document.getElementById('confirmPasswordError');

let cleanFirstName = false;
let cleanLastName = false;
let cleanEmail = false;
let cleanPassword = false;
let cleanConfirmPassword = false;


function validateFirstName() {
    if(firstName.value.length < 3) {
        firstNameError.textContent = 'Your First Name must have at least 3 characters';
        firstNameError.style.visibility = 'visible';
        cleanFirstName = false;
    } else {
        firstNameError.style.visibility = 'hidden';
        cleanFirstName = true;
    }
    validate();
}

function validateLastName() {
    if(lastName.value.length < 3) {
        lastNameError.textContent = 'Your Last name must have at least 3 characters';
        lastNameError.style.visibility = 'visible';
        cleanLastName = false;
    } else {
        lastNameError.style.visibility = 'hidden';
        cleanLastName = true;
    }
    validate();
}

function validateEmail() {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(String(email.value).toLowerCase())) {
        emailError.style.visibility = 'visible';
        emailError.textContent = 'Please enter a valid email address';
        cleanEmail = false;
    } else {
        emailError.style.visibility = 'hidden';
        cleanEmail = true;
    }
    validate();
}

function validatePassword() {
    if(password.value.length < 8) {
        passwordError.textContent = 'Your Password must have at least 8 characters';
        passwordError.style.visibility = 'visible';
        cleanPassword = false;
    } else {
        passwordError.style.visibility = 'hidden';
        cleanPassword = true;
    }
    validate();
}

function validateConfirmPassword() {
    if(password.value.length < 1) {
        confirmPasswordError.textContent = 'You have not entered a password';
        confirmPasswordError.style.visibility = 'visible';
        cleanConfirmPassword = false;
    } else if(confirmPassword.value !== password.value) {
        confirmPasswordError.textContent = 'Your password do not match';
        confirmPasswordError.style.visibility = 'visible';
        cleanConfirmPassword = false;
    } else {
        confirmPasswordError.style.visibility = 'hidden';
        cleanConfirmPassword = true;
    }
    validate();
}



function validate() {
    if(cleanFirstName === true && cleanLastName === true && cleanEmail === true && cleanPassword === true && cleanConfirmPassword === true) {
        submitBtn.removeAttribute('disabled');
    } else {
        submitBtn.setAttribute('disabled', 'disabled');
    }
}
