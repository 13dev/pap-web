<?php
/**
 * Created by PhpStorm.
 * User: xdoser
 * Date: 17-11-2017
 * Time: 15:22
 */

namespace App\Controllers;

use App\Models\Question;
use App\Models\User;
use Respect\Validation\Validator as v;
use App\Helpers\JsonResponse;

class QuestionController extends Controller
{
    public function getQuestion($request, $response)
    {
        $json = JsonResponse::build('1', 2, 4);
        //print_r(User::find(1)->questions()->get());
        return $response->withJson($json, 200, JSON_UNESCAPED_UNICODE);
    }

    public function setQuestion($request, $response)
    {

        $data = [
            'text'      => $request->getParsedBodyParam('question'),
            'id_from'   => ($this->auth->check()) ? $this->auth->user()->id : null,
            'id_for'    => $request->getParsedBodyParam('reciver'),
            'hidden'    => ($request->getParsedBodyParam('hidden') == 'true' || !$this->auth->check()) ? 1 : 0,
            'read'      => 0,
        ];

         $json = [
            'csrf' => [
                $this->csrf->getTokenName(),
                $this->csrf->getTokenValue(),
            ]
        ];

        //Question validation
        if (empty($data['text']) || is_null($data['text']))
        {
            return $response->withJson(
                JsonResponse::build("error", $json, "The Question is not valid."),
                200, JSON_UNESCAPED_UNICODE);

        }

         $reciver = User::where('username', $data['id_for'])->first();

         if(!$data['id_for'] || !$reciver)
         {
             // the question dont have a reciver!
             return $response->withJson(
                 JsonResponse::build("error", $json, "Internal Error please come back soon as possible."),
                 200, JSON_UNESCAPED_UNICODE);
         }

         //update username to id
         $data['id_for'] = $reciver->id;

         //insert question
         if(!Question::create($data))
         {
             return $response->withJson(
                 JsonResponse::build("error", $json, "Internal Error, please come back soon as possible."),
                 200, JSON_UNESCAPED_UNICODE);
         }

        return $response->withJson(
            JsonResponse::build("success", $json, "Message send."),
            200, JSON_UNESCAPED_UNICODE);
    }
}