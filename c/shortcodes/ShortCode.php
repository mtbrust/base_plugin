<?php


class ShortCode
{

  // Variáveis para fazer a ponte.
  private static string $nome;


  public static function start()
  {

    // Cria um modelo de shortcode.
    Self::novo('modelo');
  }


  /**
   * Cria um shortcode.
   * Resultado: [plugin_slug_nome] (plugin_slug definido no plugin.php)
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
}
