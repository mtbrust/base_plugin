<?php

/**
 * Classe responsável pelo menu em admin.
 */
class Menu
{
  // Variáveis de ponte.
  private static array $paramsSecurity;
  private static array $paramsTemplate;
  private static array $paramsTemplateObjs;
  private static array $paramsPage;
  private static string $submenu;
  private static string $icon;



  /**
   * Inicia a criação dos menus.
   *
   * @return void
   */
  public static function start()
  {
    // Icone dentro de m/assets/img/
    Self::$icon = 'page_desv.png';

    // Menu principal
    Self::mainMenu();

    // Submenus.
    Self::subMenu('Modelo');

  }



  /**
   * Cria submenus para o menu principal.
   *
   * @return void
   */
  public static function subMenu($submenu_nome, $paramsSecurity = null, $paramsTemplate = null, $paramsTemplateObjs = null, $paramsPage = null)
  {
    Self::$submenu = $submenu_nome;

    if ($paramsSecurity) {
      // Valores default de $paramsSecurity.
      Self::$paramsSecurity = array(
        'session'    => true,   // Página guarda sessão.
        'permission' => 0,      // Nível de acesso a página. 0 a 100.
      );
    }

    if ($paramsTemplate) {
      // Valores default de $paramsTemplate a partir da pasta template.
      Self::$paramsTemplate = array(
        'html'        => 'default',   // Template HTML
        'top'         => 'default',   // Topo da página.
        'header'      => 'default',   // Menu da página.
        'footer'      => 'default',   // footer da página.
        'bottom'      => 'default',   // Fim da página.
      );
    }

    if ($paramsTemplateObjs) {
      // Objetos para serem inseridos dentro de partes do template.
      // O Processamento realiza a montagem. Algum template tem que conter um bloco para Obj ser incluido.
      Self::$paramsTemplateObjs = array(
        'objeto_apelido'          => 'pasta/arquivo.php',   // Carrega HTML do objeto e coloca no lugar indicado do corpo ou template.
      );
    }

    if ($paramsPage) {
      // Valores para serem inseridos no corpo da página.
      // Exemplo: 'p_nome' => 'Mateus',
      // Exemplo uso view: <p><b>Nome: </b> {{p_nome}}</p>
      Self::$paramsPage = array(
        'nome'              => 'Mateus',            // Exemplo
      );
    }



    // Cria o submenu.
    add_action('admin_menu', function () {
      $submenu = Self::$submenu;
      Self::$submenu = str_replace(' ', '_', strtolower(Self::$submenu));
      add_submenu_page(
        Plugin::$plugin_slug,
        $submenu,
        $submenu,
        'manage_options',
        Plugin::$plugin_slug.'_'.Self::$submenu,
        function () {
          Render::html(Self::$paramsSecurity, Self::$paramsTemplate, Self::$paramsTemplateObjs, Self::$paramsPage, Self::$submenu);
        }
      );
    });
  }



  /**
   * Cria o menu main do plugin.
   *
   * @return void
   */
  public static function mainMenu()
  {

    // Valores default de $paramsSecurity.
    Self::$paramsSecurity = array(
      'session'    => true,   // Página guarda sessão.
      'permission' => 0,      // Nível de acesso a página. 0 a 100.
    );

    // Valores default de $paramsTemplate a partir da pasta template.
    Self::$paramsTemplate = array(
      'html'        => 'default',   // Template HTML
      'top'         => 'default',   // Topo da página.
      'header'      => 'default',   // Menu da página.
      'footer'      => 'default',   // footer da página.
      'bottom'      => 'default',   // Fim da página.
    );

    // Objetos para serem inseridos dentro de partes do template.
    // O Processamento realiza a montagem. Algum template tem que conter um bloco para Obj ser incluido.
    Self::$paramsTemplateObjs = array(
      'objeto_apelido'          => 'pasta/arquivo.php',   // Carrega HTML do objeto e coloca no lugar indicado do corpo ou template.
    );

    // Valores para serem inseridos no corpo da página.
    // Exemplo: 'p_nome' => 'Mateus',
    // Exemplo uso view: <p><b>Nome: </b> {{p_nome}}</p>
    Self::$paramsPage = array(
      'nome'              => 'Mateus',            // Exemplo
    );


    add_action('admin_menu', function () {
      // Criação do menu.
      add_menu_page(
        Plugin::$plugin_name,
        Plugin::$plugin_name,
        'manage_options',
        Plugin::$plugin_slug,
        function () {

          Render::html(Self::$paramsSecurity, Self::$paramsTemplate, Self::$paramsTemplateObjs, Self::$paramsPage, 'main');
          // require_once Plugin::$path . 'v/templates/cabecalho.php';
          // require_once Plugin::$path . 'v/pages/view-membros.php';
          // require_once Plugin::$path . 'v/templates/rodape.php';
        },
        Plugin::$url . 'm/assets/img/' . Self::$icon,
        5
      );
    });
  }
}
