<?php

use Core\Application;

//define path constants
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', '..' . DS);
define('APPLICATION_PATH', ROOT_PATH . 'Application');
define('LIBRARY_PATH', ROOT_PATH . 'library');
define('CORE_APPLICATION_PATH', ROOT_PATH . implode(DS, array('library', 'Core', 'Application')));
define('VIEW_PATH', implode(DS, array(APPLICATION_PATH, 'views')));

$settings = require implode(DS, array(APPLICATION_PATH, 'config', 'application.php'));
require_once CORE_APPLICATION_PATH . '.php';

$app = new Application($settings);
$app->run();
