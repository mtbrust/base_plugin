<?php

namespace NameSpaceBasePlugin;

/**
 * Classe responsável pelo menu em admin.
 */
class Menu
{
  // Variáveis de ponte.
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

    // Cria Menu principal
    Self::mainMenu();

    // Cria Submenu Modelo. (v/menus/modelo_pagina.html).
    Self::subMenu('Modelo Página');

    // Cria Submenu Name Menu. v/menus/name_menu.html
    Self::subMenu('Name Menu');
  }



  /**
   * Cria submenus para o menu principal.
   *
   * @return void
   */
  public static function subMenu($nomeSubmenu, $paramsSecurity = null, $paramsTemplate = null, $paramsPage = null)
  {
    // Guarda o nome em variável statica.
    $submenuSlug = str_replace(' ', '_', strtolower(Self::tirarAcentos($nomeSubmenu)));


    // Não foi implementado ainda.
    if (!$paramsSecurity) {
      // Valores default de $paramsSecurity.
      $paramsSecurity = array(
        'session'    => true,   // Página guarda sessão.
        'permission' => 0,      // Nível de acesso a página. 0 a 100.
      );
    }

    if (!$paramsTemplate) {
      // Valores default de $paramsTemplate a partir da pasta template.
      $paramsTemplate = array(
        'html'        => 'default',   // Template HTML
        'top'         => 'default',   // Topo da página.
        'header'      => 'default',   // Menu da página.
        'footer'      => 'default',   // footer da página.
        'bottom'      => 'default',   // Fim da página.
      );
    }

    if (!$paramsPage) {
      // Valores para serem inseridos no corpo da página.
      // Exemplo: 'p_nome' => 'Mateus',
      // Exemplo uso view: <p><b>Nome: </b> {{p_nome}}</p>
      $paramsPage = array(
        'nome'              => 'Mateus',            // Exemplo
      );
    }

    // Adiciona o menu.
    add_action('admin_menu', function () use ($nomeSubmenu, $submenuSlug, $paramsSecurity, $paramsTemplate, $paramsPage) {
      add_submenu_page(
        Plugin::$plugin_slug,
        $nomeSubmenu,
        $nomeSubmenu,
        'manage_options',
        Plugin::$plugin_slug . '_' . $submenuSlug,
        function () use ($paramsSecurity, $submenuSlug, $paramsTemplate, $paramsPage) {
          echo Render::html($paramsSecurity, $paramsTemplate, $paramsPage, 'menus/' . $submenuSlug);
        }
      );
    });
  }



  /**
   * Cria o menu main do plugin.
   *
   * @return void
   */
  public static function mainMenu($paramsSecurity = null, $paramsTemplate = null, $paramsPage = null)
  {

    // Não foi implementado ainda.
    if (!$paramsSecurity) {
      // Valores default de $paramsSecurity.
      $paramsSecurity = array(
        'session'    => true,   // Página guarda sessão.
        'permission' => 0,      // Nível de acesso a página. 0 a 100.
      );
    }

    if (!$paramsTemplate) {
      // Valores default de $paramsTemplate a partir da pasta template.
      $paramsTemplate = array(
        'html'        => 'default',   // Template HTML
        'top'         => 'default',   // Topo da página.
        'header'      => 'default',   // Menu da página.
        'footer'      => 'default',   // footer da página.
        'bottom'      => 'default',   // Fim da página.
      );
    }

    if (!$paramsPage) {
      // Valores para serem inseridos no corpo da página.
      // Exemplo: 'p_nome' => 'Mateus',
      // Exemplo uso view: <p><b>Nome: </b> {{p_nome}}</p>
      $paramsPage = array(
        'nome'              => 'Mateus',            // Exemplo
      );
    }


    add_action('admin_menu', function () use ($paramsSecurity, $paramsTemplate, $paramsPage) {
      // Criação do menu.
      add_menu_page(
        Plugin::$plugin_name,
        Plugin::$plugin_name,
        'manage_options',
        Plugin::$plugin_slug,
        function () use ($paramsSecurity, $paramsTemplate, $paramsPage) {
          echo Render::html($paramsSecurity, $paramsTemplate, $paramsPage, 'menus/main');
        },
        Plugin::$url . 'm/assets/img/' . Self::$icon,
        5
      );
    });
  }


  // Retira acentos
  private static function tirarAcentos($string)
  {
    return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
  }

}
