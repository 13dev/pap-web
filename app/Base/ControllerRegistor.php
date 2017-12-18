<?php
/**
 * User: xdoser
 * Date: 17-12-2017
 * Time: 20:16
 */

namespace App\Base;


class ControllerRegistor
{
    public function __construct(&$container, array $classes)
    {
        foreach ($classes as $class)
        {
            $nameClass = explode('\\', $class );
            $nameClass = end($nameClass);

            $container[$nameClass] = function ($container) use($class){

                return new $class($container);
            };
        }
    }
}