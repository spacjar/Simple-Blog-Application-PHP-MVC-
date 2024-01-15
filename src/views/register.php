<main class="auth">
    <div class="container">
        <div class="auth-description">
            <h1 class="heading-2">Register</h1>
            <p class="text-medium">Lorem ipsum dolor sit amet adipiscing elit.</p>
        </div>
        <form id="register-form" class="auth-form" method="POST">
            <div class="auth-form__group <?php echo $model->hasError('username') ? 'is-invalid' : '' ?>">
                <label for="username-input" class="text-regular">Username (required)</label>
                <input type="text" id="username-input" name="username" class="input" placeholder="Username" value="<?php echo htmlspecialchars($model->username);?>">
                <div id="username-input-message-placeholder"><?php echo $model->getFirstError("username")?></div>
            </div>
            <div class="auth-form__group <?php echo $model->hasError('email') ? 'is-invalid' : '' ?>">
                <label for="email-input" class="text-regular">Email (required)</label>
                <input type="email" id="email-input" name="email" class="input" placeholder="Email" value="<?php echo htmlspecialchars($model->email);?>">
                <div id="email-input-message-placeholder"><?php echo $model->getFirstError("email")?></div>
            </div>
            <div class="auth-form__group <?php echo $model->hasError('password') ? 'is-invalid' : '' ?>">
                <label for="password-input" class="text-regular">Password (required)</label>
                <input type="password" id="password-input" name="password" autocomplete="new-password" class="input" placeholder="Password" value="<?php echo htmlspecialchars($model->password);?>">
                <div id="password-input-message-placeholder"><?php echo $model->getFirstError("password")?></div>
            </div>
            <div class="auth-form__group <?php echo $model->hasError('passwordConfirm') ? 'is-invalid' : '' ?>">
                <label for="password-confirm-input" class="text-regular">Re-enter Password (required)</label>
                <input type="password" id="password-confirm-input" name="passwordConfirm" autocomplete="new-password" class="input" placeholder="Re-enter Password" value="<?php echo htmlspecialchars($model->passwordConfirm);?>">
                <div id="password-confirm-input-message-placeholder"><?php echo $model->getFirstError("passwordConfirm")?></div>
            </div>
            <div class="auth-form__group">
                <button class="cta cta__primary" type="submit">Register</button>
            </div>
        </form>
    </div>
</main>