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
            return ["author_id", "title", "content"];
        }

        public function rules(): array {
            return [];
        }

        public static function getAllBlogPosts() {
            $blogPosts = self::getAll();
            return $blogPosts;
        }

        public static function getBlogPostById($id) {
            $blogPost = self::getById(["id" => $id]);
            return $blogPost;
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
    }
?>