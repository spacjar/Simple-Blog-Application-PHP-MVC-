<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../core/Response.php";
    require_once __DIR__ . "/../models/BlogModel.php";

    /**
     * Class DashboardController
     * 
     * This class represents the controller for the dashboard functionality of the blog application.
     * It extends the base Controller class and handles the authentication middleware and layout settings.
     */
    class DashboardController extends Controller {
        public function __construct() {
            $this->registerMiddleware(new AuthMiddleware(['dashboard', 'dashboardPosts', 'dashboardPostNew', 'dashboardPostEdit', 'dashboardPostDelete']));
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
                $blogModel->loadData($request->getBody());
                echo("<pre>");
                var_dump($blogModel);
                echo("</pre>");

                if ($blogModel->validate()) {
                    // $blogModel->createBlogPost($authorId, $title, $content, $author);
                    $blogModel->createBlogPost("1", "Test", "Content");
                    // return $response->redirect('/dashboard/posts');
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
                return $response->redirect('/dashboard/posts');
            }

            return $this->render("dashboard-post-edit");
        }


        public function dashboardPostDelete(Request $request, Response $response) {
            if($request->isPost()) {
                return $response->redirect('/dashboard/posts');
            }

            return;
        }
    }
?>