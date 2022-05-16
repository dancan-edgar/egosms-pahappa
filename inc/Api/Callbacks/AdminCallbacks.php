<?php
/**
 * @package Egosms
 */

namespace Inc\Api\Callbacks;


class AdminCallbacks
{
    public function adminDashboard()
    {
        return require_once (PLUGIN_PATH . "/templates/admin.php");
    }
    public function outboxDashboard()
    {
        return require_once (PLUGIN_PATH . "/templates/outbox.php");
    }

    public function adminPermissions(){

        return require_once(PLUGIN_PATH . "/templates/permissions.php");
    }

    public function checkboxSanitize($input){

        return (isset($input) ? true : false);
    }

    public function messageSending($args)
    {
        $name = $args['name'];
//        var_dump($args);
        $value = esc_attr(get_option('egosms_send_message'));
        echo '<input type="text" name="' . $name . '" class="regular_text" value="' . $value . '">';
    }

    public function permissionCheckbox($args)
    {
        $name = $args['name'];
//        var_dump($args);
        $value = esc_attr(get_option('egosms_permissions'));

        echo '<input type="checkbox" name="' . $name . '" class="regular_text" value="' . $value . '">';
    }

    function get_editable_roles() {
        global $wp_roles;

        $all_roles = $wp_roles->roles;
        $editable_roles = apply_filters('editable_roles', $all_roles);

        return $editable_roles;
    }


    public function roleDropdown($args)
    {
        $name = $args['name'];
//        var_dump($args);
        $value = esc_attr(get_option('egosms_permissions'));

        $roles = $this->get_editable_roles();

        echo '<select name="' . $name . '">';
        foreach ($roles as $key => $role){
            echo '<option value="' . $key . '"> ' . $role["name"] . ' </option>';
        }
        echo '</select>';
    }

}
