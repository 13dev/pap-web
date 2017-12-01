<?php
/**
 * User: xdoser
 * Date: 26-11-2017
 * Time: 18:01
 */

namespace App\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Respect\Validation\Validator as v;
use App\Helpers\JsonResponse;
use Slim\Http\Request;
use Slim\Http\Response;

class AnswerController extends Controller
{
    private $user;

    function __construct($container)
    {
        parent::__construct($container);

        $this->user = $this->auth->user();
    }

    public function getAnswer(Request $request, Response $response)
    {
        echo "<pre>";
        dd();
    }
}