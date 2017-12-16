<?php

use Respect\Validation\Validator as v;

session_start();

require __DIR__ . '/../vendor/autoload.php';

//config
require __DIR__ . '/../app/config.php';

$app = new \Slim\App($config);


$container = $app->getContainer();

/**
 * Add Eloquent to project
 */
$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal(); // use facades
$capsule->bootEloquent();

//add services to app
require __DIR__ . '/../app/services.php';

//Add Middleware to app
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfMiddleware($container));
$app->add($container->csrf);
$app->add(new \MikeScott\Minifier\Minifier());

//Add custom rules
v::with('App\\Validation\\Rules\\');

require __DIR__ . '/../app/routes.php';