<?php

/**
 * Controle geral do plugin
 */
class Plugin
{
  /**
   * Nome do plugin
   */
  public static string $plugin_name;

  /**
   * Nome da api
   */
  public static string $plugin_slug;

  /**
   * Prefixo da tabela
   */
  public static string $prefix_name;

  /**
   * Charset da tabela
   */
  public static string $charset;


  /**
   * Caminhos do plugin.
   */
  public static string $file;
  public static string $path;
  public static string $url;


  /**
   * Construtor do aplicativo.
   */
  public function __construct($plugin_name, $charset, $file, $path, $url)
  {
    // Define constantes do plugin.
    Self::$plugin_name = $plugin_name;
    Self::$plugin_slug  = str_replace(' ', '_', strtolower($plugin_name));
    Self::$prefix_name = Self::$plugin_slug . '_';
    Self::$charset     = $charset;

    // Define os caminhos do plugin.
    Self::$file = $file;
    Self::$path = str_replace('\\', '/', $path);
    Self::$url  = $url;
    
  }

  /**
   * Função para iniciar o plugin.
   *
   * @return void
   */
  public function start()
  {
    // Carrega as dependências do plugin.
    $this->dependences();

    // Inicia os Menus.
    Menu::start();

    // Inicia os ShortCodes.
    ShortCode::start();

    // Inicia as APIs.
    Api::start();

  }

  /**
   * Carrega todas as dependências do plugin.
   *
   * @return void
   */
  private function dependences()
  {
    // Vendor
    require_once Self::$path . 'vendor/autoload.php';

    // Controllers
    require_once Self::$path . 'c/plugin/Activate.php';
    require_once Self::$path . 'c/plugin/Desactivate.php';
    require_once Self::$path . 'c/menus/Menu.php';
    require_once Self::$path . 'c/shortcodes/ShortCode.php';
    require_once Self::$path . 'c/apis/Api.php';
    require_once Self::$path . 'c/Render.php';
    
    // Models
    require_once Self::$path . 'm/bd/Bd.php';
    require_once Self::$path . 'm/bd/bdCreate.php';
    require_once Self::$path . 'm/bd/bdDelete.php';
  }


}
