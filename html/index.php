<?php
    define("ABS_PATH", __DIR__);

    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);

    /* Incluindo arquivo de mensagens */
    require_once("app/helpers/messager.php");

    /* Incluindo arquivo de configurações */
    require_once("app/helpers/config.php");

    /* Incluindo arquivo da conexão com o BD */
    require_once("app/helpers/conn.php");

    /* Carregando as variáveis de ambiente do projeto */
    try {
        config::getInstance()->loadFileEnv();
    } catch(Exception $e) {
        echo "Erro ao chamar a classe manipuladora das variáveis de ambiente do projeto: <br>" . $e->getMessage();
    }

    /* Requisitando a conexão */
    try {
        conn::getInstance()->query('SELECT * FROM user');
    } catch(PDOException $e) {
        if ($e->getMessage() == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'appweb1.users' doesn't exist"):
        else:
            messager::getInstance()->setErrorFile('Ocorreu um erro na query de banco de dados', '002' ,$_SERVER['PHP_SELF'], $e->getMessage());
            print_r(messager::getInstance()->getFormatErrorMsg());
        endif;
       
    }
    
    
?>