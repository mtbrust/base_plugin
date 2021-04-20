<h1>Plugin Modelo da Base Plugin</h1>
<p>[base_plugin_modelo]</p>

<?php



/**
 * É possível usar o render para desenhar os objetos na tela.
 */

// Valores default de $paramsSecurity.
$paramsSecurity = array(
  'session'    => true,   // Página guarda sessão.
  'permission' => 0,      // Nível de acesso a página. 0 a 100.
);

// Valores default de $paramsTemplate a partir da pasta template.
$paramsTemplate = array(
  'html'        => 'default',   // Template HTML
  'top'         => 'default',   // Topo da página.
  'header'      => 'default',   // Menu da página.
  'footer'      => 'default',   // footer da página.
  'bottom'      => 'default',   // Fim da página.
);

// Objetos para serem inseridos dentro de partes do template.
// O Processamento realiza a montagem. Algum template tem que conter um bloco para Obj ser incluido.
$paramsTemplateObjs = array(
  'quadrado'          => 'quadrado',   // Carrega HTML do objeto e coloca no lugar indicado do corpo ou template.
);

// Valores para serem inseridos no corpo da página.
// Exemplo: 'p_nome' => 'Mateus',
// Exemplo uso view: <p><b>Nome: </b> {{p_nome}}</p>
$paramsPage = array(
  'nome'        => 'Mateus',                        // Exemplo
  'plugin_slug' => '['.Plugin::$plugin_slug.'_modelo]',   // Nome Slug do Plugin.
);

echo Render::html($paramsSecurity, $paramsTemplate, $paramsTemplateObjs, $paramsPage, 'shortcodes/modelo');


echo '<hr>';

echo Render::obj('quadrado', ['nome' => 'Mateus']);

echo '<hr>';