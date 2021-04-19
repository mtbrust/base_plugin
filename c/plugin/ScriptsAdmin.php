<?php


class ScriptsAdmin
{
  public static function start()
  {
    // Registra estilo e script.

    add_action('admin_enqueue_scripts', function () {
      $current_screen = get_current_screen();
      if (strpos($current_screen->base, Plugin::$plugin_slug) === false) {
        return;
      } else {

        wp_enqueue_style(Plugin::$plugin_slug . '_bootstrap_min_css', Plugin::$url . 'm/assets/css/bootstrap.min.css', false, false, false);
        wp_enqueue_script(Plugin::$plugin_slug . '_bootstrap_min_js', Plugin::$url . 'm/assets/js/bootstrap.min.js', ['jquery'], false, false);
        // wp_enqueue_script(Plugin::$plugin_slug . '_jquery_mask_js', Plugin::$url . 'm/assets/js/jquery.mask.js', false, false, false);

        //wp_enqueue_script('fontawesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css', false, false, true);
        echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">';
      }
    });
  }
}
