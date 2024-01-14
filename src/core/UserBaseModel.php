<?php
    require_once __DIR__ . "/DBModel.php";

    abstract class UserBaseModel extends DBModel {
        abstract public function getDisplayName(): string;
    }
?>