<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../models/BlogModel.php";


    class BlogController extends Controller{
        public function handleList()
        {
            $posts = BlogModel::getAllBlogPosts();
            return $this->render('main', ['posts' => $posts]);
        }
        public function handleDetailList() {
            $postDetail = BlogModel::getBlogPostById(1);
            // $postDetail = BlogModel::getBlogPostById($id);
            return $this->render('detail', ['postDetail' => $postDetail]);
        }
    }
?>