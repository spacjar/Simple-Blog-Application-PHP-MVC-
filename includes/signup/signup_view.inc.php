<?php
    // ? --- View is used to interact with the user ---
    declare(strict_types=1);

    function signup_inputs() {
        $errors = isset($_SESSION["errors_signup"]) ? $_SESSION["errors_signup"] : [];

        if(isset($_SESSION["signup_data"]["username"])) {
            echo '
                <div class="sign-form__group">
                    <label for="username-input" class="text-regular">Username</label>
                    <input type="text" id="username-input" name="username" class="input" placeholder="Username" value="' . htmlspecialchars($_SESSION["signup_data"]["username"]) . '">
                    <div id="username-input-message-placeholder">';

                        if(isset($errors["username_taken"])) {
                            echo $errors["username_taken"];
                        }
                    
                    echo '</div>
                </div>
            ';
        } else {
            echo '
                <div class="sign-form__group">
                    <label for="username-input" class="text-regular">Username</label>
                    <input type="text" id="username-input" name="username" class="input" placeholder="Username">
                    <div id="username-input-message-placeholder"></div>
                </div>
            ';
        }

        if(isset($_SESSION["signup_data"]["email"])) {
            echo '
                <div class="sign-form__group">
                    <label for="email-input" class="text-regular">Email</label>
                    <input type="email" id="email-input" name="email" class="input" placeholder="Email" value="' . htmlspecialchars($_SESSION["signup_data"]["email"]) . '">
                    <div id="email-input-message-placeholder">';

                        if(isset($errors["invalid_email"])) {
                            echo $errors["invalid_email"];
                        }
                        if(isset($errors["email_used"])) {
                            echo $errors["email_used"];
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

        if(isset($_SESSION["signup_data"]["password"])) {
            echo '
                <div class="sign-form__group">
                    <label for="password-input" class="text-regular">Password</label>
                    <input type="password" id="password-input" name="password" autocomplete="new-password" class="input" placeholder="Password" value="' . htmlspecialchars($_SESSION["signup_data"]["password"]) . '">
                    <div id="password-input-message-placeholder">';
                    
                    echo '</div>
                </div>
            ';
        } else {
            echo '
                <div class="sign-form__group">
                    <label for="password-input" class="text-regular">Password</label>
                    <input type="password" id="password-input" name="password" autocomplete="new-password" class="input" placeholder="Password">
                    <div id="password-input-message-placeholder"></div>
                </div>
            ';
        }

        if(isset($_SESSION["signup_data"]["password_repeat"])) {
            echo '
                <div class="sign-form__group">
                    <label for="password-check-input" class="text-regular">Re-enter Password</label>
                    <input type="password" id="password-check-input" name="password_repeat" autocomplete="new-password" class="input" placeholder="Re-enter Password" value="' . htmlspecialchars($_SESSION["signup_data"]["password_repeat"]) . '">
                    <div id="password-check-input-message-placeholder">';
                    
                    if(isset($errors["passwords_dont_match"])) {
                        echo $errors["passwords_dont_match"];
                    }

                    echo '</div>
                </div>
            ';
        } else {
            echo '
                <div class="sign-form__group">
                    <label for="password-check-input" class="text-regular">Re-enter Password</label>
                    <input type="password" id="password-check-input" name="password_repeat" autocomplete="new-password" class="input" placeholder="Re-enter Password">
                    <div id="password-check-input-message-placeholder"></div>
                </div>
            ';
        }

        if(isset($_SESSION["errors_signup"])) {
            unset($_SESSION["errors_signup"]);
        }
    }

    // function check_signup_errors() {
    //     if(isset($_SESSION["errors_signup"])) {
    //         $errors = $_SESSION["errors_signup"];

    //         if(isset($errors["empty_input"])) {
    //             echo "<p class='error'>" . $errors["empty_input"] . "</p>";
    //         }
    //         unset($_SESSION["errors_signup"]);
    //     }
    // }
?>