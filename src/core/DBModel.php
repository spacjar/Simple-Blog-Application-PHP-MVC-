<?php
    /**
     * This class represents a database model that extends the base Model class.
     * It provides abstract methods for defining table name, attributes, and primary key.
     * It also provides methods for CRUD operations such as create, read, update, and delete.
     */
    require_once __DIR__ . "/../core/Application.php";
    require_once __DIR__ . "/Model.php";

    abstract class DBModel extends Model {
        /**
         * Returns the name of the database table associated with the model.
         *
         * @return string The table name.
         */
        abstract public static function tableName(): string;

        /**
         * Returns an array of attribute names for the model.
         *
         * @return array The attribute names.
         */
        abstract public function attributes(): array;

        /**
         * Returns the primary key attribute name for the model.
         *
         * @return string The primary key attribute name.
         */
        abstract public static function primaryKey(): string;

        /**
         * Prepares a SQL statement for execution.
         *
         * @param string $sql The SQL statement to prepare.
         * @return PDOStatement|false The prepared statement or false on failure.
         */
        public static function prepare($sql) {
            return Application::$app->db->prepare($sql);
        }

        /**
         * Creates a new record in the database table.
         *
         * @return bool True if the record is created successfully, false otherwise.
         */
        public function create() {
            try {
                $tableName = $this->tableName();
                $attributes = $this->attributes();
                $params = array_map(fn($attr) => ":$attr", $attributes);
                $statement = self::prepare("INSERT INTO $tableName (".implode(",", $attributes).") VALUES (".implode(",", $params).")");
    
                foreach($attributes as $attribute) {
                    $statement->bindValue(":$attribute", $this->{$attribute});
                }

                $statement->execute();
                return true;
            } catch(PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        /**
         * Retrieves all records from the database table.
         *
         * @param string $orderBy Optional. The column to order the records by.
         * @return array|false An array of records or false on failure.
         */
        public static function getAll($orderBy = "") {
            try {
                $tableName = static::tableName();
                $query = "SELECT * FROM $tableName";
                
                if (!empty($orderBy)) {
                    $query .= " ORDER BY $orderBy";
                }
                
                $statement = self::prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                // echo $e->getMessage();
                return false;
            }
        }

        /**
         * Retrieves a record from the database table by its primary key.
         *
         * @param array $where An associative array of column-value pairs for the WHERE clause.
         * @return object|false The retrieved record as an object or false on failure.
         */
        public static function getById($where) {
            try {      
                $tableName = static::tableName();
                $attributes = array_keys($where);
                $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
                $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
                foreach ($where as $key => $item) {
                    $statement->bindValue(":$key", $item);
                }
                $statement->execute();
                return $statement->fetchObject(static::class);
            } catch(PDOException $e) {
                // echo $e->getMessage();
                return false;
            }
        }

        /**
         * Updates a record in the database table by its primary key.
         *
         * @param mixed $id The value of the primary key.
         * @param string $idColumn Optional. The name of the primary key column.
         * @return bool True if the record is updated successfully, false otherwise.
         */
        public function updateById($id, $idColumn = "id") {
            try {
                $tableName = $this->tableName();
                $attributes = $this->attributes();
                $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
                $statement = self::prepare("UPDATE $tableName SET ".implode(",", $params)." WHERE $idColumn = :id");
    
                foreach($attributes as $attribute) {
                    $statement->bindValue(":$attribute", $this->{$attribute});
                }
                $statement->bindValue(":id", $id);
                $statement->execute();
                return true;
            } catch(PDOException $e) {
                // echo $e->getMessage();
                return false;
            }
        }

        /**
         * Deletes a record from the database table by its primary key.
         *
         * @param mixed $id The value of the primary key.
         * @param string $idColumn Optional. The name of the primary key column.
         * @return bool True if the record is deleted successfully, false otherwise.
         */
        public function deleteById($id, $idColumn = "id") {
            try {
                $tableName = $this->tableName();
                $statement = self::prepare("DELETE FROM $tableName WHERE $idColumn = :id");
                $statement->bindValue(":id", $id);
                $statement->execute();
                return true;
            } catch(PDOException $e) {
                // echo $e->getMessage();
                return false;
            }
        }
    }
?>