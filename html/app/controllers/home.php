<?php
namespace app\controllers;

use app\helpers\views;
class home implements stdController
{
    public function index()
    {
        $page = new views('home/index');
        $page->render();
    }
}