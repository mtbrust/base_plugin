<?php


namespace NameSpaceBasePlugin;

/**
 * Classe pai para as conexões com o banco de dados.
 */
class Bd
{


  /**
   * Executa função padrão de retornar 10 linhas da tabela selecionada.
   *
   * @param string $table
   * @param string $limit
   * @return void
   */
  public static function getAll($table, $limit = "9 OFFSET 0")
  {

    $result = $GLOBALS['wpdb']->get_results("SELECT * FROM $table WHERE 1 LIMIT $limit", PDO::FETCH_ASSOC);

    return $result->fetchAll();
  }



  /**
   * Retorna todas as tabelas ou a solicitada.
   * [$tableName] já acrescenta o prefixo. Basta colocar o nome final da tabela.
   *
   * @param string $tableName
   * @return void
   */
  public static function getTables($tableName = '')
  {
    
    // Caso passe o nome da tabela, cria o wherer para filtrar.
    if ($tableName)
      $tableName =  "WHERE Tables_in_" . DB_NAME . " LIKE '" . Plugin::$prefix_name . "$tableName'";

    // Monta a Sql com filtro ou sem nada.
    $sql = "SHOW TABLES $tableName";
    // Executa a query e retorna um PDO Object.

    
    $r = $GLOBALS['wpdb']->get_results($sql);

    // Executa query de criação.
    if (!$r) {
      //// die(print_r($GLOBALS['wpdb']->last_error(), true));
      return false;
    }

    // Caso ocorra tudo corretamente.
    return $r;
  }



  /**
   * Função genérica para criação de tabelas conforme os parâmetros passados.
   * Preencha o nome da tabela.
   * Preencha o array com "nome_campo tipo_campo" (sem chave, apenas valores).
   *
   * @param string $tableName
   * @param array $fields
   * @return bool
   */
  public static function createTable($tableName, $fields)
  {

    // Verifica se tabela existe.
    if (Self::getTables($tableName))
      return true;

    // Constroi SQL.
    $sql = "CREATE TABLE IF NOT EXISTS " . Plugin::$prefix_name . "$tableName (";
    $sql .= implode(',', $fields);
    $sql .= ") engine=InnoDB default charset " . Plugin::$charset . ";";

    // Executa query de criação.
    if (!$GLOBALS['wpdb']->get_results($sql)) {
      // die(print_r($GLOBALS['wpdb']->last_error(), true));
      return false;
    }
	  $GLOBALS['wpdb']->get_results("ALTER TABLE $tableName CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;");

    

    return true;
  }



  /**
   * Função genérica para deletar tabela.
   *
   * @param string $tableName
   * @return bool
   */
  public static function deleteTable($tableName)
  {
    

    // Verifica se tabela existe.
    if (!Self::getTables($tableName))
      return true;

    // Constroi sql.
    $sql = "DROP TABLE IF EXISTS " . Plugin::$prefix_name . "$tableName";

    // Executa query de criação.
    if (!$GLOBALS['wpdb']->get_results($sql)) {
      // die(print_r($GLOBALS['wpdb']->last_error(), true));
      return false;
    }

    // Caso ocorra tudo corretamente.
    return true;
  }



  /**
   * Função genérica para inserts.
   * Preencha o nome da tabela.
   * Preencha o array com nome_campo => valor_campo.
   *
   * @param string $tableName
   * @param array $fields
   * @return bool
   */
  public static function inserir($tableName, $fields)
  {

    // Verifica se tabela existe.
    if (!Self::getTables($tableName))
      return false;

    // Obtém as chaves (nome dos campos).
    $cols = implode(', ', array_keys($fields));
    // Obtém as chaves como parâmetro (incluido em values), para depois trocar pelos valores.
    $params = implode(', :', array_keys($fields));

    // Constrói sql.
    $sql = "INSERT INTO " . Plugin::$prefix_name . "$tableName ($cols) VALUES(:$params)";
    $sth = $GLOBALS['wpdb']->prepare($sql);

    // Percorre os valores e adiciona ao bind.
    foreach ($fields as $key => $value) {
      $sth->bindValue(":$key", $value);
    }

    // Executa query de criação.
    if (!$sth->execute()) {
      // die(print_r($GLOBALS['wpdb']->last_error(), true));
      return false;
    }

    // Caso ocorra tudo corretamente.
    return true;
  }


  /**
   * Função genérica para update.
   * Preencha o nome da tabela.
   * Preencha o array com nome_campo => valor_campo.
   *
   * @param string $tableName
   * @param array $fields
   * @return bool
   */
  public static function atualizar($tableName, $id, $fields)
  {

    // Verifica se tabela existe.
    if (!Self::getTables($tableName))
      return false;

    // Prepara o SET (key, values)
    $set = '';
    // Percorre os valores e adiciona ao bind.
    foreach ($fields as $key => $value) {
      $set .= ",$key=:$key";
    }
    $set[0] = ' '; // Tia a virgual inicial.

    // Constrói sql.
    $sql = "UPDATE " . Plugin::$prefix_name . "$tableName SET$set  WHERE id = $id";
    $sth = $GLOBALS['wpdb']->prepare($sql);

    // Percorre os valores e adiciona ao bind.
    foreach ($fields as $key => $value) {
      $sth->bindValue(":$key", $value);
    }

    // Executa query de criação.
    if (!$sth->execute()) {
      // die(print_r($GLOBALS['wpdb']->last_error(), true));
      return false;
    }

    // Caso ocorra tudo corretamente.
    return true;
  }



  /**
   * Função selectById que busca registro por id.
   * Retorna um array da linha.
   *
   * @param string $tableName
   * @param int $id
   * @return array
   */
  public static function selectById($tableName, $id)
  {

    // Verifica se tabela existe.
    if (!Self::getTables($tableName))
      return false;

    // Constrói sql.
    $sql = "SELECT * FROM " . Plugin::$prefix_name . "$tableName WHERE id = $id";
    $sth = $GLOBALS['wpdb']->prepare($sql);

    // Executa query de criação.
    if (!$sth->execute()) {
      // die(print_r($GLOBALS['wpdb']->last_error(), true));
      return false;
    }

    // Caso ocorra tudo corretamente.
    return $sth->fetchAll(PDO::FETCH_ASSOC)[0];
  }




  /**
   * Função delete passando id e iniciando a conexão.
   * Deleta registro pela tabela e id informado.
   *
   * @param string $tableName
   * @param int $id
   * @return bool
   */
  public static function deletar($tableName, $id)
  {

    // Verifica se tabela existe.
    if (!Self::getTables($tableName))
      return false;

    // Constrói sql.
    $sql = "DELETE FROM " . Plugin::$prefix_name . "$tableName WHERE id = $id";
    $sth = $GLOBALS['wpdb']->prepare($sql);

    // Executa query de criação.
    if (!$sth->execute()) {
      // die(print_r($GLOBALS['wpdb']->last_error(), true));
      return false;
    }

    // Caso ocorra tudo corretamente.
    return true;
  }




  public static function selectIdWhereAnd($tableName, $where)
  {

    // Verifica se tabela existe.
    if (!Self::getTables($tableName))
      return false;

    $select_where = '';
    // Percorre os valores e adiciona ao bind.
    foreach ($where as $key => $value) {
      $select_where .= "$key = :$key and ";
    }
    $select_where .= '1';

    // Constrói sql.
    $sql = "SELECT id FROM " . Plugin::$prefix_name . "$tableName WHERE $select_where";
    $sth = $GLOBALS['wpdb']->prepare($sql);

    // Percorre os valores e adiciona ao bind.
    foreach ($where as $key => $value) {
      $sth->bindValue(":$key", $value);
    }

    // Executa query de criação.
    if (!$sth->execute()) {
      // die(print_r($GLOBALS['wpdb']->last_error(), true));
      return false;
    }

    // Caso ocorra tudo corretamente.
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }


  /**
   * Função genérica para selecionar por id.
   * Retorna um vetor da linha selecionada.
   *
   * @param string $tableName
   * @param int $id
   * @return array
   */
  protected static function selectAll($tableName, $posicao = null, $qtd = 10)
  {

    // Verifica se tabela existe.
    if (!Self::getTables($tableName))
      return false;

    $limit = '';
    if ($posicao)
      $limit = "LIMIT $qtd, $posicao";

    // Constrói sql.
    $sql = "SELECT * FROM " . Plugin::$prefix_name . "$tableName $limit";
    $sth = $GLOBALS['wpdb']->prepare($sql);


    // Executa query de criação.
    if (!$sth->execute()) {
      // die(print_r($GLOBALS['wpdb']->last_error(), true));
      return false;
    }

    // Caso ocorra tudo corretamente.
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }


  /**
   * Função genérica para retornar a quantidade de registros da tabela.
   * Retorna um vetor da linha selecionada.
   *
   * @param string $tableName
   * @return int
   */
  protected static function count($tableName)
  {

    // Verifica se tabela existe.
    if (!Self::getTables($tableName))
      return false;

    // Constrói sql.
    $sql = "SELECT count(*) as qtd FROM " . Plugin::$prefix_name . "$tableName";
    $sth = $GLOBALS['wpdb']->prepare($sql);

    // Executa query de criação.
    if (!$sth->execute()) {
      // die(print_r($GLOBALS['wpdb']->last_error(), true));
      return false;
    }

    // Caso ocorra tudo corretamente.
    return $sth->fetchAll(PDO::FETCH_ASSOC)[0]['qtd'];
  }
}
