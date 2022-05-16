<?php
function SendSMS($username, $password, $sender, $number, $message)
{
    /*-----------------------------------------*/
    /* Sending data is handled here */
    /*-----------------------------------------*/

    $url = "sandbox.egosms.co/api/v1/plain/?";

    $parameters = "number=[number]&message=[message]&username=[username]&password=[password]&sender=[sender]";
    $parameters = str_replace("[message]", urlencode($message), $parameters);
    $parameters = str_replace("[sender]", urlencode($sender), $parameters);
    $parameters = str_replace("[number]", urlencode($number), $parameters);
    $parameters = str_replace("[username]", urlencode($username), $parameters);
    $parameters = str_replace("[password]", urlencode($password), $parameters);
    $live_url = "http://" . $url . $parameters;
    $parse_url = file($live_url);
    $response = $parse_url[0];


    // insert sent message into the egosms table
    require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../../wp-config.php');

    global $wpdb;
    $table_name = $wpdb->prefix.'egosms';

    $sender = $_POST['egosms-sender'];
    $number = $_POST['egosms-number'];
    $message = $_POST['egosms-message'];
    $msg_success = 'Sent';
    $msg_failure = 'Not Sent';


    //  if(){
    $wpdb->insert ( $table_name,
        array(
            'sender_id'=> $sender,
            'receipient' => $number,
            'message_body' => $message,
            'message_status' => $msg_success
        ),
        array(
            '%s', // for string format
            '%s',
            '%s',
            '%s'
        ),
    );
    //  }else{
    //     $wpdb->insert ( $table_name,
    //         array(
    //             'sender_id'=> $sender,
    //             'receipient' => $number,
    //             'message_body' => $message,
    //             'message_status' => $msg_failure
    //         ),
    //         array(
    //             '%s',
    //             '%s',
    //             '%s',
    //             '%s'
    //         ),
    //     );
    // }
    return $response;
}

function sanitizeData($value)
{

    $value = htmlspecialchars($value);

    $value = htmlentities($value);

    $value = stripslashes($value);

    $value = strip_tags($value);

    return $value;

}

$username = $_POST['egosms-username'];
$password = $_POST['egosms-password'];
$sender = $_POST['egosms-sender'];
$number = $_POST['egosms-number'];
$message = $_POST['egosms-message'];

echo SendSMS($username, $password, $sender, $number, $message);

