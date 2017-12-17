<?php
/**
 * User: xdoser
 * Date: 17-12-2017
 * Time: 14:36
 */

namespace App\Controllers;

use App\Models\QuestionLike;
use App\Models\User;
use Respect\Validation\Validator as v;
use App\Helpers\JsonResponse;

class TestController extends Controller
{
    public function test()
    {
        $user = (new \App\Auth\Auth())->user();
        $test = QuestionLike::whereQuestionId(27)->whereUserId($user->id)->first();
        return dump($test);
    }
}