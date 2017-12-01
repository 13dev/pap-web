<?php
/**
 * Created by PhpStorm.
 * User: xdoser
 * Date: 18-11-2017
 * Time: 14:34
 */

namespace App\Helpers;


class JsonResponse
{
    private static $builder = null;

    public static function build($success = null, $data = null, $message = null)
    {
        $builder['success'] = (isset($success) || is_null($success)) ? $success : "";

        $builder['data'] = (isset($data) || is_null($data)) ? $data : "";

        $builder['message'] = (isset($message) || is_null($message)) ? $message : "";

        return $builder;
    }


}