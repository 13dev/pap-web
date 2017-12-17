<?php
/***
 * User: xdoser
 * Date: 19-11-2017
 * Time: 17:05
 */

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

date_default_timezone_set('UTC');

$config = [
    'settings' => [
        'displayErrorDetails' => true,
        //'addContentLengthHeader' => false,
        'db' => [
            'driver'        => getenv('DB_TYPE'),
            'host'          => getenv('DB_HOST'),
            'username'      => getenv('DB_USERNAME'),
            'database'      => getenv('DB_NAME'),
            'password'      => getenv('DB_PASSWORD'),
            'charset'       => 'utf8',
            'collation'     => 'utf8_unicode_ci',
            'prefix'        => '',
        ],

        'translations_path' => __DIR__ . '/Translations/', // path to the translation files

    ],

];

/**
 * set var dumper config
 */
VarDumper::setHandler(function($var){
    $cloner = new VarCloner();

    $htmlDumper = new HtmlDumper();

    $htmlDumper->setStyles([
        'default' => 'background-color:#fff; color:#FF8400; line-height:1.2em; font:14px Menlo, Monaco, Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:99999; word-break: break-all',
        'public' => 'color:#222',
        'protected' => 'color:#222',
        'private' => 'color:#222',
        'ref' => 'color:#A0A0A0!important',
    ]);

    $dumper = PHP_SAPI === 'cli' ? new CliDumper() : $htmlDumper;

    return $dumper->dump($cloner->cloneVar($var));
});

