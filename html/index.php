<?php
    define("ABS_PATH", __DIR__);

    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
    /* AutoLoader para as classes */
    include_once("./app/helpers/autoloader.php");
    $autoload = new autoloader();
    // Classe que carrega as variáveis de ambiente
    use app\helpers\config;
    try {
        // Carregando as variáveis de ambiente do projeto
        config::getInstance()->loadFileEnv();
    } catch(Exception $e) {
        echo "Erro ao chamar a classe manipuladora das variáveis de ambiente do projeto: <br>" . $e->getMessage();
    }

    // Carregando as rotas
    if (isset($_GET['url']))
    {
        $url = $_GET['url'];
        $url = explode('/', $url);
    }
    else
    {
        $url = array('home');
    }
    use app\helpers\rotes;
    $rotes = new rotes($url);


    /*try {
        // Requisitando a conexão
        $tst = conn::run("SELECT count(*) FROM users")->fetchColumn();
        echo $tst;
    
    } catch(Exception $e) {
        if ($e->getMessage() == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'appweb1.users' doesn't exist"):
            // Incluindo arquivo de configurações 
            //require_once("app/installer/installer.php");
            $install = new installer();
            $createTable = $install->install();
            print_r($createTable);
            //echo ($createTable === true) ? "Tabela criada" : "Erro ao criar a tabela" ;
        else:
            messager::getInstance()->setErrorFile('Ocorreu um erro na query para o banco de dados', '001' , $_SERVER['PHP_SELF'], 'Erro ao acessar o BD');
            print_r(messager::getInstance()->getFormatErrorMsg());die;
        endif;
       
    }*/

?>