<?php
/**
 * Classe installer inicia o banco de dados de usuário
*/

class installer
{
    private $conn;
    private $result;

    public function install()
    {
        /* Cria uma nova conexão ao PDO pois está em exception */
        $db = new PDO("mysql:host=".getenv('HOST').";dbname=".getenv('DATABASE'), getenv('USER'), getenv('PASS'));

        $query = 'CREATE TABLE users (id int PRIMARY KEY AUTO_INCREMENT, user VARCHAR(100) NOT NULL, pass VARCHAR(40) NOT NULL, email VARCHAR(100) NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP, modified DATETIME ON UPDATE CURRENT_TIMESTAMP, nvl SMALLINT DEFAULT 1, stats SMALLINT DEFAULT 0)';

        $p_sql = $db->prepare($query);

        $this->result = $p_sql->execute();

        return $this->result;
    }

    public function createFirstUser(){

    }
}
?>