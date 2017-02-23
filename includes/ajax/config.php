<?php

//print "<pre>";
//print_r($_SERVER);
//

if(rrp_is_local()) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/practice/wordpress/wp-load.php');
} else {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
}

function rrp_is_local()
{
    if ($_SERVER['HTTP_HOST'] == 'localhost'
        || substr($_SERVER['HTTP_HOST'], 0, 3) == '10.'
        || substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168'
    ) return true;
    return false;
}