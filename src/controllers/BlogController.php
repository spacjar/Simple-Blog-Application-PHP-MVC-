<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../models/BlogModel.php";


    class BlogController extends Controller {

        public function handleList(Request $request)
        {
            $page = $request->getQueryParam('page') ?? 1;
            $postsPerPage = 5;
            $posts = BlogModel::getAllBlogPosts($page, $postsPerPage);
            return $this->render('main', ['posts' => $posts, 'page' => $page]);
        }

        public function handleDetailList(Request $request) {
            try {
                $id = $request->getRouteParam('id');
                $postDetail = BlogModel::getBlogPostById($id);
            } catch (Exception $e) {
                throw new NotFoundException();
            }
            // $postDetail = BlogModel::getBlogPostById($id);
            return $this->render('detail', ['postDetail' => $postDetail]);
        }
    }
?>