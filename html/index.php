<?php
    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
    
    /* Incluindo arquivo da conexão com o BD */
    require_once("app/helpers/conn.php") ;
    /* Requisitando a conexão */
    try {
        conn::getInstance()->query('SELECT * FROM casa');
    } catch(PDOException $e) {
       echo "Erro na conexão: <br>" . $e->getMessage();
    }
    
?>