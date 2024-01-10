<?php
    ini_set("session.use_only_cookies", 1); // ? Goes in and makes sure that any session ID can only be passed through session cookies and not through the URL
    ini_set("session.use_strict_mode", 1); // ? Website goes in and makes sure that the session ID is only accepted if it matches the session ID that was generated (on the server) for that particular session

    session_set_cookie_params([
        "lifetime" => 1800, // Destroys cookie after 30 minutes
        "domain" => "zwa.toad.cz", // Cookie is only valid for this domain
        "path" => "/~spacjaro/", // Cookie is only valid for this path
        "secure" => true, // Cookie is only valid for HTTPS
        "httponly" => true // Restricts access to cookie to HTTP requests only
    ]);

    session_start();

    if(!isset($_SESSION['last_regeneration']))  {
        session_regenerate_id(true); // ? Regenerates the current session ID
        $_SESSION['last_regeneration'] = time();
    } else {
        $interval = 1800; // 30 minutes

        if(time() - $_SESSION['last_regeneration'] >= $interval) {
            session_regenerate_id(true);
            $_SESSION['last_regeneration'] = time();
        }
    }
    session_regenerate_id(true);

?>