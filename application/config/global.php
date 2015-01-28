<?php

// Chemin d'application
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(dirname(__DIR__)) . DS);
define('LIB_PATH', ROOT_PATH . 'vendor' . DS);
define('APP_PATH', ROOT_PATH . 'application' . DS);
define('SRC_PATH', APP_PATH . 'src' . DS);
//define('CTRL_PATH', APP_PATH . 'controller' . DS);

// Base urls
define('BASE_URL', '/public/');
define('CSS_PATH', BASE_URL . 'css/');
define('JS_PATH', BASE_URL . 'js/');
define('IMG_PATH', BASE_URL . 'image/');

// Accès de connection à la base de données
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'todotime');
define('DB_ENCODING', 'UTF8');
define('DB_DSN', sprintf('mysql:host=%s;dbname=%s;', 
    DB_HOST,
    DB_NAME
));
