<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../models/BlogModel.php";


    /**
     * Class BlogController
     * 
     * This class is responsible for handling basic blog-related operations.
     * It extends the base Controller class.
     */
    class BlogController extends Controller {


        /**
         * Handles the list action for the blog controller.
         *
         * Retrieves the blog posts for the specified page and renders the 'main' template.
         *
         * @param Request $request The HTTP request object.
         * @return string The HTML content of the view.
         * @throws NotFoundException If the blog post is not found.
         */
        public function handleList(Request $request)
        {
            try {
                $page = intval($request->getQueryParam('page')) ?: 1;
                $postsPerPage = 9;
                $totalPosts = BlogModel::getAllBlogPostsCount();
                $totalPages = ceil($totalPosts / $postsPerPage);

                if ($page < 1 || ($page > $totalPages && $page !== 1)) {
                    throw new NotFoundException();
                }

                $posts = BlogModel::getAllBlogPosts($page, $postsPerPage) ?? [];
                return $this->render('main', ['posts' => $posts, 'page' => $page, 'totalPages' => $totalPages]);
            } catch (Exception $e) {
                throw new NotFoundException();
            }
        }


        /**
         * Handles the request to display the detail of a blog post.
         *
         * @param Request $request The request object.
         * @return string The HTML content of the view.
         * @throws NotFoundException If the blog post is not found.
         */
        public function handleDetailList(Request $request) {
            try {
                $id = $request->getRouteParam('id');
                if (filter_var($id, FILTER_VALIDATE_INT) === false) {
                    throw new NotFoundException();
                }
                $id = intval($id);
                $postDetail = BlogModel::getBlogPostById($id);
                return $this->render('detail', ['postDetail' => $postDetail]);
            } catch (Exception $e) {
                throw new NotFoundException();
            }
        }
    }
?>