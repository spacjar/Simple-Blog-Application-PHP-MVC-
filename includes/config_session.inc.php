<?php
    $CONFIG_LIFETIME = 1800;

    ini_set("session.use_only_cookies", 1);
    ini_set("session.use_strict_mode", 1);

    session_set_cookie_params([
        "lifetime" => $CONFIG_LIFETIME,
        "domain" => "zwa.toad.cz",
        "path" => "/",
        "secure" => true,
        "httponly" => true,
    ]);

    session_start();

    function regenerate_session_id() {
        session_regenerate_id();
        $_SESSION["last_regeneration"] = time();
    }

    if(!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id();
    } else {
        $interval = $CONFIG_LIFETIME;
        if(time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
        }
    }
?>