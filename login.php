<?php
    require_once './DB/config.php';
    $error = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = "";
        $password = "";
        
        if(isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        if(isset($_POST['password'])) {
            $password = $_POST['password'];
        }
        // Retrieve user from the database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $error = false;
            header("Location: dashboard/index.php");
            exit();
        } else {
            $error = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blog - Jaroslav Špác</title>

    <!-- Links and scripts -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/pages/signforms.css">
    <script defer src="scripts/pages/login/login-validations.js" type="module"></script>

    <!-- Components -->
    <link rel="stylesheet" href="styles/components/_header.css">
    <link rel="stylesheet" href="styles/components/_buttons.css">
    <link rel="stylesheet" href="styles/components/_forms.css">
    <link rel="stylesheet" href="styles/components/_footer.css">
</head>
<body>
    <?php 
        include 'components/_header.html';
    ?>
    <main class="sign">
        <div class="container">
            <div class="sign-description">
                <h1 class="heading-2">Log In</h1>
                <p class="text-medium">Lorem ipsum dolor sit amet adipiscing elit.</p>
            </div>
            <form id="login-form" class="sign-form" method="POST" action="login.php">
                <div class="sign-form__group">
                    <label for="email-input" class="text-regular">Email</label>
                    <input type="email" id="email-input" name="email" class="input" placeholder="Email">
                    <div id="email-input-message-placeholder"></div>
                </div>
                <div class="sign-form__group">
                    <label for="password-input" class="text-regular">Password</label>
                    <input type="password" id="password-input" name="password" autocomplete="password" class="input" placeholder="Password">
                    <div id="password-input-message-placeholder"></div>
                </div>
                <div class="sign-form__group">
                    <button class="cta cta__primary" type="submit">Log In</button>
                </div>
                <?php 
                    if($error == true) {
                        echo '<div id="form-message-placeholder">Wrong email or password</div>';
                    }
                ?>
            </form>
        </div>
    </main>
    <?php 
        include 'components/_footer.html'; 
    ?>
</body>
</html>