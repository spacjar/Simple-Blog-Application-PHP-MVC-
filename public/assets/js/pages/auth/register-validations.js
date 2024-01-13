/**
 * This file contains validation functions for a sign-up form.
 * It includes functions to validate the username, email address, password, and password match.
 * The functions are triggered by user input events and handle the display of error messages.
 * The form submission is prevented if any of the validation functions return false.
 */

import { checkInputEmpty, checkPasswordMatch, chackEmailValidity, checkEmailAvailability, checkUsernameAvailability } from '../../utils/input-validation-utils.js';

// Form
const form = document.getElementById('sign-form');

// Username input
const usernameInput = document.getElementById('username-input');
const usernameInputMessage = document.getElementById('username-input-message-placeholder');

// Email input
const emailInput = document.getElementById('email-input');
const emailInputMessage = document.getElementById('email-input-message-placeholder');

// Password input
const passwordInput = document.getElementById('password-input');
const passwordInputMessage = document.getElementById('password-input-message-placeholder');

// Password check input
const passwordMatchInput = document.getElementById('password-check-input');
const passwordMatchInputMessage = document.getElementById('password-check-input-message-placeholder');



/**
 * Handles the validation of a username.
 * 
 * @param {string} username - The username to be validated.
 * @returns {boolean} - Returns true if the username is not empty and available, otherwise false.
 */
const checkUsernameHandler = async (username) => {
    const isEmpty = checkInputEmpty(username);
    let isUsernameAvailable;

    if(!isEmpty) {
        isUsernameAvailable = await checkUsernameAvailability(username);
    }

    if(isEmpty) {
        usernameInput.classList.add('error');
        usernameInputMessage.innerHTML = 'Username is required!';
    } else if(!isUsernameAvailable) {
        usernameInput.classList.add('error');
        usernameInputMessage.innerHTML = 'Username is already registered!';
    }

    if(!isEmpty && isUsernameAvailable) {
        usernameInput.classList.remove('error');
        usernameInputMessage.innerHTML = '';
    }

    return !isEmpty && isUsernameAvailable;
};

// Check username availability (after 1 second of inactivity)
let usernameTimeout = null;
usernameInput.addEventListener('input', (event) => {
    clearTimeout(usernameTimeout);
    usernameTimeout = setTimeout(() => checkUsernameHandler(event.target.value), 1000);
});



/**
 * Handles the validation and availability of an email address.
 * 
 * @param {string} email - The email address to be validated and checked.
 * @returns {boolean} - Returns true if the email address is valid and available, otherwise false.
 */
const checkEmailHandler = async (email) => {
    const isEmpty = checkInputEmpty(email);
    let isEmailValid = chackEmailValidity(email);
    let isEmailAvailable;

    if(!isEmpty && isEmailValid) {
        isEmailAvailable = await checkEmailAvailability(email);
    }

    if(isEmpty) {
        emailInput.classList.add('error');
        emailInputMessage.innerHTML = 'Email address is required!';
    } else if(!isEmailValid) {
        emailInput.classList.add('error');
        emailInputMessage.innerHTML = 'Email address is not valid!';
    } else if(!isEmailAvailable) {
        emailInput.classList.add('error');
        emailInputMessage.innerHTML = 'Email address is already registered!';
    }

    if(!isEmpty && isEmailValid && isEmailAvailable) {
        emailInput.classList.remove('error');
        emailInputMessage.innerHTML = '';
    }

    return !isEmpty && isEmailValid && isEmailAvailable;
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



/**
 * Handles the match check of the provided password and check password.
 * 
 * @param {string} password - The password to be checked.
 * @param {string} passwordCheck - The password check to be compared with the password.
 * @returns {boolean} - True if the password and password check match, false otherwise.
 */
const checkPasswordMatchHandler = (password, passwordCheck) => {
    const isPasswordMatch = checkPasswordMatch(password, passwordCheck);

    if(!isPasswordMatch) {
        passwordMatchInput.classList.add('error');
        passwordMatchInputMessage.innerHTML = 'Passwords do not match!';
    }

    if(isPasswordMatch) {
        passwordMatchInput.classList.remove('error');
        passwordMatchInputMessage.innerHTML = '';
    }

    return isPasswordMatch;
}

// Check password match (after 1 second of inactivity)
let passwordMatchTimeout = null;
passwordMatchInput.addEventListener('input', (event) => {
    clearTimeout(passwordMatchTimeout);
    passwordMatchTimeout = setTimeout(() => checkPasswordMatchHandler(passwordInput.value, event.target.value), 1000);
});


// Form submission handler
form.addEventListener('submit', async (event) => {
    event.preventDefault();
    const isUsernameValid = await checkUsernameHandler(usernameInput.value);
    const isEmailValid = await checkEmailHandler(emailInput.value);
    const isPasswordValid = await checkPasswordHandler(passwordInput.value);
    const isPasswordMatchValid = await checkPasswordMatchHandler(passwordInput.value, passwordMatchInput.value);

    if(!isUsernameValid || !isEmailValid || !isPasswordValid || !isPasswordMatchValid) {
        console.log("Not valid")
        return;
    }

    // If all checks pass, manually submit the form
    form.submit();
});
