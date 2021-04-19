<?php


class ScriptsPublic
{
  public static function start()
  {
    // Registra estilo e script.
    // Acrescenta um css ajustado do betheme.
    // Acrescenta um css personalizado.
    // Acrescenta o fontawesome.
    add_action('wp_head', function()
    {
      if (is_single() || is_page()) {
        $output = '<link rel="stylesheet" href="' . Plugin::$url . 'm/assets/css/desv_css_betheme.css">';
        $output .= '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">';
        echo $output;
      }
    }, 99, 0);
  }
}
