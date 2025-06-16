<?php

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? "https://" : "http://";

$host = $_SERVER['HTTP_HOST'];
$currentUrl = $protocol . $host;

define('base_url', $currentUrl.'/bmi/listhutang/public');
define('base_urllogin', $currentUrl.'/bmi/public/_login_proses/');
/*define('base_url', 'https://27.123.222.151:886/bmi/apcollection/public');
define('base_urllogin', 'https://27.123.222.151:886/bmi/public/_login_proses/');*/
define('DB_HOST', 'localhost');
define('DB_USER', 'sa');
define('DB_PASS', '');
define('DB_NAME', 'um_db');
define('DB_NAME2', 'gl-bmi');

define('SESSION_TIMEOUT', 1800);