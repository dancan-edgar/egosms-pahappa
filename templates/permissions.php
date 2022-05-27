<div class="wrap form-container">
    <h1 style="font-weight: 500;text-transform: uppercase">Egosms Message Permissions</h1>
    <hr />
    <?php settings_errors(); ?>

    <form id="message-permissions-form" method="post">
        <?php
        // output security fields for the registered setting "wporg_options"
        settings_fields( 'egosms_permissions' );
        // output setting sections and their fields
        // (sections are registered for "wporg", each field is registered to a specific section)
        do_settings_sections('permissions');
        // output save settings button
        submit_button('Save Permissions');
        ?>

    </form>
</div>



