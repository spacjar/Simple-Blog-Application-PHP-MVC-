<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form id="sign-form" class="sign-form" method="POST" action="../controllers/"> -->
    <form id="sign-form" class="sign-form" method="POST">
        <div class="sign-form__group">
            <label for="username-input" class="text-regular">Username</label>
            <input type="text" id="username-input" name="username" class="input" placeholder="Username">
            <div id="username-input-message-placeholder"></div>
        </div>
        <div class="sign-form__group">
            <button class="cta cta__primary" type="submit">Sign Up</button>
        </div>
    </form>
</body>
</html>