<?php
/**
 * @package Egosms
 */

namespace Inc\Pages;

use \Inc\Api\SettingsApi;

use \Inc\Api\Callbacks\AdminCallbacks;

class Admin
{

    public $settings;

    public $callbacks;

    public $pages = array();

    public $subpages = array();

    public function register()
    {

//        add_action('admin_menu', array($this, 'add_menu_pages'));
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->callbacks->get_editable_roles();

        $this->setPages();

        $this->setSubpages();

        $this->setSettings();

        $this->setSections();

        $this->setFields();

        $this->settings->withSubPage('Dashboard')->addSubPages($this->subpages)->addPages($this->pages)->register();
    }

    public function setPages()
    {
        $this->pages = array(
            array(
                'page_title' => 'Egosms',
                'menu_title' => 'Egosms',
                'capability' => 'manage_options',
                'menu_slug' => 'egosms',
                'callback' => array($this->callbacks,'adminDashboard'),
                'icon_url' => PLUGIN_URL . '/assets/img/icon.png',
                'position' => 110
            )
        );
    }

    public function setSubpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'egosms',
                'page_title' => 'Outbox',
                'menu_title' => 'Outbox',
                'capability' => 'view_messages',
                'menu_slug' => 'egosms_outbox',
                'callback' => array($this->callbacks,'outboxDashboard'),
            ),
            array(
                'parent_slug' => 'egosms',
                'page_title' => 'Permissions',
                'menu_title' => 'Permissions',
                'capability' => 'manage_options',
                'menu_slug' => 'permissions',
                'callback' => array($this->callbacks,'adminPermissions'),
            )
        );
    }

    public function setSettings()
    {
        $args = array(
            array(
                'option_group' => 'egosms_send_message_group',
                'option_name' => 'egosms_send_message',
                'callback' => ''
            ),
            array(
                'option-group' => 'egosms_permissions_group',
                'option_name' => 'egosms_permissions',
                'callback' => array($this->callbacks,'checkboxSanitize'),
            )
        );

        $this->settings->setSettings($args);
    }

    public function setSections()
    {
        $args = array(
            array(
                'id' => 'egosms_userdata_section',
                'title' => 'User Data',
                'callback' => '',
                'page' => "egosms"
            ),
            array(
                'id' => 'egosms_msgdata_section',
                'title' => 'Message Data',
                'callback' => '',
                'page' => "egosms"
            ),
            array(
                'id' => 'egosms_roles_section',
                'title' => 'Roles',
                'callback' => function(){
                    echo "Select Role and set permissions";
                },
                'page' => "permissions"
            ),
            array(
                'id' => 'egosms_permissions_section',
                'title' => 'Permissions',
                'callback' => function(){
                    echo "Manage permissions.";
                },
                'page' => "permissions"
            )
        );

        $this->settings->setSections($args);
    }

    public function setFields()
    {
        $args = array(
            array(
                'id' => 'egosmsUsername',
                'title' => 'User Name',
                'callback' => array($this->callbacks,'messageSending'),
                'page' => "egosms",
                'section' => 'egosms_userdata_section',
                'args' => array(
                    'label_for' => 'Username',
                    'class' => 'example_class',
                    'name' => 'egosms-username'
                )
            ),
            array(
                'id' => 'egosmsPassword',
                'title' => 'Password',
                'callback' => array($this->callbacks,'messageSending'),
                'page' => "egosms",
                'section' => 'egosms_userdata_section',
                'args' => array(
                    'label_for' => 'Password',
                    'class' => 'example_class',
                    'name' => 'egosms-password'
                )
            ),
            array(
                'id' => 'egosmsNumber',
                'title' => 'Number',
                'callback' => array($this->callbacks,'messageSending'),
                'page' => "egosms",
                'section' => 'egosms_msgdata_section',
                'args' => array(
                    'label_for' => 'Number',
                    'class' => 'example_class',
                    'name' => 'egosms-number'
                )
            ),
            array(
                'id' => 'egosmsSender',
                'title' => 'Sender ID',
                'callback' => array($this->callbacks,'messageSending'),
                'page' => "egosms",
                'section' => 'egosms_msgdata_section',
                'args' => array(
                    'label_for' => 'Sender ID',
                    'class' => 'example_class',
                    'name' => 'egosms-sender'
                )
            ),
            array(
                'id' => 'egosmsMessage',
                'title' => 'Message',
                'callback' => array($this->callbacks,'messageSending'),
                'page' => "egosms",
                'section' => 'egosms_msgdata_section',
                'args' => array(
                    'label_for' => 'Message',
                    'class' => 'example_class',
                    'name' => 'egosms-message',
                )
            ),

            array(
                'id' => 'availableRoles',
                'title' => 'Select roles',
                'callback' => array($this->callbacks,'roleDropdown'),
                'page' => "permissions",
                'section' => 'egosms_roles_section',
                'args' => array(
                    'label_for' => 'Roles',
                    'class' => 'example_class',
                    'name' => 'role'
                )
            ),
            array(
                'id' => 'sendMessagePermission',
                'title' => 'Send Message',
                'callback' => array($this->callbacks,'permissionCheckbox'),
                'page' => "permissions",
                'section' => 'egosms_permissions_section',
                'args' => array(
                    'label_for' => 'Send Message',
                    'class' => 'example_class',
                    'name' => 'send-message'
                )
            ),
            array(
                'id' => 'checkBalancePermission',
                'title' => 'Check Balance',
                'callback' => array($this->callbacks,'permissionCheckbox'),
                'page' => "permissions",
                'section' => 'egosms_permissions_section',
                'args' => array(
                    'label_for' => 'Check Balance',
                    'class' => 'example_class',
                    'name' => 'check-messages'
                )
            ),
            array(
                'id' => 'viewMessagesPermission',
                'title' => 'View Messages',
                'callback' => array($this->callbacks,'permissionCheckbox'),
                'page' => "permissions",
                'section' => 'egosms_permissions_section',
                'args' => array(
                    'label_for' => 'View Messages',
                    'class' => 'example_class',
                    'name' => 'view-messages'
                )
            ),
            array(
                'id' => 'deleteMessagesPermission',
                'title' => 'Delete Messages',
                'callback' => array($this->callbacks,'permissionCheckbox'),
                'page' => "permissions",
                'section' => 'egosms_permissions_section',
                'args' => array(
                    'label_for' => 'Delete Messages',
                    'class' => 'example_class',
                    'name' => 'delete-messages'
                )
            )
        );

        $this->settings->setFields($args);
    }
}
