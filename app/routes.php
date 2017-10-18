<?php

/**
 * Routes
 */

$app->get('/', 'HomeController:index')->setName('home');

//Auth
$app->get('/signup', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/signup', 'AuthController:postSignUp');