<?php
/**
 * Classe config, modelo singleton
 */
class config 
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

    /**
     * Função que verifica se a instancia de config existe e a retorna, caso contrário instancia e a retorna
     * 
     * @return object            
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $cls = static::class;
            if (!isset(self::$instance[$cls])) 
            {
                self::$instance[$cls] = new static();
            }

            return self::$instance[$cls];
        }
    }

    /**
     * Função para leitura do arquivo env
     * 
     * @return void            
     */
    public function loadFileEnv()
    {
        try {
            $path = ABS_PATH . '/.env';
            if (!file_exists($path)){
                throw new Exception("O arquivo não foi encontrado", 1);
            } else {
                self::loadFileEnvGetVars();
            }
        } catch (Exception $e) {
            echo "<br>Erro ao carregar as variáveis de ambiente:<br>" . $e->getMessage();
        }
        
    }

    /**
     * Função que carrega as variáveis de ambiente do arquivo .env
     * 
     * @return void            
     */
    private function loadFileEnvGetVars()
    {
        $file = fopen(ABS_PATH . '/.env', 'r');
        $rLine=fread($file, filesize(ABS_PATH . '/.env'));
        $lines=explode(PHP_EOL,$rLine);
        foreach($lines as $line)
        {
            $env = explode("=", $line);
            try {
                putenv($env[0] . "=" . $env[1]);
            } 
            catch (Exception $e)
            {
                echo "<br>Erro ao setar as variáveis de ambiente:<br>" . $e->getMessage();
            }
            
        }
    }
}

?>