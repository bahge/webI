<?php
namespace app\controllers;

use app\helpers\views;
class tasks implements stdController
{

    public function index()
    {
        $page = new views('tasks/index');
        $page->render();
    }
}