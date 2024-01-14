<form id="login-form" class="auth-form" action="" method="POST">
    <div class="sign-form__group <?php echo $model->hasError('email') ? 'is-invalid' : '' ?>">
        <label for="email-input" class="text-regular">Email (required)</label>
        <input type="email" id="email-input" name="email" class="input" placeholder="Email" value="<?php echo htmlspecialchars($model->email);?>">
        <div id="email-input-message-placeholder"><?php echo $model->getFirstError("email")?></div>
    </div>
    <div class="sign-form__group <?php echo $model->hasError('password') ? 'is-invalid' : '' ?>">
        <label for="password-input" class="text-regular">Password (required)</label>
        <input type="password" id="password-input" name="password" autocomplete="new-password" class="input" placeholder="Password" value="<?php echo htmlspecialchars($model->password);?>">
        <div id="password-input-message-placeholder"><?php echo $model->getFirstError("password")?></div>
    </div>
    <div class="sign-form__group">
        <button class="cta cta__primary" type="submit">Sign Up</button>
    </div>
</form>