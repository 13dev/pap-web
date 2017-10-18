<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'username' => 'root',
            'database' => 'askpit',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]
	],
    
]);


$container = $app->getContainer();

/**
 * Add Eloquent to project
 */
$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal(); // use facades
$capsule->bootEloquent();

$container['db'] = function($container) use ($capsule) {
    return $capsule;
};

$container['view'] = function($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    return $view;
};

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

$container['validator'] = function ($container) {
    return new \App\Validation\Validator;
};

$container['AuthController'] = function ($container) {
    return new \App\Controllers\Auth\AuthController($container);
};

require __DIR__ . '/../app/routes.php';