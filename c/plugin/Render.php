<?php

/**
 * Classe responsável por juntar os blocos de template colocar os parâmetros e renderizar.
 */
class Render
{
  /**
   * Renderiza a parte gráfica (html) do site.
   * Recebe os arquivos modelos HTML e o seu conteúdo.
   * Recebe parâmetros de variáveis para serem usados dentros dos modelos.
   *
   * @param array $paramsSecurity
   * @param array $paramsTemplate
   * @param array $paramsTemplateObjs
   * @param array $paramsPage
   * @return void
   */
  public static function html($paramsSecurity, $paramsTemplate, $paramsTemplateObjs, $paramsPage, $pageName = null)
  {

    // Carrega os arquivos no parâmetro.
    $paramsTemplateTmp = array();
    foreach ($paramsTemplate as $key => $value) {
      $file = Plugin::$path . 'v/templates/' . $key . '/' . $value . '.html';
      $paramsTemplateTmp[$key] = file_get_contents($file);
    }

    // Carrega o menu.
    if ($pageName) {
      $path_view = Plugin::$path . 'v/menus/' . $pageName . '.html';
      if (file_exists($path_view))
        $paramsTemplateTmp['corpo'] = file_get_contents($path_view);
      else
        echo 'Não existe o arquivo de menu: ' . $pageName . '.html';
    }

    // Arquivos físicos.
    $vurlf = new \Twig\Loader\ArrayLoader(
      $paramsTemplateTmp
    );

    // Monta quais são as partes pastas que se usa modelo no template.
    $base = '';
    foreach (array_keys($paramsTemplateTmp) as $key => $value) {
      if (!$key == 0)
        $base .= '{% use "' . $value . '" %}';
    }

    // Base html. Aqui controla quais arquivos o TWIG irá renderizar.
    $html_base = new \Twig\Loader\ArrayLoader([
      'base' => '{% extends "html" %}' . $base
    ]);

    // Sequência de prioridade. Arquivos físicos depois Virtuais.
    $loader = new \Twig\Loader\ChainLoader([$vurlf, $html_base]);
    $twig   = new \Twig\Environment($loader);

    // Após carregar os templates HTML, e passar os parmâmetros, desenha página na tela.
    echo $twig->render('base', array_merge($paramsPage));
  }
}
