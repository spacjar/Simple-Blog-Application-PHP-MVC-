<?php
    require_once __DIR__ . "/../models/BlogModel.php";
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../core/Response.php";

    /**
     * Class DashboardController
     * 
     * This class represents the controller for the dashboard functionality of the blog application.
     * It extends the base Controller class and handles the authentication middleware and layout settings.
     */
    class DashboardController extends Controller {
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
            $posts = [];
            
            try {
                $blogModel = new BlogModel();
                $posts = $blogModel->getBlogPostsByUserId(Application::$app->user->id);
            } catch (Exception $e) {
                throw new NotFoundException();
            }

            return $this->render("dashboard-posts", [
                'model' => $blogModel,
                'posts' => $posts,
            ]);
        }


        public function dashboardPostNew(Request $request, Response $response) {
            $blogModel = new BlogModel();

            if ($request->isPost()) {
                try {
                    $blogModel->loadData($request->getBody());
                    if ($blogModel->validate()) {
                        $date = new DateTime();
                        $date = $date->format('Y-m-d H:i:s');
                        $userId = Application::$app->user->id;
                        $res = $blogModel->createBlogPost($userId, $blogModel->title, $blogModel->content, $date);

                        if($res) {
                            return $response->redirect('/dashboard/posts');
                        }
                    }
                } catch (Exception $e) {
                    throw new NotFoundException();
                }

                return $this->render('dashboard-post-new', [
                    'model' => $blogModel,
                ]);
            }

            return $this->render("dashboard-post-new", [
                'model' => $blogModel
            ]);
        }


        public function dashboardPostEdit(Request $request, Response $response) {
            if($request->isPost()) {
            // Check if the post exists

            // Check if the user is the author of the post
            


                return $response->redirect('/dashboard/posts');
            }

            return $this->render("dashboard-post-edit");
        }


        public function dashboardPostDelete(Request $request, Response $response) {
            if($request->isPost()) {
                $blogModel = new BlogModel();

                $postId = $request->getRouteParam('postId') ?? null;
                $post = $blogModel->getBlogPostById($postId) ?? null;

                if (!$post) {
                    $response->setStatusCode(404);
                    echo "Post not found.";
                    return;
                    // return $this->render('error', ['message' => 'Post not found.']);
                }

                if ($post["author_id"] !== Application::$app->user->id) {
                    $response->setStatusCode(403);
                    // return $this->render('error', ['message' => 'You are not authorized to delete this post.']);
                    echo "You are not authorized to delete this post.";
                    return;
                }

                $res = $blogModel->deleteBlogPost($postId);
                return $response->redirect('/dashboard/posts');
            }

            return;
        }
    }
?>