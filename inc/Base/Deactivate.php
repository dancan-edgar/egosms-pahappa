<?php

/**
 * @package Egosms
 */

namespace Inc\Base;

class Deactivate {
    public static function deactivate()
    {
        echo "Nice!";
        flush_rewrite_rules();
    }
}