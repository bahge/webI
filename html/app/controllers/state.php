<?php
namespace app\controllers;

use app\helpers\views;
class state implements stdController
{

    public function index()
    {
        $page = new views('state/index');
        $page->render();
    }
}