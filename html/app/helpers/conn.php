<?php
/**
 * Classe conn, modelo singleton
 */
class conn 
{
    
    public static $instance;

    protected function __construct()
    { 
        //
    }

    protected function __clone() 
    { 
        //
    }

    public function __wakeup()
    {
        throw new \Exception("Não é possível desserializar um singleton.");
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            try 
            {
                self::$instance = new PDO("mysql:host=".getenv('HOST').";dbname=".getenv('DATABASE'), getenv('USER'), getenv('PASS'));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$instance;
            } 
            catch(PDOException $e) 
            {
                return "Erro na conexão: " . $e->getMessage();
            }
        }
    }
}

?>