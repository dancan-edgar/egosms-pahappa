<?php
/**
 * @package Egosms
 */

namespace Inc\Base;

class Enqueue
{

    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    // Function to enqueue scripts
    function enqueue()
    {

        wp_enqueue_style('my_plugin_style', PLUGIN_URL . 'assets/style.css');

        wp_enqueue_script('my_plugin_script', PLUGIN_URL . 'assets/script.js');
    }
}