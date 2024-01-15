<?php
    require_once __DIR__ . "/../core/Application.php";
    require_once __DIR__ . "/../core/DBModel.php";
    
    class BlogModel extends DBModel {
        public int $id = 0;
        public int $author_id = 0;
        public string $title = "";
        public string $content = "";
        public string $author = "";
        public string $created_at = "";
        public $updated_at = "";
        public $deleted = "";

        public static function primaryKey(): string {
            return "id";
        }

        public static function tableName(): string {
            return "posts";
        }

        public function attributes(): array {
            // return ["author_id", "title", "content", "created_at"];
            return ["author_id", "title", "content", "created_at"];
        }

        public function rules(): array {
            return [];
        }

        public static function getAllBlogPosts($page, $postsPerPage) {
            $offset = ($page - 1) * $postsPerPage;
            $query = "SELECT * FROM posts WHERE deleted = 0 ORDER BY created_at DESC LIMIT $postsPerPage OFFSET $offset";
            $statement = self::prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getBlogPostById($id) {
            $blogPost = self::getById(["id" => $id]);
            return $blogPost;
        }

        public static function getBlogPostsByUserId($userId) {
            $query = "SELECT * FROM posts WHERE author_id = :author_id ORDER BY created_at DESC";
            $statement = self::prepare($query);
            $statement->bindValue(":author_id", $userId);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createBlogPost($authorId, $title, $content) {
            $blogPost = $this->create(["author_id" => $authorId, "title" => $title, "content" => $content, "created_at" => date("Y-m-d H:i:s")]);
            // $blogPost = $this->create(["author_id" => $authorId, "title" => $title, "content" => $content, "created_at" => "2022-01-05 12:30:00"]);
            
            // $author = Application::user->getById(["id" => $authorId]);
            // if ($author) {
            //     $blogPost = $this->create(["author_id" => $authorId, "title" => $title, "content" => $content]);
            //     return $blogPost;
            // } else {
            //     throw new Exception("Author with id $authorId does not exist.");
            // }
        }

        public function updateBlogPost($id, $title, $content) {
            $blogPost = $this->update(["id" => $id, "title" => $title, "content" => $content, "updated_at" => date("Y-m-d H:i:s")]);
            return $blogPost;
        }

        public function deleteBlogPost($id) {
            $blogPost = $this->update(["id" => $id], ["deleted" => 1]);
            return $blogPost;
        }
    }
?>