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

    if(isset($_SESSION["user_id"])) {
        if(!isset($_SESSION["last_regeneration"])) {
            regenerate_session_id_loggedin($_SESSION["user_id"]);
        } else {
            $interval = $CONFIG_LIFETIME;
            if(time() - $_SESSION["last_regeneration"] >= $interval) {
                regenerate_session_id_loggedin($_SESSION["user_id"]);
            }
        }
    } else {
        if(!isset($_SESSION["last_regeneration"])) {
            regenerate_session_id();
        } else {
            $interval = $CONFIG_LIFETIME;
            if(time() - $_SESSION["last_regeneration"] >= $interval) {
                regenerate_session_id();
            }
        }
    }

    function regenerate_session_id() {
        session_regenerate_id(true);
        $_SESSION["last_regeneration"] = time();
    }

    function regenerate_session_id_loggedin(string $userId) {
        session_regenerate_id(true);
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $userId;
        session_id($sessionId);
        $_SESSION["last_regeneration"] = time();
    }
?>