<?php
error_reporting(-1);
use vendor\core\Router;
//require_once "../vendor/core/Router.php";
require_once "../vendor/libs/functions.php";
//require_once "../app/controllers/Main.php";
//require_once "../app/controllers/Posts.php";
//require_once "../app/controllers/PostsNew.php";
define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LIBS', dirname(__DIR__) . '/vendor/libs');
define('CONFIG', dirname(__DIR__) . '/config');
define('CACHE', dirname(__DIR__) . '/tmp/cache');
define('LAYOUT', 'default');

spl_autoload_register(function ($class) {
   $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
   if(is_file($file)) {
       require_once $file;
   }
});

new \vendor\core\App();
$query =  rtrim($_SERVER['QUERY_STRING'], '/');


Router::add('^admin$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^print$', ['controller' => 'Main', 'action' => 'index']);


// default rules
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
Router::dispatch($query);