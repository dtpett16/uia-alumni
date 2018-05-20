<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

function tockify_func($atts)
{
    $atts = array_merge(array(
        'calendar' => 'spirited',
        'component' => 'calendar'
    ), $atts);

    $embedstring = "<br><div";
    foreach ($atts as $key => $value) {
        $embedstring .= " data-tockify-" . $key . "=\"" . $value . "\"";
    }
    $embedstring .= "></div>";
    $embedstring .= "<script type='text/javascript'>";
    $embedstring .= "if (window._tkf && window._tkf.loadDeclaredCalendars) {";
    $embedstring .= "window._tkf.loadDeclaredCalendars();}</script>";
    return $embedstring;
}

add_shortcode('tockify', 'tockify_func');


?>
