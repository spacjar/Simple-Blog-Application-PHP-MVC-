import { checkInputEmpty } from '../../utils/input-validation-utils.js';

// Form
const form = document.getElementById('post__form');

// Title input
const titleInput = document.getElementById('title-input');
const titleInputMessage = document.getElementById('title-input-message-placeholder');

// Content input
const contentInput = document.getElementById('content-input');
const contentInputMessage = document.getElementById('content-input-message-placeholder');

// Thumbnail input
const thumbnailInput = document.getElementById('thumbnail-input');
const thumbnailInputMessage = document.getElementById('thumbnail-input-message-placeholder');


/**
 * Checks if the title is empty and updates the UI accordingly.
 * @param {string} title - The title to be checked.
 * @returns {boolean} - Returns true if the title is empty, false otherwise.
 */
const checkTitleHandler = (title) => {
    const isEmpty = checkInputEmpty(title);

    if(isEmpty) {
        titleInput.classList.add('error');
        titleInputMessage.innerHTML = 'Title is required!';
    }

    if(!isEmpty) {
        titleInput.classList.remove('error');
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
        contentInput.classList.add('error');
        contentInputMessage.innerHTML = 'Title is required!';
    }

    if(!isEmpty) {
        contentInput.classList.remove('error');
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


/**
 * Checks if the thumbnail is empty and updates the UI accordingly.
 * @param {string} thumbnail - The thumbnail to be checked.
 * @returns {boolean} - Returns true if the thumbnail is empty, false otherwise.
 */
const checkThumbnailtHandler = (thumbnail) => {
    const isEmpty = checkInputEmpty(thumbnail);

    if(isEmpty) {
        thumbnailInput.classList.add('error');
        thumbnailInputMessage.innerHTML = 'Title is required!';
    }

    if(!isEmpty) {
        thumbnailInput.classList.remove('error');
        thumbnailInputMessage.innerHTML = '';
    }

    return isEmpty;
};

// Check thumbnail validity (after 1 second of inactivity)
let thumbnailTimeout = null;
thumbnailInput.addEventListener('input', (event) => {
    clearTimeout(thumbnailTimeout);

    thumbnailTimeout = setTimeout(() => checkThumbnailtHandler(event.target.value), 1000);
});


// Form submission handler
form.addEventListener('submit', (event) => {
    if(!checkTitleHandler(titleInput.value) || !checkContentHandler(contentInput.value) || !checkThumbnailtHandler(thumbnailInput.value)) {
        console.log("Prevent");
        event.preventDefault();
    }
});
