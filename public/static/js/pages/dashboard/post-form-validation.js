import { checkInputEmpty } from '../../utils/input-validation-utils.js';

// Form
const form = document.getElementById('post__form');

// Title input
const titleInput = document.getElementById('title-input');
const titleInputMessage = document.getElementById('title-input-message-placeholder');

// Content input
const contentInput = document.getElementById('content-input');
const contentInputMessage = document.getElementById('content-input-message-placeholder');


/**
 * Checks if the title is empty and updates the UI accordingly.
 * @param {string} title - The title to be checked.
 * @returns {boolean} - Returns true if the title is empty, false otherwise.
 */
const checkTitleHandler = (title) => {
    const isEmpty = checkInputEmpty(title);

    if(isEmpty) {
        titleInput.classList.add('is-invalid');
        titleInputMessage.innerHTML = 'Title is required!';
    }

    if(!isEmpty) {
        titleInput.classList.remove('is-invalid');
        titleInputMessage.innerHTML = '';
    }

    return isEmpty;
};

// Check title validity (after 1 second of inactivity)
let titleTimeout = null;
titleInput.addEventListener('input', (event) => {
    clearTimeout(titleTimeout);

    titleTimeout = setTimeout(() => checkTitleHandler(event.target.value), 1000);
});


/**
 * Checks if the content is empty and updates the UI accordingly.
 * @param {string} content - The content to be checked.
 * @returns {boolean} - Returns true if the content is empty, false otherwise.
 */
const checkContentHandler = (content) => {
    const isEmpty = checkInputEmpty(content);

    if(isEmpty) {
        contentInput.classList.add('is-invalid');
        contentInputMessage.innerHTML = 'Content is required!';
    }

    if(!isEmpty) {
        contentInput.classList.remove('is-invalid');
        contentInputMessage.innerHTML = '';
    }

    return isEmpty;
};

// Check content validity (after 1 second of inactivity)
let contentTimeout = null;
contentInput.addEventListener('input', (event) => {
    clearTimeout(contentTimeout);

    contentTimeout = setTimeout(() => checkContentHandler(event.target.value), 1000);
});


// Form submission handler
form.addEventListener('submit', (event) => {
    if(checkTitleHandler(titleInput.value) || checkContentHandler(contentInput.value)) {
        console.log("Prevent");
        event.preventDefault();
    }
});
