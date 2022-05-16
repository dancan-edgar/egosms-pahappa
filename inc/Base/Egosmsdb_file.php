<?php
/*-----------------------------------------*/
/* Handle table creation and deletion here */
/*-----------------------------------------*/

// create egosms table on plugin activation
function create_egosms_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'egosms';

    // $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            id int(9) NOT NULL AUTO_INCREMENT,
            send_date datetime DEFAULT current_timestamp,
            sender_id text NOT NULL,
            receipient text NOT NULL,
            message_body text NOT NULL,
            message_status text NOT NULL,
            PRIMARY KEY  (id)
        )";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

}


// delete egosms table on plugin uninstall
function drop_egosms_table()
{

}