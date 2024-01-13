<?php
    // ? --- View is used to interact with the user ---
    declare(strict_types=1);

    function login_inputs() {
        $errors = isset($_SESSION["errors_login"]) ? $_SESSION["errors_login"] : [];

        if(isset($_SESSION["login_data"]["email"])) {
            echo '
                <div class="sign-form__group">
                    <label for="email-input" class="text-regular">Email</label>
                    <input type="email" id="email-input" name="email" class="input" placeholder="Email" value="' . htmlspecialchars($_SESSION["login_data"]["email"]) . '">
                    <div id="email-input-message-placeholder">';

                        if(isset($errors["invalid_email"])) {
                            echo $errors["invalid_email"];
                        }
                        if(isset($errors["wrong_email"])) {
                            echo $errors["wrong_email"];
                        }
                    
                    echo '</div>
                </div>
            ';
        } else {
            echo '
                <div class="sign-form__group">
                    <label for="email-input" class="text-regular">Email</label>
                    <input type="email" id="email-input" name="email" class="input" placeholder="Email">
                    <div id="email-input-message-placeholder"></div>
                </div>
            ';
        }

        if(isset($_SESSION["login_data"]["password"])) {
            echo '
                <div class="sign-form__group">
                    <label for="password-input" class="text-regular">Password</label>
                    <input type="password" id="password-input" name="password" autocomplete="password" class="input" placeholder="Password" value="' . htmlspecialchars($_SESSION["login_data"]["password"]) . '">
                    <div id="password-input-message-placeholder">';
                    
                        if(isset($errors["wrong_password"])) {
                            echo $errors["wrong_password"];
                        }

                    echo '</div>
                </div>
            ';
        } else {
            echo '
                <div class="sign-form__group">
                    <label for="password-input" class="text-regular">Password</label>
                    <input type="password" id="password-input" name="password" autocomplete="password" class="input" placeholder="Password">
                    <div id="password-input-message-placeholder"></div>
                </div>
            ';
        }

        if(isset($_SESSION["errors_login"])) {
            unset($_SESSION["errors_login"]);
        }

        if(isset($_SESSION["login_data"])) {
            unset($_SESSION["login_data"]);
        }
    }