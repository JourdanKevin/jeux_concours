<?php

define('APP_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/App/');
define('HOST', '/');

$arr = explode("/",APP_ROOT);
array_splice($arr, -3);
define ('IMG_SERVE_DIR',implode("/",$arr). "/jeuxConcours/public/img/");
/**
 * Directories configuration
 * Define dir paths
 */
define('CONTROLLERS', APP_ROOT . 'Controllers/');
define('VIEWS', APP_ROOT . 'Views/');
define('MODELS', APP_ROOT . 'Models/');
define('DATAS', APP_ROOT . 'Datas/');
define('Mail', APP_ROOT . 'Mail/');

define('PUBLIC_DIR', HOST . 'public/');

define('JS_DIR', PUBLIC_DIR . 'js/');
define('CSS_DIR', PUBLIC_DIR . 'css/');
define('IMG_DIR', PUBLIC_DIR . 'img/');
define('IMG_URL', "http://localhost:8002/public/img/");

//DataBase
define('DB_HOST', "localhost");
define('DB_NAME', "jeuxconcours");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_DSN', "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME);

//Gmail
define('GM_USER', "atoltestmail@gmail.com");
define('GM_PASS', "12fb13a3");
define('GM_FROM', "Atol");

//Version
define("CSS_VERSION", '.min.css?v0.0.1');
define("JS_VERSION", '.js?v0.0.1');

require 'autoload.php';
