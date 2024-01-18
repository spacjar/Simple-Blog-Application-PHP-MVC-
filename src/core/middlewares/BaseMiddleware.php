<?php
    /**
     * This is the base class for all middlewares in the application.
     * It provides a template for executing middleware logic.
     */
    abstract class BaseMiddleware {
        /**
         * Executes the middleware logic.
         * This method should be implemented by child classes.
         */
        abstract public function execute();
    }
?>