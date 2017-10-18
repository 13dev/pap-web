<?php

namespace App\Controllers;


use App\Models\User;
/**
* Home controller Teste
*/
class HomeController extends Controller
{

	function index($request, $response)
	{

		$this->view->render($response, 'home.twig');
	}
}