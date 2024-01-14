<?php
    require_once __DIR__ . "/../core/Application.php";
    require_once __DIR__ . "/Model.php";

    abstract class DBModel extends Model {
        abstract public static function tableName(): string;

        abstract public function attributes(): array;

        abstract public static function primaryKey(): string;

        public static function prepare($sql) {
            return Application::$app->db->prepare($sql);
        }

        // CRUD operations
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

        public static function getAll() {
            try {
                $tableName = static::tableName();
                $statement = self::prepare("SELECT * FROM $tableName");
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                // echo $e->getMessage();
                return false;
            }
        }

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