<?php
namespace app\helpers;


class crud
{
    private $table;
    private $result;

    /**
     * Função de inserção de dados nas tabelas no banco de dados
     * 
     * @param string $table     Tabela a ser lida no Banco de dados
     * @param array $args       Array com campo e valor para inserção no banco dados
     *                          Ex.: $array = array('user' => 'Robledo', 'pass' = 1345);
     * @return mixed            
     */
    public function insert($table, array $args)
    {
        // Define a tabela
        $this->table = (string) $table;
        // Captura os campos
        $keys =  implode(', ', array_keys($args));
        // Captura os valores
        $values = ":" . implode(', :', array_keys($args));
        // Monta a query
        $query = "INSERT INTO $this->table ({$keys}) VALUES ({$values})";
        // Executa no bloco try, capturando a mensagem de exceção
        try {
            $this->result = conn::run($query, $args);
            if (isset($this->result->queryString) && $this->result->queryString == $query){
                $this->result = true;
            }
        } catch (Exception $e) {
            $this->result = array("Erro" => $e.getMessage());
        }
        return $this->result;
    }

    /**
     * Função de leitura das tabelas no banco de dados
     * 
     * @param string $table     Tabela a ser lida no Banco de dados
     * @param string $args      Argumentos do sql usados no select
     *                          Ex.: 'WHERE stats=:stats AND nvl=:nvl ORDER BY id ASC'
     * @param string $parse     Valores dos argumentos passados no parâmentro anterior.
     *                          Ex.: 'stats=0&nvl=1'
     * @param array $colunn     Se omitido retorna todas as colunas do banco de dados
     *                          ou podem ser passadas colunas específicas.
     *                          Ex.: $array = array('user', 'pass');
     * @return array            
     */
    public function read($table, $args, $parse = null, array $colunn = null)
    {
        // Define a tabela
        $this->table = (string) $table;
        // Caso seja passado campos específicos se não retorna todos
        if (!is_null($colunn)){
            $fields = implode(', ', $colunn);
        } else {
            $fields = '*';
        }
        // Quebra os parâmetros do prepare do PDO
        if (!empty($parse)):
            parse_str($parse, $param);
        else:
            $param = null;
        endif;

        // Monta a query
        $query = "SELECT {$fields} FROM {$this->table} {$args}";
        // Executa no bloco try, capturando a mensagem de exceção
        try 
        {
            $this->result = conn::run($query, $param)->fetchAll();            
        } catch (Exception $e) {
            $this->result = array("Erro" => $e.getMessage());
        }        
        return $this->result;
    }

    /**
     * Função de edição dos dados das tabelas no banco de dados
     * 
     * @param string $table     Tabela a ser lida no Banco de dados
     * @param array $args       Array com campo e valor para alteração no banco dados
     *                          Ex.: $array = array('user' => 'Robledo', 'pass' = 1345);
     * @param array $cond       Array com os campos de condicional no banco dados
     *                          Ex.: $array = array('user' => 'Robledo');
     * @return array            
     */
    public function update($table, array $args, array $cond)
    {
        // Define a tabela
        $this->table = (string) $table;
        // Monta os campos para alteração
        $values = '';
        foreach ($args as $key => $value) {
            $values .= ($values === '' ? $key . "=:" . $key : ", " .  $key . "=:" . $key);
        }
        // Monta os campos da condição WHERE
        if (sizeof($cond) > 1){
            $where = '';
            foreach ($cond as $key => $v) {
                $where .= ($where === '' ? $key . "=:" . $key : " AND " .  $key . "=:" . $key);
            }
        } else {
            $where = key($cond) . "=:" . key($cond);
        }
        // Merge nos array's
        $pdovalues = array_merge($args, $cond);
        // Monta a query
        $query = "UPDATE {$this->table} SET {$values} WHERE $where";
        // Executa no bloco try, capturando a mensagem de exceção
        try 
        {
            $this->result = conn::run($query, $pdovalues);
            if (isset($this->result->queryString) && $this->result->queryString == $query){
                $this->result = true;
            }
        } catch (Exception $e) {
            $this->result = array("Erro" => $e.getMessage());
        }        
        return $this->result;
    }

    /**
     * Função de edição dos dados das tabelas no banco de dados
     * 
     * @param string $table     Tabela a ser lida no Banco de dados
     * @param array $cond       Array com os campos de condicional no banco dados
     *                          Ex.: $array = array('id' => 1);
     * @return mixed            
     */
    public function delete($table, array $cond)
    {
        // Define a tabela
        $this->table = (string) $table;
        // Monta os campos da condição WHERE
        if (sizeof($cond) > 1){
            $where = '';
            foreach ($cond as $key => $v) {
                $where .= ($where === '' ? $key . "=:" . $key : " AND " .  $key . "=:" . $key);
            }
        } else {
            $where = key($cond) . "=:" . key($cond);
        }
        // Monta a query
        $query = "DELETE FROM {$this->table} WHERE $where";
        // Executa no bloco try, capturando a mensagem de exceção
        try 
        {
            $this->result = conn::run($query, $cond)->rowCount();
            if ($this->result > 0){
                $this->result = true;
            } else {
                $this->result = false;
            }
        } catch (Exception $e) {
            $this->result = array("Erro" => $e.getMessage());
        }        
        return $this->result;
    }
}

?>