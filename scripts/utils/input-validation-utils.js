import { GLOBAL_CONFIG } from "../config.js";

/**
 * Checks the availability of a username by making a request to the server.
 * 
 * @param {string} username - The username to check the availability for.
 * @returns {Promise<boolean|null>} - A promise that resolves to a boolean indicating whether the username is available,
 * or null if an error occurred during the request.
 */
export const checkUsernameAvailability = async (username) => {
    try {
        const response = await fetch(`${GLOBAL_CONFIG.BASE_URL}/api/signup.php?username=${username}`);
        const data = await response.json();        
        return data?.isUsernameAvailable ? true : false;
    } catch(Err) {
        console.error("Error: ", Err);
        return null;
    }
};


/**
 * Checks the availability of an email address by making a request to the server.
 * 
 * @param {string} email - The email address to check the availability for.
 * @returns {Promise<boolean|null>} - A promise that resolves to a boolean indicating whether the email is available,
 * or null if an error occurred during the check.
 */
export const checkEmailAvailability = async (email) => {
    try {
        const response = await fetch(`${GLOBAL_CONFIG.BASE_URL}/api/signup.php?email=${email}`);
        const data = await response.json();        
        return data?.isEmailAvailable ? true : false;
    } catch(Err) {
        console.error("Error: ", Err);
        return null;
    }
};


/**
 * Checks if two passwords match.
 *
 * @param {string} password - The password to be checked.
 * @param {string} passwordCheck - The password to compare against.
 * @returns {boolean} Returns true if the passwords match, false otherwise.
 */
export const checkPasswordMatch = (password, passwordCheck) => {
    return password !== passwordCheck ? false : true;
};


/**
 * Checks if the length of a password is greater than or equal to a specified length.
 * 
 * @param {string} password - The password to be checked.
 * @param {number} length - The minimum length required for the password.
 * @returns {boolean} - Returns true if the password length is greater than or equal to the specified length, otherwise false.
 */
export const checkInputLength = (value, length) => {
    return value.length <= length ? false : true;
};


/**
 * Checks if the input value is empty.
 * 
 * @param {string} value - The input value to be checked.
 * @returns {boolean} - Returns true if the value length is 0, otherwise false.
 */
export const checkInputEmpty = (value) => {
    return value.length > 0 ? false : true;
};


/**
 * Validates an email address using a regular expression.
 * 
 * @param {string} email - The email address to validate.
 * @returns {boolean} - True if the email is valid, false otherwise.
 */
export const chackEmailValidity = (email) => {
    const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(email);
};