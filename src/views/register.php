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
                    <label for="email-input" class="text-regular">Email</label>
                    <input type="email" id="email-input" name="email" class="input" placeholder="Email">
                    <div id="email-input-message-placeholder"></div>
                </div>
                <div class="sign-form__group">
                    <label for="password-input" class="text-regular">Password</label>
                    <input type="password" id="password-input" name="password" autocomplete="new-password" class="input" placeholder="Password">
                    <div id="password-input-message-placeholder"></div>
                </div>
                <div class="sign-form__group">
                    <label for="password-check-input" class="text-regular">Re-enter Password</label>
                    <input type="password" id="password-check-input" name="password_repeat" autocomplete="new-password" class="input" placeholder="Re-enter Password">
                    <div id="password-check-input-message-placeholder"></div>
                </div>
        <div class="sign-form__group">
            <button class="cta cta__primary" type="submit">Sign Up</button>
        </div>
    </form>
</body>
</html>