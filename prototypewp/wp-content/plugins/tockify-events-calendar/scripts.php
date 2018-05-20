<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

function tockify_add_attribute($tag, $handle) {
    if ('tockify_embed.js' !== $handle)
        return $tag;
    $tkf_tag = str_replace(' src=', ' data-cfasync="false" src=', $tag);
    if (get_option('tkf_script_async') == 1) {
        $tkf_tag = str_replace(' src=', ' async src=', $tkf_tag);
    }
    if (get_option('tkf_script_defer') == 1) {
        $tkf_tag = str_replace(' src=', ' defer src=', $tkf_tag);
    }
    return $tkf_tag;
}


function tockify_scripts()
{
    wp_enqueue_script('tockify_embed.js', 'https://public.tockify.com/browser/embed.js');
    add_filter('script_loader_tag', 'tockify_add_attribute', 10, 2);

if (function_exists('wp_add_inline_script')) {

    wp_add_inline_script('tockify_embed.js', '
(function(history){
  if (history) {
    var pushState = history.pushState;
    history.pushState = function (state) {
      if (typeof history.onpushstate === "function") {
        history.onpushstate({state: state});
      }
      if (_tkf && _tkf.loadDeclaredCalendars) {
        for (var i = 0; i < 20; i++) {
          setTimeout(function () {
            _tkf.loadDeclaredCalendars();
          }, i * 100);
        }
      }
      return pushState.apply(history, arguments);
    }
  }
})(window.history);', 'after');
}

}

add_action('wp_enqueue_scripts', 'tockify_scripts');

?>
