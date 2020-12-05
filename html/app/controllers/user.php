<?php
namespace app\controllers;

use app\helpers\views;
class user implements stdController
{

    public function index()
    {
        $page = new views('user/index');
        $page->render();
    }
}