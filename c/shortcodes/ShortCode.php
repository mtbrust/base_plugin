<?php

namespace NameSpaceBasePlugin;


class ShortCode
{

  // Variáveis para fazer a ponte.
  private static string $nome;


  /**
   * Inicia e carrega os shortcodes que estarão em uso.
   *
   * @return void
   */
  public static function start()
  {
    // Carrega scrips e estilos.
    Self::scripts();

    // Cria um modelo de shortcode.
    Self::novo('modelo');
  }


  /**
   * Cria um shortcode.
   * Resultado: [plugin_slug_nome] (plugin_slug definido no plugin.php e o nome é definido no start.)
   *
   * @param string $nome
   * @return void
   */
  public static function novo($nome)
  {
    Self::$nome = $nome;
    add_shortcode(Plugin::$plugin_slug . '_' . $nome, function () {
      $file = Plugin::$path . 'c/shortcodes/' . Self::$nome . '.php';
      if (file_exists($file))
        require_once $file;
      else
        return "Shortcode " . Self::$nome . '.php' . " inexistente.";
    });
  }


  
  /**
   * Carregamento de scripts e estilos.
   *
   * @return void
   */
  public static function scripts()
  {
    // CSS
    wp_enqueue_style(Plugin::$plugin_slug . '_grid_css', Plugin::$url . 'm/assets/css/bootstrap-grid.min.css', false, false, false);
    wp_enqueue_style(Plugin::$plugin_slug . '_forms_css', Plugin::$url . 'm/assets/css/bootstrap-forms.min.css', false, false, false);
    wp_enqueue_style(Plugin::$plugin_slug . '_responsive_css', Plugin::$url . 'm/assets/css/bootstrap-responsive.min.css', false, false, false);
    wp_enqueue_style(Plugin::$plugin_slug . '_desv_css', Plugin::$url . 'm/assets/css/desv_css.css', false, false, false);
    
    // JS
    wp_enqueue_script(Plugin::$plugin_slug . '_bootstrap_js', Plugin::$url . 'm/assets/js/bootstrap.min.js', ['jquery']);
    wp_enqueue_script(Plugin::$plugin_slug . '_jquery_mask_js', Plugin::$url . 'm/assets/js/jquery.mask.js', ['jquery'], false, false);
    wp_enqueue_script(Plugin::$plugin_slug . '_jquery.redirec', Plugin::$url . 'm/assets/js/jquery.redirect.js', ['jquery'], false, false);
    wp_enqueue_script(Plugin::$plugin_slug . '_desv_js', Plugin::$url . 'm/assets/js/desv_js.js', false, false, false);
    // wp_enqueue_script('loader', 'https://www.gstatic.com/assets/charts/loader.js', false, false, true);

    // Externo
    // echo '<script src="https://www.gstatic.com/assets/charts/loader.js"></script>';
  }
}
