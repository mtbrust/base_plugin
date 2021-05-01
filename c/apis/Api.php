<?php

namespace NameSpaceBasePlugin;


/**
 * Controle da Api
 */
class Api
{

  /**
   * Carrega as apis criadas na pasta.
   * Criar arquivos com letra minúscula.
   *
   * @param array $apis
   * @return void
   */
  public static function start()
  {
    // Cria a rota com o nome da api (Definida no Plugin.php).
    // Exemplo de uso: http://seusite.com.br/wp-json/plugin_slug/apimodelo
    add_action('rest_api_init', function () {
      register_rest_route(Plugin::$plugin_slug, '/(?P<url>\b[A-Z0-9._%+-]+)', array(
        'methods' => 'GET',
        'callback' => function ($data) {
          $file = Plugin::$path . 'c/apis/' . $data['url'] . '.php';
          if (file_exists($file))
            require_once $file;
          else
            return "Api " . $data['url'] . '.php' . " inexistente. Verifique a rota.";
        },
      ), true);
    });
  }
}
