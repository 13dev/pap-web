<?php
/**
 * User: xdoser
 * Date: 01-12-2017
 * Time: 21:22
 */

namespace App\Twig;


class DumpExtension extends \Twig_Extension
{

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('dump', array($this, 'dump')),
        ];
    }

    public function dump($var)
    {
        return dump($var);
    }
}