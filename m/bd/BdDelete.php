<?php

namespace NameSpaceBasePlugin;

/**
 * Controle geral do plugin
 */
class BdDelete extends Bd
{
  /**
   * Cria todas as tabelas de uma vez.
   *
   * @return Bool
   */
  public static function tabelas()
  {

    Self::login();
    Self::status();
    Self::users();
    Self::options();

    return true;
  }


  /**
   * Deleta tabela login
   *
   * @return void
   */
  private static function login()
  {
    $tabela_name = 'login';
    return Self::deleteTable($tabela_name);
  }


  /**
   * Deleta tabela status
   *
   * @return void
   */
  private static function status()
  {
    $tabela_name = 'status';
    return Self::deleteTable($tabela_name);
  }


  /**
   * Deleta tabela users
   *
   * @return void
   */
  private static function users()
  {
    $tabela_name = 'users';
    return Self::deleteTable($tabela_name);
  }


  /**
   * Deleta tabela options
   *
   * @return void
   */
  private static function options()
  {
    $tabela_name = 'options';
    return Self::deleteTable($tabela_name);
  }
}
