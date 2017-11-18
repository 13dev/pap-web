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

class QuestionController extends Controller
{
    public function getQuestion($request, $response)
    {
        echo "<pre>";
        //print_r(User::find(1)->questions()->get());
        return "";
    }
    public function setQuestion($request, $response)
    {
        //TODO: MUDAR O VALIDADOR, ESTE GUARDA NA SESSÃO, O MESMO NAO PODE SER UTILIZADO POR AJAX!
        $validation = $this->validator->validate($request, [
            'question' => v::notEmpty(),
        ]);

        if($validation->failed()){
            //TODO: Mudar, retornar json estruturado...
            return $response->withStatus(404);
        }

        Question::create([
            'text' => $request->getParam('question'),
            'id_from' => 1,
            'id_for' => 1,
            'hidden' => 0,
            'points' => 1
        ]);

        //TODO: MUDAR ESTRUTURA DO JSON, E PROCURAR SE É BOA PRATICA RETORNAR TOKENS DE CSRF
        return json_encode([
            $this->container->csrf->getTokenName(),
            $this->container->csrf->getTokenValue(),
        ]);
    }
}