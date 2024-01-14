<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../core/Response.php";
    require_once __DIR__ . "/../models/BlogModel.php";

    class DashboardController extends Controller {
        public function __construct() {
            $this->registerMiddleware(new AuthMiddleware(['dashboard', 'dashboardPosts', 'dashboardPost', 'dashboardPostNew', 'dashboardPostEdit', 'dashboardPostDelete']));
        }

        public function dashboard(Request $request, Response $response) {
            return $this->render("dashboard");
        }

        public function dashboardPosts(Request $request, Response $response) {
            return $this->render("dashboard-posts");
        }

        public function dashboardPost(Request $request, Response $response) {
            return $this->render("dashboard-post");
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
                    'model' => $blogModel
                ]);
            }

            return $this->render("dashboard-post-new", [
                'model' => $blogModel
            ]);
        }

        public function dashboardPostEdit(Request $request, Response $response) {
            return $this->render("dashboard-post-edit");
        }

        public function dashboardPostDelete(Request $request, Response $response) {
            return $this->render("dashboard-post-delete");
        }

        // ... other methods ...
    }
?>