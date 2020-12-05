<?php
namespace app\controllers;

use app\helpers\views;
class actionplan implements stdController
{

    public function index()
    {
        $page = new views('actionplan/index');
        $page->render();
    }
}