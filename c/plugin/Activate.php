<?php

/**
 * Controle geral do plugin
 */
class Activate
{

  /**
   * Inicia o activate.
   */
  public static function start()
  {
    Self::createBd();
  }

  /**
   * Undocumented function
   *
   * @param boolean $bool
   * @return boolean
   */
  public static function createBd(): bool
  {
    BdCreate::tabelas();
    return true;
  }
}
