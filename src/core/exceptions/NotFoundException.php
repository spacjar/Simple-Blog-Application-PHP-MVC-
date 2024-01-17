<?php
    /**
     * Represents an exception that is thrown when a page is not found.
     */
    class NotFoundException extends Exception {
        protected $message = "Page not found";
        protected $code = 404;
    }
?>