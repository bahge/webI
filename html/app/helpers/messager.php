<?php
/**
 * Classe messager registra e mostra os erros quando ocorre o retorno falso de algo esperado
 */

class messager 
{
    public static $instance;
    private $number;
    private $title;
    private $file;
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
        if (!isset(self::$instance[$cls])) 
        {
            self::$instance[$cls] = new static();
        }

        return self::$instance[$cls];
    }

    public function setErrorFile($title, $number ,$file, $msg) 
    {
        $this->title = $title;
        $this->number = $number;
        $this->file = $file;
        $this->msg = $msg;
    }

    public function getFormatErrorMsg()
    {
        $error =    "<b>" . $this->title . "</b><br>". 
                    "Arquivo: " . $this->file . "<br>".
                    "Número do erro: " . $this->number .
                    "<br><b>Exceção de origem:</b><br>" . $this->msg;
        return $error;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
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