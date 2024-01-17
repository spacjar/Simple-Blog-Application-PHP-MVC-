<?php
    /**
     * Represents an exception that is thrown when a user does not have permission to access a page.
     */
    class ForbiddenException extends Exception {
        protected $message = "You do not have permission to access this page";
        protected $code = 403;
    }
?>