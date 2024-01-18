<?php
    /**
     * This is the base model class for user-related models.
     * It extends the DBModel class and provides common functionality for user models.
     */
    require_once __DIR__ . "/DBModel.php";

    abstract class UserBaseModel extends DBModel {
        /**
         * Retrieves the display name of the user.
         *
         * @return string The display name of the user.
         */
        abstract public function getDisplayName(): string;
    }
?>