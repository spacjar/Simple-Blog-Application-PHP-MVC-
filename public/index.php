<?php
    require_once __DIR__ . "/../src/core/Application.php";
    require_once __DIR__ . "/../src/controllers/AuthController.php";
    require_once __DIR__ . "/../src/controllers/BlogController.php";
    require_once __DIR__ . "/../src/controllers/DashboardController.php";
    require_once __DIR__ . "/../src/controllers/ApiController.php";
    require_once __DIR__ . "/../src/config/config.php";
    
    $config = [
        "db" => [
            "host" => DB_HOST,
            "name" => DB_NAME,
            "user" => DB_USER,
            "password" => DB_PASSWORD,
        ],
        "userClass" => UserModel::class
    ];
    
    $app = new Application(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src', $config);
    
    // General routes
    $app->router->get(ROUTE_URL . '/', [BlogController::class, "handleList"]);
    $app->router->get(ROUTE_URL . '/post/{id}', [BlogController::class, "handleDetailList"]);

    // Dashboard posts routes
    $app->router->get(ROUTE_URL . '/dashboard/posts', [DashboardController::class, "dashboardPosts"]);
    $app->router->get(ROUTE_URL . '/dashboard/posts/new', [DashboardController::class, "dashboardPostNew"]);
    $app->router->post(ROUTE_URL . '/dashboard/posts/new', [DashboardController::class, "dashboardPostNew"]);
    $app->router->get(ROUTE_URL . '/dashboard/posts/edit/{postId}', [DashboardController::class, "dashboardPostEdit"]);
    $app->router->post(ROUTE_URL . '/dashboard/posts/edit/{postId}', [DashboardController::class, "dashboardPostEdit"]);
    $app->router->post(ROUTE_URL . '/dashboard/posts/delete/{postId}', [DashboardController::class, "dashboardPostDelete"]);

    // Dashboard users routes
    // $app->router->get('/dashboard/users', "dashboard-users");
    
    // Auth routes
    $app->router->get(ROUTE_URL . '/login', [AuthController::class, "handleLogin"]);
    $app->router->post(ROUTE_URL . '/login', [AuthController::class, "handleLogin"]);
    $app->router->get(ROUTE_URL . '/register', [AuthController::class, 'handleRegister']);
    $app->router->post(ROUTE_URL . '/register', [AuthController::class, 'handleRegister']);
    $app->router->post(ROUTE_URL . '/logout', [AuthController::class, 'handleLogout']);

    // API routes
    $app->router->get(ROUTE_URL . '/api/register', [ApiController::class, "handleRegisterCheck"]);

    $app->run();
?>