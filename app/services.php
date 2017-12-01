<?php

$container['db'] = function() use ($capsule) {
    return $capsule;
};

$container['auth'] = function () {
    return new App\Auth\Auth;
};

$container['flash'] = function() {
    return new \Slim\Flash\Messages;
};

$container['view'] = function($container) {
    
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
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

    return $view;
};

//TODO: Active in production
//Override the default Not Found Handler
//$container['notFoundHandler'] = function ($container) {
//    return function ($request, $response) use ($container) {
//        return $container['view']->render($response->withStatus(404), 'error/404.twig');
//    };
//};

$container['HomeController'] = function ($container) {
    return new App\Controllers\HomeController($container);
};

$container['PasswordController'] = function ($container) {
    return new App\Controllers\Auth\PasswordController($container);
};

$container['ProfileController'] = function ($container) {
    return new App\Controllers\ProfileController($container);
};

$container['validator'] = function () {
    return new App\Validation\Validator;
};

$container['AuthController'] = function ($container) {
    return new App\Controllers\Auth\AuthController($container);
};

$container['QuestionController'] = function ($container) {
    return new App\Controllers\QuestionController($container);
};

$container['AnswerController'] = function ($container) {
    return new App\Controllers\AnswerController($container);
};

$container['csrf'] = function () {
    return new \Slim\Csrf\Guard;
};

