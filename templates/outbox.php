<?php
global $wpdb;
$table_name = $wpdb->prefix . 'egosms';
$msg_result = $wpdb->get_results("SELECT * FROM $table_name");
?>

<style>

    :root {
        --main-border: .5px solid rgba(128, 128, 128, 0.37);
        --main-font: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    }
    h1 {
        font-weight: 500;
        text-transform: uppercase;
    }
    .tb-message,.th-message {
        border: var(--main-border);
        border-collapse: collapse;
    }
    .tb-message {
        width: 100%;
        font-family: var(--main-font);
        line-height: 3;
    }
    .tb-message :is(th,td){
        padding: 0 15px;
    }

    .th-message {
        text-align: left;
        font-size: 15px;
        font-weight: lighter;
    }
    .tbody-message:nth-child(even){

        background-color: #F6F7F7;

    }
    .tbody-message :is(td:first-child,td:nth-child(3)) {
        font-weight: 500;
    }

</style>
<div class="wrap form-container">
    <h1>SENT MESSAGES</h1>
    <?php settings_errors(); ?>

    <table class="tb-message" cellspacing="0">
        <tr class="th-message">
            <th>Date & Time</th>
            <th>Sender ID</th>
            <th>Receipient</th>
            <th>Message</th>
            <th>Status</th>
        </tr>
        <?php
        foreach ($msg_result as $msg_row) {
            $datetime = $msg_row->send_date;
            $sender = $msg_row->sender_id;
            $receipient = $msg_row->receipient;
            $message = $msg_row->message_body;
            $status = $msg_row->message_status;

            ?>
            <tr class="tbody-message">
                <td><?php echo $datetime; ?></td>
                <td><?php echo $sender; ?></td>
                <td><?php echo $receipient; ?></td>
                <td><?php echo $message; ?></td>
                <td><?php echo $status; ?></td>
            </tr>
        <?php } ?>
    </table>

    <p class="msg"></p>
</div>