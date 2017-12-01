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

        $user = $this->auth->user();
        $questions = $user->questions()->whereDoesntHave('answer')->get();

        return $this->view->render($response, 'question/get.twig', [
            'user' => $user,
            'questions' => $questions,
        ]);
    }


    public function setQuestion($request, $response)
    {
        sleep(0.5);

        $json = [
            'csrf' => [
                $this->csrf->getTokenName(),
                $this->csrf->getTokenValue(),
            ]
        ];

        $validation = $this->validator->validate($request, [
            'question'  => v::notEmpty(),
            'reciver'   => v::notEmpty()->alnum(),
            'hidden'    => v::notEmpty()->boolVal(),
        ], false); // do not store the errors on session

        if($validation->failed())
        {
            return $response->withJson(
                JsonResponse::build("error", $json, array_first($this->validator->getErrors())),
                200, JSON_UNESCAPED_UNICODE);
        }

        $data = [
            'text'      => $request->getParsedBodyParam('question'),
            'id_from'   => ($this->auth->check()) ? $this->auth->user()->id : null,
            'id_for'    => $request->getParsedBodyParam('reciver'),
            'hidden'    => ($request->getParsedBodyParam('hidden') == 'true' || !$this->auth->check()) ? 1 : 0,
            'read'      => 0,
        ];

         if(!$reciver = User::where('username', $data['id_for'])->firstOrFail())
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