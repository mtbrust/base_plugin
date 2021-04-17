<?php

/**
 * Controle geral do plugin
 */
class BdCreate extends Bd
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
   * Cria tabela login
   *
   * @return void
   */
  private static function login()
  {
    $table_name = 'login';
    $fields = [
      "id INT NOT NULL AUTO_INCREMENT primary key",
      "matricula     INT NOT NULL",
      "full_name     VARCHAR(160) NULL",
      "first_name    VARCHAR(40) NULL",
      "last_name     VARCHAR(40) NULL",
      "email         VARCHAR(160) NOT NULL",
      "user_name     VARCHAR(32) NOT NULL",
      "senha         VARCHAR(32) NOT NULL",
      "cpf           VARCHAR(11) NULL",
      "telefone      INT(11) NULL",
      "active        BOOLEAN NULL",
      "id_status     INT NULL",
      "obs           VARCHAR(255) NULL",
      "dt_create     DATETIME NULL",
    ];
    return Self::createTable($table_name, $fields);
  }


  /**
   * Cria tabela status
   *
   * @return void
   */
  private static function status()
  {
    $table_name = 'status';
    $fields = [
      "id INT NOT NULL AUTO_INCREMENT primary key",
      "nome VARCHAR(45) NULL",
      "help VARCHAR(128) NULL",
      "descricao VARCHAR(255) NULL",
      "tabela VARCHAR(90) NULL",
    ];
    return Self::createTable($table_name, $fields);
  }


  /**
   * Cria tabela users
   *
   * @return void
   */
  private static function users()
  {
    $table_name = 'users';
    $fields = [

      // Controle
      "id INT NOT NULL AUTO_INCREMENT primary key",
      "idStatus INT NULL",
      "idStatusGrupo INT NULL",
      "obsGeral VARCHAR(512) NULL",

      // Pessoal
      "nome VARCHAR(128) NULL",
      "dataNascimento DATE NULL",
      "sexo VARCHAR(1) NULL",
      "estadoCivil VARCHAR(11) NULL",
      "nomeConjuge VARCHAR(128) NULL",
      "idConjuge INT NULL",
      "naturalidade VARCHAR(45) NULL",
      "naturalidade_uf VARCHAR(3) NULL",
      "nacionalidade VARCHAR(45) NULL",
      "urlFoto VARCHAR(255) NULL",
      "idFoto INT NULL",

      // Profissional
      "escolaridade VARCHAR(45) NULL",

      // Endereço
      "cep VARCHAR(9) NULL",
      "endereco VARCHAR(45) NULL",
      "numero VARCHAR(45) NULL",
      "complemento VARCHAR(45) NULL",
      "bairro VARCHAR(45) NULL",
      "cidade VARCHAR(45) NULL",
      "estadoUf VARCHAR(3) NULL",
      "pais VARCHAR(45) NULL",

      // Contato
      "telefone1 VARCHAR(11) NULL",
      "whatsapp1 BOOLEAN NULL",
      "telefone2 VARCHAR(11) NULL",
      "whatsapp2 BOOLEAN NULL",
      "emailProfissional VARCHAR(128) NULL",
      "emailPessoal VARCHAR(128) NULL",

      // Documentos
      "rg VARCHAR(13) NULL",
      "dataEmissao DATE NULL",
      "emissor VARCHAR(5) NULL",
      "cpf VARCHAR(11) NULL",
      "categoriaCnh VARCHAR(3) NULL",

      // Familiar
      "nomePai VARCHAR(128) NULL",
      "nomeMae VARCHAR(128) NULL",
      "idPai INT NULL",
      "idMae INT NULL",

      // Redes
      "instagram VARCHAR(45) NULL",
      "facebook VARCHAR(45) NULL",
      "linkedin VARCHAR(45) NULL",
      "twitter VARCHAR(45) NULL",
      "lattes VARCHAR(45) NULL",
    ];
    return Self::createTable($table_name, $fields);
  }

  /**
   * Cria tabela options
   *
   * @return void
   */
  private static function options()
  {

    $table_name = 'options';
    $fields = [
      "id INT NOT NULL AUTO_INCREMENT primary key",
      "option VARCHAR(45) NULL",
      "value VARCHAR(512) NULL",
    ];
    return Self::createTable($table_name, $fields);
  }
}
