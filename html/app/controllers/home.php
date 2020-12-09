<?php
namespace app\controllers;

use app\helpers\crud;
use app\helpers\views;
use app\installer\installer;
use Exception;

class home implements stdController
{
    public function index()
    {
        try {
        $tst = new crud();
        $array = $tst->read(getenv('TBL_PERSON'), '', '', null);
            putenv('INSTALL=true');
        } catch(Exception $e) {
            if ($e->getMessage() == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'appweb1.person' doesn't exist"):
                $array['OPA'] = 'Você é novo aqui!';
                putenv('INSTALL=false');
            endif;
        }
        if ((getenv('INSTALL')) != 'true') {
            $page = new views('home/index', $array, ['menu' => 'startMenu']);
            $page->render();
        } else {
            $page = new views('home/index', $array);
            $page->render();
        }

    }

    public function start(){
        try {
            $tst = new crud();
            $array = $tst->read(getenv('TBL_PERSON'), '', '', null);
            $createTable[0] = true;
            $createTable[1] = true;
            $createTable[2] = true;
            $createTable[3] = true;
            $createTable[4] = true;
            $createTable[5] = true;
        } catch(Exception $e) {
            if ($e->getMessage() == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'appweb1.person' doesn't exist"):
                $install = new installer();
                $createTable = $install->install();
                putenv('INSTALL=true');
            endif;
        }

        $page = new views('home/start', $createTable);
        $page->render();
    }

}