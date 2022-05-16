<?php

/**
 * @package Egosms
 */

namespace Inc;

use Inc\Api\Permissions;
use Inc\Api\SettingsApi;

final class Init
{

    /***
     * Store all classes in an array
     * @return array Full list of classes
     */
    public static function get_services()
    {

        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLink::class,
            Api\Permissions::class
        ];
    }

    /***
     * Loop through all the classes and Instantiate them
     * Call the register method ( If it exists)
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class){
            $service = self::instantiate($class);
            if( method_exists($service, 'register')){
                $service->register();
            }
        }
    }

    /***
     * @param $class class from the services array
     * @return class instance new instance of the class
     */
    public static function instantiate($class){

        $service = new $class;

        return $service;
    }
}

