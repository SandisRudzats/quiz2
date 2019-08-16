<?php

namespace Quiz;
use Illuminate\Database\Capsule\Manager as Capsule;
//Globals
define('DS', DIRECTORY_SEPARATOR);
define('VIEW_BASE_FOLDER', __DIR__ . DS . 'views');
define('TEMPLATE_BASE_FOLDER', __DIR__ . DS . 'templates');


//helper

require_once 'functions.php';
//Databases

require_once 'config.php';

$capsule = new Capsule;


$capsule->addConnection([
    'driver'    => DRIVER,
    'host'      => HOST,
    'database'  => DATABASE,
    'username'  => USERNAME,
    'password'  => PASSWORD,
    'charset'   => CHARSET,
    'collation' => COLLATION,
    'prefix'    => PREFIX,
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();