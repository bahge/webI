<?php
namespace app\controllers;

use app\helpers\views;
class sector implements stdController
{

    public function index()
    {
        $page = new views('sector/index');
        $page->render();
    }
}