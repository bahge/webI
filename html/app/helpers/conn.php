<?php
/**
 * Classe conn, modelo singleton
 */
class conn 
{
    
    protected static $instance = null;

    protected function __construct() {}
    protected function __clone() {}

    public function __wakeup()
    {
        throw new \Exception("Não é possível desserializar um singleton.");
    }

    public static function getInstance()
    {
        if (self::$instance === null)
        {
            $options = array (
                PDO::ATTR_ERRMODE               =>  PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE    =>  PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES      =>  FALSE
            );

            $strconn = 'mysql:host='.getenv('HOST').';dbname='.getenv('DATABASE').';charset=utf8';
            self::$instance = new PDO($strconn, getenv('USER'), getenv('PASS'), $options);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::getInstance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        if (!$args)
        {
             return self::getInstance()->query($sql);
        }
        try 
        {
            $stmt = self::getInstance()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        } 
        catch (Exception $e) 
        {
            return "Erro:<br>" . $e->getMessage();
        }
        
    }
}

?>