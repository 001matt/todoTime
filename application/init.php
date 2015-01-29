<?php // app/init.php

use Ipf\Db\Connection\Pdo;
use Ipf\Loader\ClassLoader;

//Header
header('Content-type: text/html; charset=UTF-8');

// Loading conf
require_once 'config/global.php';

// APPLICATION PATHS
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            LIB_PATH,
            SRC_PATH,
        )
    )
);

// Initialize autoloader
require_once 'Ipf/Loader/ClassLoader.php';
$loader = new ClassLoader('Ipf', LIB_PATH);

// Initialisation de la base de données
$connection = new Pdo(DB_DSN, DB_USERNAME, DB_PASSWORD);
