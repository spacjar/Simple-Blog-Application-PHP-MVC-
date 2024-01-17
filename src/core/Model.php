<?php
    /**
     * The Model class is an abstract class that serves as the base class for all models in the application.
     * It provides common functionality for loading data, validating data, and storing validation errors.
     */
    abstract class Model {
        public const RULE_REQUIRED = "required";
        public const RULE_EMAIL = "email";
        public const RULE_MIN = "min";
        public const RULE_MAX = "max";
        public const RULE_MATCH = "match";
        public const RULE_UNIQUE = "unique";

        /**
         * Loads data into the model properties.
         *
         * @param array $data The data to be loaded into the model.
         * @return void
         */
        public function loadData($data) {
            foreach($data as $key => $value) {
                if(property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }

        /**
         * Returns the validation rules for the model.
         *
         * @return array The validation rules.
         */
        abstract public function rules(): array;

        /**
         * An array to store validation errors.
         *
         * @var array
         */
        public array $errors = [];

        /**
         * Validates the model attributes based on the defined rules.
         *
         * @return bool Returns true if all attributes pass the validation, otherwise false.
         */
        public function validate() {
            foreach($this->rules() as $attribute => $rules) {
                $value = $this->{$attribute};
                foreach($rules as $rule) {
                    $ruleName = $rule;

                    if(!is_string($ruleName)) {
                        $ruleName = $rule[0];
                    }

                    if($ruleName === self::RULE_REQUIRED && !$value) {
                        $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                    }
                    if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->addErrorForRule($attribute, self::RULE_EMAIL);
                    }
                    if($ruleName === self::RULE_MIN && strlen($value) < $rule["min"]) {
                        $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                    }
                    if($ruleName === self::RULE_MAX && strlen($value) > $rule["max"]) {
                        $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                    }
                    if($ruleName === self::RULE_MATCH && $value !== $this->{$rule["match"]}) {
                        $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
                    }
                    if($ruleName === self::RULE_UNIQUE) {
                        $className = $rule["class"];
                        $uniqueAttr = $rule["attribute"] ?? $attribute;
                        $tableName = $className::tableName();
                        $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
                        $statement->bindValue(":attr", $value);
                        $statement->execute();
                        $record = $statement->fetchObject();
                        if($record) {
                            $this->addErrorForRule($attribute, self::RULE_UNIQUE, ["field" => $attribute]);
                        }
                    }
                }
            }

            return empty($this->errors);
        }

        /**
         * Adds an error message for a specific validation rule.
         *
         * @param string $attribute The attribute name.
         * @param string $rule The validation rule.
         * @param array $params The parameters for the validation rule.
         * @return void
         */
        private function addErrorForRule(string $attribute, string $rule, $params = []) {
            $message = $this->errorMessages()[$rule] ?? "";
            foreach($params as $key => $value) {
                $message = str_replace("{{$key}}", $value, $message);
            }
            $this->errors[$attribute][] = $message;
        }

        /**
         * Adds a custom error message for an attribute.
         *
         * @param string $attribute The attribute name.
         * @param string $message The error message.
         * @return void
         */
        public function addError(string $attribute, string $message) {
            $this->errors[$attribute][] = $message;
        }

        /**
         * Returns an array of error messages for validation rules.
         *
         * @return array The array of error messages.
         */
        public function errorMessages() {
            return [
                self::RULE_REQUIRED => "This field is required",
                self::RULE_EMAIL => "This field must be a valid email address",
                self::RULE_MIN => "Min length of this field must be {min}",
                self::RULE_MAX => "Max length of this field must be {max}",
                self::RULE_MATCH => "This field must be the same as {match}",
                self::RULE_UNIQUE => "Record with this {field} already exists"
            ];
        }

        /**
         * Checks if the model has an error for the specified attribute.
         *
         * @param string $attribute The attribute to check for errors.
         * @return bool Returns true if the model has an error for the attribute, false otherwise.
         */
        public function hasError($attribute) {
            return $this->errors[$attribute] ?? false;
        }

        /**
         * Gets the first error message for the specified attribute.
         *
         * @param string $attribute The attribute to get the error message for.
         * @return string|bool Returns the first error message for the attribute, or false if no error message is found.
         */
        public function getFirstError($attribute) {
            return $this->errors[$attribute][0] ?? false;
        }
    }
?>