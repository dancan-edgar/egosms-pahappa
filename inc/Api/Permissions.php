<?php
/**
 * @package Egosms
 */

namespace Inc\Api;

class Permissions
{
    function register(){

        // Add simple_role capabilities, priority must be after the initial role definition.
        if($_POST['role']){
            if(add_action('after_setup_theme', array($this,'egosms_role_caps'), 11)){
                add_action( 'admin_notices', array($this,'my_acf_admin_notice') );
            }
        }
    }

    function egosms_role_caps()
    {

        $choosenRole = $_POST['role'];
        $sendMessage = isset($_POST['send-message']) ? 'send_message' : '';
        $checkMessage = isset($_POST['check-messages']) ? 'check_messages' : '';
        $viewMessage = isset($_POST['view-messages']) ? 'view_messages' : '';
        $deleteMessage = isset($_POST['delete-messages']) ? 'delete_messages' : '';

        // Gets the simple_role role object.
        $role = get_role($choosenRole);

        // Add a new capability.
//    $role->add_cap( 'edit_others_posts', true );

        if ($sendMessage != '') {
            $role->add_cap($sendMessage, true);
        }
        if ($checkMessage != '') {
            $role->add_cap($checkMessage, true);
        }
        if ($viewMessage != '') {
            $role->add_cap($viewMessage, true);
        }
        if ($deleteMessage != '') {
            $role->add_cap($deleteMessage, true);
        }


    }


    function my_acf_admin_notice() {
        ?>
        <div class="notice updated my-acf-notice is-dismissible" >
            <p><?php _e( 'Persmissions saved', 'egosms' ); ?></p>
        </div>


        <?php
    }



}



