<div class="wrap form-container">
    <h1 style="font-weight: 500;text-transform: uppercase">Egosms Bulk Messaging Plugin</h1>
    <hr />
    <?php settings_errors(); ?>

    <form id="send-message-form" method="post">
        <?php
        // output security fields for the registered setting "wporg_options"
        settings_fields( 'egosms_options_group' );
        // output setting sections and their fields
        // (sections are registered for "wporg", each field is registered to a specific section)
        do_settings_sections('egosms');
        // output save settings button
        submit_button("Send message");
        ?>

    </form>
    <p class="msg"></p>
</div>
