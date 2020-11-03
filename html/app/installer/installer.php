<?php
use PDO;
/**
 * Classe installer inicia o banco de dados de usuário
*/

class installer
{
    private $conn;
    private $result;

    public function install()
    {
        /* Cria uma nova conexão ao PDO pois está em exception */
        $db = new PDO("mysql:host=".getenv('HOST').";dbname=".getenv('DATABASE'), getenv('USER'), getenv('PASS'));
        
        $createPersonQuery = <<<PERSON
        CREATE TABLE person (
            id int PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(150) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(20) NULL,
            created DATETIME DEFAULT CURRENT_TIMESTAMP,
            modified DATETIME ON UPDATE CURRENT_TIMESTAMP
        )
PERSON;
        
        $createUserQuery = <<<USER
        CREATE TABLE users (
            id int PRIMARY KEY AUTO_INCREMENT,
            login VARCHAR(40) NOT NULL,
            pass VARCHAR(40) NOT NULL,
            nvl SMALLINT DEFAULT 1,
            stats SMALLINT DEFAULT 0,
            personId int NULL,
            created DATETIME DEFAULT CURRENT_TIMESTAMP,
            modified DATETIME ON UPDATE CURRENT_TIMESTAMP
        )
USER;
        
        $createActionPlanQuery = <<<AP
        CREATE TABLE actionPlan (
            id int PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(150) NOT NULL,
            description TEXT NULL,
            created DATETIME DEFAULT CURRENT_TIMESTAMP,
            modified DATETIME ON UPDATE CURRENT_TIMESTAMP
        )
AP;
        $createSectorQuery = <<<SECTOR
        CREATE TABLE sector (
            id int PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(150) NOT NULL,
            description TEXT,
            priority int NOT NULL,
            ap int NULL,
            created DATETIME DEFAULT CURRENT_TIMESTAMP,
            modified DATETIME ON UPDATE CURRENT_TIMESTAMP
        )
SECTOR;
        $createTasksQuery = <<<TASKS
        CREATE TABLE tasks (
            id int PRIMARY KEY AUTO_INCREMENT,
            what_pa TEXT NOT NULL,
            who_pa int NULL,
            when_pa DATETIME NULL,
            why_pa TEXT NULL,
            where_pa TEXT NULL,
            how_pa TEXT NULL,
            howMuch_pa DECIMAL(10,2) NULL,
            state int NULL,
            sector int NULL,
            created DATETIME DEFAULT CURRENT_TIMESTAMP,
            modified DATETIME ON UPDATE CURRENT_TIMESTAMP
        )
TASKS;
        $createStateQuery = <<<STATE
        CREATE TABLE state (
            id int PRIMARY KEY AUTO_INCREMENT,
            description TEXT NOT NULL,
            type int NULL,
            created DATETIME DEFAULT CURRENT_TIMESTAMP,
            modified DATETIME ON UPDATE CURRENT_TIMESTAMP
        )
STATE;

        $queries = [$createPersonQuery, $createUserQuery, $createActionPlanQuery, $createSectorQuery, $createTasksQuery, $createStateQuery];

        $this->result = [];

        foreach ($queries as $query) 
        {
            $p_sql = $db->prepare($query);

            array_push($this->result,$p_sql->execute());
        }

        return $this->result;
    }

    public function createFirstUser(){

    }
}
?>