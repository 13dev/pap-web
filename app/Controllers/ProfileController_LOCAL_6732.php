<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Question;
/**
* Profile of user
*/
class ProfileController extends Controller
{

	function getProfile($request, $response, $args)
	{
		if(!User::where('username', $args['username'])->exists()){
			return $this->view->render($response, 'error/404.twig');
		}

		$user = User::where('username', $args['username'])->first();

		$questionsWithAnswer = $user->questions()->has('answer')->get();

		return $this->view->render($response, 'profile/get.twig', [
		    'user' => $user,
            'questions' => $questionsWithAnswer,
        ]);
	}
}