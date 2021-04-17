<?php

/*
Plugin Name: BASE PLUGIN
Plugin URI:  https://www.desv.com.br/
Description: Base para criação de plugins.
Version:     1.0
Author:      DESV
Author URI:  https://www.desv.com.br/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


/**
 * Segurança - Sai quando acessado diretamento pelo navegador
 */
defined('ABSPATH') || exit;


/**
 * Definição das constantes.
 */
$desv_plugin_name = 'base_plugin';                // Nome do plugin.
$desv_bd_charset  = 'utf8';                      // Charset
$desv_file        = __FILE__;                     // Plugin.
$desv_path        = plugin_dir_path($desv_file);  // Caminho da pasta.
$desv_url         = plugin_dir_url($desv_file);   // Caminho da URL.

global $wpdb;

/**
 * Carrega o motor do plugin.
 */
require_once $desv_path . 'c/Plugin.php';
$plugin = new Plugin($desv_plugin_name, $desv_bd_charset, $desv_file, $desv_path, $desv_url);
$plugin->start();


register_activation_hook(__FILE__, array('Activate', 'start'));
register_deactivation_hook( __FILE__, array( 'Desactivate', 'start' ) );









/**
 * OLD - APAGADR DEPOIS
 */
// CONTROLE DO PLUGIN
// require_once DESV_CP_PATH . 'c/plugin/plugin.php';
// CONTROLE DO ADMIN
// require_once DESV_CP_PATH . 'c/admin/admin.php';
// CONTROLE DO PUBLIC
// require_once DESV_CP_PATH . 'c/public/public.php';
// CONTROLE DO SHORTCODE
// require_once DESV_CP_PATH . 'c/shortcode/shortcode.php';
// CONTROLE DA API
// require_once DESV_CP_PATH . 'c/api/api.php';