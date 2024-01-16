<?php
    require_once __DIR__ . "/../models/BlogModel.php";
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../core/exceptions/NotFoundException.php";
    require_once __DIR__ . "/../core/exceptions/ForbiddenException.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../core/Response.php";

    /**
     * Class DashboardController
     * 
     * This class represents the controller for the dashboard functionality of the blog application.
     * It extends the base Controller class and handles the authentication middleware and layout settings.
     */
    class DashboardController extends Controller {

        /**
         * DashboardController constructor.
         * Registers the AuthMiddleware for specific routes and sets the layout to "dashboard".
         */
        public function __construct() {
            $this->registerMiddleware(new AuthMiddleware(['dashboardPosts', 'dashboardPostNew', 'dashboardPostEdit', 'dashboardPostDelete']));
            $this->setLayout("dashboard");
        }

        
        /**
         * Renders the dashboard posts page.
         *
         * @param Request $request The HTTP request object.
         * @param Response $response The HTTP response object.
         * @return mixed The rendered view.
         * @throws NotFoundException If an error occurs while retrieving the blog posts it renders custom not found page.
         */
        public function dashboardPosts(Request $request, Response $response) {
            try {
                $blogModel = new BlogModel();

                $page = intval($request->getQueryParam('page')) ?: 1;
                $postsPerPage = 10;
                $totalPosts = BlogModel::getAllBlogPostsCount(true);
                $totalPages = ceil($totalPosts / $postsPerPage);

                $posts = $blogModel->getBlogPostsByUserId(Application::$app->user->id, $page, $postsPerPage) ?? [];

                return $this->render("dashboard-posts", ['model' => $blogModel, 'posts' => $posts, 'page' => $page, 'totalPages' => $totalPages]);
            } catch (Exception $e) {
                throw new NotFoundException();
            }
        }

        
        /**
         * Handles the creation of a new blog post in the dashboard.
         *
         * @param Request $request The HTTP request object.
         * @param Response $response The HTTP response object.
         * @return mixed The rendered view (of an autocompleted form) or a redirect response.
         * @throws Exception If an error occurs during the creation of the blog post.
         */
        public function dashboardPostNew(Request $request, Response $response) {
            try {
                $blogModel = new BlogModel();
                $blogModel->loadData($request->getBody());

                if ($request->isPost()) {
                    // If the request method is POST

                    if (!$blogModel->validate()) {
                        // If the blog model fails validation, render the new post view with the model
                        return $this->render("dashboard-post-new", [
                            'model' => $blogModel,
                        ]);
                    }

                    $userId = Application::$app->user->id;

                    $res = $blogModel->createBlogPost($userId, $blogModel->title, $blogModel->content);

                    if (!$res) {
                        // If the blog post creation fails, throw an exception
                        throw new Exception('Blog post creation failed!');
                    }

                    // Redirect to the dashboard posts page after successful creation
                    return $response->redirect('/dashboard/posts');
                }

                // Render the new post view with the model
                return $this->render("dashboard-post-new", [
                    'model' => $blogModel,
                ]);
            } catch (Exception $e) {
                // Catch any exceptions and throw a new exception with a custom error message
                throw new Exception('Something went wrong: ' . $e->getMessage());
            }
        }


        /**
         * Handles the edit of a blog post in the dashboard.
         *
         * @param Request $request The HTTP request object.
         * @param Response $response The HTTP response object.
         * @return mixed The rendered view (of an autocompleted form) or a redirect response.
         * @throws Exception If an error occurs during the editing process.
         */
        public function dashboardPostEdit(Request $request, Response $response) {
            try {
                $blogModel = new BlogModel();
                $blogModel->loadData($request->getBody());

                // Get the postId from the route parameters
                $postId = $request->getRouteParam('postId') ?? null;
                // Get the blog post by its ID
                $post = $blogModel->getBlogPostById($postId) ?? null;
                
                if($request->isPost()) {
                    // If the request method is POST

                    if (!$blogModel->validate()) {
                        // If the blog model fails validation, render the edit view with the model and post data
                        return $this->render("dashboard-post-edit", [
                            'model' => $blogModel,
                            'post' => $post,
                        ]);
                    }

                    if (!$post) {
                        // If the blog post does not exist, throw an exception
                        throw new Exception('Blog post does not exist!');
                    }

                    if ($post["author_id"] !== Application::$app->user->id && !Application::isAdmin()) {
                        // If the current user is not the author of the blog post, throw a ForbiddenException
                        throw new ForbiddenException();
                    }

                    // Update the blog post with the new title and content
                    $res = $blogModel->updateBlogPost($postId, $blogModel->title, $blogModel->content);

                    if (!$res) {
                        // If the update fails, throw an exception
                        throw new Exception('Blog post edit failed!');
                    }

                    // Redirect to the dashboard posts page
                    return $response->redirect('/dashboard/posts');
                }

                // Render the edit view with the model and post data
                return $this->render("dashboard-post-edit", [
                    'model' => $blogModel,
                    'post' => $post,
                ]);
            } catch (Exception $e) {
                // If an exception occurs, throw a new exception with a generic error message
                throw new Exception('Something went wrong: ' . $e->getMessage());
            }  
        }


        /**
         * Handles a deletion of a blog post.
         *
         * @param Request $request The HTTP request object.
         * @param Response $response The HTTP response object.
         * @return Response The updated HTTP response object.
         * @throws Exception If an error occurs during the deletion process.
         */
        public function dashboardPostDelete(Request $request, Response $response) {
            try {
                // Check if the request method is POST
                if($request->isPost()) {
                    $blogModel = new BlogModel();
                    $postId = $request->getRouteParam('postId') ?? null;
                    $post = $blogModel->getBlogPostById($postId) ?? null;

                    // Check if the blog post exists
                    if (!$post) {
                        throw new Exception('Blog post does not exist!');
                    }

                    // Check if the current user has permission to delete the post
                    if ($post["author_id"] !== Application::$app->user->id && !Application::isAdmin()) {
                        throw new Exception('You do not have permission to delete this post!');
                    }

                    // Delete the blog post
                    $res = $blogModel->deleteBlogPost($postId);

                    // Check if the deletion was successful
                    if (!$res) {
                        throw new Exception('Blog post deletion failed!');
                    }

                    // Redirect the user to the dashboard posts page
                    return $response->redirect('/dashboard/posts');
                } else {
                    // Throw a not found exception if the request method is not POST
                    throw new NotFoundException();
                }
            } catch (Exception $e) {
                // Throw an exception with a custom error message
                throw new Exception('Something went wrong: ' . $e->getMessage());
            }
        }
    }
?>