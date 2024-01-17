<main class="auth">
    <div class="container">
        <div class="auth-description">
            <h1 class="heading-2">Login</h1>
            <p class="text-medium">Lorem ipsum dolor sit amet adipiscing elit.</p>
        </div>
        <form id="login-form" class="auth-form" method="POST">
            <div class="auth-form__group <?php echo $model->hasError('email') ? 'is-invalid' : '' ?>">
                <label for="email-input" class="text-regular">Email (required)</label>
                <input type="email" id="email-input" name="email" autocomplete="email" class="input" placeholder="Email" value="<?php echo htmlspecialchars($model->email, ENT_QUOTES, 'UTF-8');?>">
                <div id="email-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("email")?></div>
            </div>
            <div class="auth-form__group <?php echo $model->hasError('password') ? 'is-invalid' : '' ?>">
                <label for="password-input" class="text-regular">Password (required)</label>
                <input type="password" id="password-input" name="password" autocomplete="password" class="input" placeholder="Password" value="<?php echo htmlspecialchars($model->password, ENT_QUOTES, 'UTF-8');?>">
                <div id="password-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("password")?></div>
            </div>
            <div class="auth-form__group">
                <button class="cta cta__primary" type="submit">Login</button>
            </div>
        </form>
    </div>
</main>