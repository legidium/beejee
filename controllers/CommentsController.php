<?php
namespace core\controllers;

use Core;
use core\base\Controller;

class CommentsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
