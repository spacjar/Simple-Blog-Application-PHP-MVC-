/**
 * This file contains validation functions for a sign-up form.
 * It includes functions to validate the username, email address, password, and password match.
 * The functions are triggered by user input events and handle the display of error messages.
 * The form submission is prevented if any of the validation functions return false.
 */

import { checkInputEmpty, chackEmailValidity } from '../../utils/input-validation-utils.js';

// Form
const form = document.getElementById('login-form');

// Email input
const emailInput = document.getElementById('email-input');
const emailInputMessage = document.getElementById('email-input-message-placeholder');

// Password input
const passwordInput = document.getElementById('password-input');
const passwordInputMessage = document.getElementById('password-input-message-placeholder');



/**
 * Handles the validation and availability of an email address.
 * 
 * @param {string} email - The email address to be validated and checked.
 * @returns {boolean} - Returns true if the email address is valid, otherwise false.
 */
const checkEmailHandler = (email) => {
    const isEmpty = checkInputEmpty(email);
    const isEmailValid = chackEmailValidity(email);

    if(isEmpty) {
        emailInput.classList.add('error');
        emailInputMessage.innerHTML = 'Email address is required!';
    } else if(!isEmailValid) {
        emailInput.classList.add('error');
        emailInputMessage.innerHTML = 'Email address is not valid!';
    }

    if(!isEmpty && isEmailValid) {
        emailInput.classList.remove('error');
        emailInputMessage.innerHTML = '';
    }

    return !isEmpty && isEmailValid;
};

// Check email validity and availability (after 1 second of inactivity)
let emailTimeout = null;
emailInput.addEventListener('input', (event) => {
    clearTimeout(emailTimeout);

    emailTimeout = setTimeout(() => checkEmailHandler(event.target.value), 1000);
});



/**
 * Handles the validation of a password.
 * 
 * @param {string} password - The password to be validated.
 * @returns {boolean} - Returns true if the password is empty, false otherwise.
 */
const checkPasswordHandler = (password) => {
    const isEmpty = checkInputEmpty(password);

    if(isEmpty) {
        passwordInput.classList.add('error');
        passwordInputMessage.innerHTML = 'Passwords is required!';
    }

    if(!isEmpty) {
        passwordInput.classList.remove('error');
        passwordInputMessage.innerHTML = '';
    }

    return !isEmpty;
}

// Check password validity (after 1 second of inactivity)
let passwordTimeout = null;
passwordInput.addEventListener('input', (event) => {
    clearTimeout(passwordTimeout);
    passwordTimeout = setTimeout(() => checkPasswordHandler(event.target.value), 1000);
});



// Form submission handler
form.addEventListener('submit', (event) => {
    if(!checkEmailHandler(emailInput.value) || !checkPasswordHandler(passwordInput.value)) {
        console.log("Prevent");
        event.preventDefault();
    }
});
