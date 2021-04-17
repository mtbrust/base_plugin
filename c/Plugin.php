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
    Self::$prefix_name = str_replace(' ', '_', strtolower($plugin_name)). '_';
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

    // Models
    require_once Self::$path . 'm/bd/Bd.php';
    require_once Self::$path . 'm/bd/bdCreate.php';
    require_once Self::$path . 'm/bd/bdDelete.php';
  }


}
