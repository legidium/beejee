<?php
namespace core\controllers;

use Core;
use core\base\Controller;

class AdminController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['title' => 'Панель управления']);
    }
}
