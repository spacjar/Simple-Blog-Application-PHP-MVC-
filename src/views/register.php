<main class="auth">
    <div class="container">
        <div class="auth-description">
            <h1 class="heading-2">Register</h1>
            <p class="text-medium">Lorem ipsum dolor sit amet adipiscing elit.</p>
        </div>
        <form id="register-form" class="auth-form" method="POST">
            <div class="auth-form__group">
                <label for="username-input" class="text-regular">Username (required)</label>
                <input type="text" id="username-input" name="username" autocomplete="username" class="input <?php echo $model->hasError('username') ? 'is-invalid' : '' ?>" placeholder="Username" value="<?php echo htmlspecialchars($model->username, ENT_QUOTES, 'UTF-8');?>">
                <div id="username-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("username")?></div>
            </div>
            <div class="auth-form__group">
                <label for="email-input" class="text-regular">Email (required)</label>
                <input type="email" id="email-input" name="email" autocomplete="email" class="input <?php echo $model->hasError('email') ? 'is-invalid' : '' ?>" placeholder="Email" value="<?php echo htmlspecialchars($model->email, ENT_QUOTES, 'UTF-8');?>">
                <div id="email-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("email")?></div>
            </div>
            <div class="auth-form__group">
                <label for="password-input" class="text-regular">Password (required)</label>
                <input type="password" id="password-input" name="password" autocomplete="new-password" class="input <?php echo $model->hasError('password') ? 'is-invalid' : '' ?>" placeholder="Password" value="<?php echo htmlspecialchars($model->password, ENT_QUOTES, 'UTF-8');?>">
                <div id="password-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("password")?></div>
            </div>
            <div class="auth-form__group">
                <label for="password-confirm-input" class="text-regular <?php echo $model->hasError('passwordConfirm') ? 'is-invalid' : '' ?>">Re-enter Password (required)</label>
                <input type="password" id="password-confirm-input" name="passwordConfirm" autocomplete="new-password" class="input" placeholder="Re-enter Password" value="<?php echo htmlspecialchars($model->passwordConfirm, ENT_QUOTES, 'UTF-8');?>">
                <div id="password-confirm-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("passwordConfirm")?></div>
            </div>
            <div class="auth-form__group">
                <button class="cta cta__primary" type="submit">Register</button>
            </div>
        </form>
    </div>
</main>