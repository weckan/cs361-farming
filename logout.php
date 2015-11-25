<?php

    error_reporting(0);
    ini_set('display_errors', 'Off');

    session_start();
    session_regenerate_id(true);
    if ( session_status() == PHP_SESSION_ACTIVE ) {
        setcookie('PHPSESSID', '0', time()-3600);
        $_SESSION = array();
        session_destroy();
    }

    $path = explode('/', $_SERVER['PHP_SELF'], -1);
    $path = implode('/', $path);
    $redir = "http://" . $_SERVER['HTTP_HOST'] . $path;
    header("Location: {$redir}/index.html", true);
    die();

?>
