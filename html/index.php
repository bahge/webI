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

?>