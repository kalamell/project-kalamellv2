<?php 
function redirect_ssl() {
     if ($_SERVER['HTTP_X_FORWARDED_PROTO']=='http') {
        $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        redirect($url);
        exit;
    }
}
