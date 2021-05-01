<?php

namespace NameSpaceBasePlugin;

/**
 * Controle geral do plugin
 */
class Desactivate
{

  /**
   * Inicia o desactivate.
   */
  public static function start()
  {
    Self::deleteBd();
  }

  /**
   * Undocumented function
   *
   * @param boolean $bool
   * @return boolean
   */
  public static function deleteBd(): bool
  {
    BdDelete::tabelas();
    return true;
  }
}
