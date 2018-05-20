<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}


function plugin_admin_add_page()
{
    add_options_page('Custom Plugin Page', 'Custom Plugin Menu', 'manage_options', 'plugin', 'plugin_options_page');
}

add_action('admin_menu', 'plugin_admin_add_page');


//admin/settings page
add_action('admin_menu', 'tkf_add_admin_menu');
add_action('admin_init', 'tkf_settings_init');

function tkf_add_admin_menu()
{
    add_menu_page('Tockify Calendar', 'Tockify Calendar',
        'manage_options', 'tockify_calendar', 'tkf_options_page');
}

function tkf_settings_section_callback()
{

    //echo __( 'How to use Tockify EventsCalendar with WordPress', 'wordpress' );
    ?>
    <div class="welcome-panel" style="padding-top:0">
        <div class="welcome-panel-content">
            <div class="welcome-panel-column-container ">
                <div class="welcome-panel-column" style="width:31%;padding:0 1  %">
                    <h4>About Tockify Calendars</h4>

                    <p>This plugin provides a shortcode and widget that you can use to seamlessly
                        embed a Tockify Calendar in your WordPress site.</p>

                    <p>Tockify calendars are cross platform and are managed outside of WordPress.</p>

                    <p>If you don't have a Tockify Calendars account you can
                        <a href="https://tockify.com" target="_blank">get one here</a>.</p>
                </div>
                <div class="welcome-panel-column" style="width:31%;padding:0 1%">
                    <h4>Using The Shortcode</h4>

                    <p>To use the shortcode just add:
                    <pre>[tockify calendar="spirited"]</pre>
                    to any page or post making sure
                    you replace <b>spirited</b> with the calendar name from your Tockify Calendars account (spirited is
                    the name of our demo calendar).</p>
                    <p>If you'd prefer to use the mini-calendar just add <code> component="mini"</code> to the
                    the shortcode above</p>
                </div>
                <div class="welcome-panel-column" style="width:31%;padding:0 1%">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="https://tockify.com/i/docs/install/wordpress">Detailed Install Instructions</a>
                        </li>
                        <li><a href="https://tockify.com/i/customizer">Calendar Customization Tool</a></li>
                        <li><a href="https://tockify.com/i/upcomingCustomizer">Mini Calendar Customization Tool</a></li>
                        <li><a href="https://tockify.com/i/docs/faq">Frequently asked Questions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php

}


function tkf_settings_init()
{
     // register_setting('pluginPage', 'tkf_settings');

    add_settings_section(
        'tkf_pluginPage_section',
        __('How to use Tockify Events Calendar with WordPress', 'wordpress'),
        'tkf_settings_section_callback',
        'pluginPage'
    );

    add_settings_field("tkf_script_async",
        "Load Script Asynchronously", "tkf_script_async_callback", "pluginPage","tkf_pluginPage_section");
    add_settings_field("tkf_script_defer",
        "Load Script Deferred", "tkf_script_defer_callback", "pluginPage","tkf_pluginPage_section");

    register_setting("pluginPage", "tkf_script_async");
    register_setting("pluginPage", "tkf_script_defer");

}

function tkf_script_async_callback() {
    $html = '<input type="checkbox" id="tkf_script_async" name="tkf_script_async" value="1" '
        . checked( 1, get_option('tkf_script_async'), false ) . '/>';
    $html .= '<label for="tkf_script_async">Add async attribute</label>';

    echo $html;
}

function tkf_script_defer_callback() {
    $html = '<input type="checkbox" id="tkf_script_defer" name="tkf_script_defer" value="1" '
        . checked( 1, get_option('tkf_script_defer'), false ) . '/>';
    $html .= '<label for="tkf_script_defer">Add defer attribute</label>';

    echo $html;
}

function tkf_options_page()
{

    ?>
    <div class="wrap">

        <form method='POST' action="options.php">
            <h2>Tockify Events Calendar</h2>
            <?php
            settings_fields('pluginPage');
            do_settings_sections('pluginPage');
            submit_button();
            ?>
        </form>
    </div>
    <?php

}

//create a link to the settings page from the plugins list
function plugin_add_settings_link($links)
{
    $settings_link = '<a href="admin.php?page=tockify_calendar">' . __('How To Use') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}


$tmp_plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$tmp_plugin", 'plugin_add_settings_link');

?>