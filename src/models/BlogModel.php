<?php
    require_once __DIR__ . "/../core/Application.php";
    require_once __DIR__ . "/../core/DBModel.php";
    
    /**
     * Represents a blog post model in the application.
     */
    class BlogModel extends DBModel {
        public int $id = 0;
        public int $author_id = 0;
        public string $title = "";
        public string $content = "";
        public string $created_at = "";
        public string $updated_at = "";
        public int $deleted = 0;

        /**
         * Returns the primary key attribute name for the model.
         *
         * @return string The primary key attribute name.
         */
        public static function primaryKey(): string {
            return "id";
        }

        /**
         * Returns the table name for the model.
         *
         * @return string The table name.
         */
        public static function tableName(): string {
            return "posts";
        }

        /**
         * Returns the list of attributes that can be mass assigned.
         *
         * @return array The list of attributes.
         */
        public function attributes(): array {
            return ["title", "content"];
        }

        /**
         * Returns the validation rules for the model attributes.
         *
         * @return array The validation rules.
         */
        public function rules(): array {
            return [
                "title" => [self::RULE_REQUIRED],
                "content" => [self::RULE_REQUIRED]
            ];
        }


        /**
         * Retrieves all blog posts based on the specified page and number of posts per page.
         *
         * @param int $page The current page number.
         * @param int $postsPerPage The number of posts to display per page.
         * @return array An array of blog post data.
         */
        public static function getAllBlogPosts(int $page, int $postsPerPage) {
            try {
                $offset = ($page - 1) * $postsPerPage;
                $query = "SELECT * FROM posts WHERE deleted = 0 ORDER BY created_at DESC LIMIT $postsPerPage OFFSET $offset";
                $statement = self::prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                throw new NotFoundException();
                return [];
            }
        }


        /**
         * Retrieves the total count of all blog posts.
         *
         * @return array|false The total count of all blog posts, or an empty array if an error occurs.
         */
        public static function getAllBlogPostsCount() {
            try {
                $query = "SELECT COUNT(*) FROM posts WHERE deleted = 0";
                $statement = self::prepare($query);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $result["COUNT(*)"];
            } catch(PDOException $e) {
                return 1;
            }
        }


        /**
         * Retrieves a blog post by its ID.
         *
         * @param int $postId The ID of the blog post.
         * @return array The blog post data as an associative array, or an empty array if the post is not found.
         */
        public static function getBlogPostById(int $postId) {
            try {
                $query = "SELECT * FROM posts WHERE id = :id AND deleted = 0";
                $statement = self::prepare($query);
                $statement->bindValue(":id", $postId);
                $statement->execute();
                return $statement->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                return [];
            }
        }


        /**
         * Retrieves blog posts by user ID.
         *
         * @param int $userId The ID of the user.
         * @return array An array of blog posts.
         */
        public static function getBlogPostsByUserId(int $userId) {
            try {
                if (Application::isAdmin()) {
                    $query = "SELECT * FROM posts ORDER BY created_at DESC";
                    $statement = self::prepare($query);
                } else {
                    $query = "SELECT * FROM posts WHERE author_id = :author_id AND deleted = 0 ORDER BY created_at DESC";
                    $statement = self::prepare($query);
                    $statement->bindValue(":author_id", $userId);
                }
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                return [];
            }
        }


        /**
         * Creates a new blog post.
         *
         * @param int $authorId The ID of the author.
         * @param string $title The title of the blog post.
         * @param string $content The content of the blog post.
         * @param string $createdAt The creation date of the blog post.
         * @return bool Returns true if the blog post was successfully created, false otherwise.
         */
        public function createBlogPost(int $authorId, string $title, string $content, string $createdAt) {
            try {
                $query = "INSERT INTO posts (author_id, title, content, created_at) VALUES (:author_id, :title, :content, :created_at)";
                $statement = self::prepare($query);
                $statement->bindValue(":author_id", $authorId);
                $statement->bindValue(":title", $title);
                $statement->bindValue(":content", $content);
                $statement->bindValue(":created_at", $createdAt);
                $statement->execute();
                return true;
            } catch(PDOException $e) {
                return false;
            }
        }

    
        /**
         * Updates a blog post in the database.
         *
         * @param int $postId The ID of the blog post to update.
         * @param string $title The new title of the blog post.
         * @param string $content The new content of the blog post.
         * @return bool Returns true if the update was successful, false otherwise.
         */
        public function updateBlogPost(int $postId, string $title, string $content) {
            try {
                $query = "UPDATE posts SET title = :title, content = :content, updated_at = :updated_at WHERE id = :id";
                $statement = self::prepare($query);
                $statement->bindValue(":id", $postId);
                $statement->bindValue(":title", $title);
                $statement->bindValue(":content", $content);
                $statement->bindValue(":updated_at", date("Y-m-d H:i:s"));
                $statement->execute();
                return true;
            } catch(PDOException $e) {
                return false;
            }
        }


        /**
         * Deletes a blog post (sets the deleted value to 1).
         *
         * @param int $postId The ID of the blog post to delete.
         * @return bool Returns true if the blog post was successfully deleted, false otherwise.
         */
        public function deleteBlogPost(int $postId) {
            try {
                $query = "UPDATE posts SET deleted = 1 WHERE id = :id";
                $statement = self::prepare($query);
                $statement->bindValue(":id", $postId);
                $statement->execute();
                return true;
            } catch(PDOException $e) {
                return false;
            }
        }
    }
?>