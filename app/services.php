<?php

use App\Twig\TranslatorExtension;
use App\Twig\DumpExtension;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;

//TODO: Active in production
//Override the default Not Found Handler
//$container['notFoundHandler'] = function ($container) {
//    return function ($request, $response) use ($container) {
//        return $container['view']->render($response->withStatus(404), 'error/404.twig');
//    };
//};

/*
 * Services
 */

$container['db'] = function() use ($capsule) {
    return $capsule;
};

$container['auth'] = function () {
    return new App\Auth\Auth;
};

$container['flash'] = function() {
    return new \Slim\Flash\Messages;
};

$container['translator'] = function ($container) {
	$loader = new FileLoader(new Filesystem(), $container['settings']['translations_path']);
    // Register the Dutch translator (set to "en" for English)
    $translator = new Translator($loader, "en");
    return $translator;
};

$container['view'] = function($container) {
    
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => $container->settings['views']['cache'],
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    /**
     * Add auth var to view
     */
    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user(),
    ]);

    /**
     * Add flash message to view
     */
    $view->getEnvironment()->addGlobal('flash', $container->flash);
	
	// add translator functions to Twig
    $view->addExtension(new TranslatorExtension($container->translator));

    // add var dumper ex
    $view->addExtension(new DumpExtension);

    return $view;
};

$container['csrf'] = function () {
    return new \Slim\Csrf\Guard;
};

$container['validator'] = function () {
    return new App\Validation\Validator;
};


/*
 * Controllers
 */

new \App\Base\ControllerRegistor($container, [
    'App\Controllers\ProfileController',
    'App\Controllers\HomeController',
    'App\Controllers\Auth\PasswordController',
    'App\Controllers\Auth\AuthController',
    'App\Controllers\QuestionController',
    'App\Controllers\TestController',
]);


