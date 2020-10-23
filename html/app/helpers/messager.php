<?php
/**
 * Classe messager registra e mostra os erros quando ocorre o retorno falso de algo esperado
 */

class messager 
{
    public static $instance;
    private $msg;

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
        $cls = static::class;
        if (!isset(self::$instances[$cls])) 
        {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    public function getMsg()
    {
        return $this->msg;
    }
    
}

?>