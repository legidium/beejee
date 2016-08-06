<?php
namespace core\controllers;

use Core;
use core\base\Controller;
use core\models\Comments;

class CommentsController extends Controller
{
    public function actionIndex()
    {
        $sort = isset($_GET['sort']) ? (string)$_GET['sort'] : null;
        $sort = in_array($sort, ['date', 'author', 'email']) ? $sort : 'date';

        $comments = Comments::findAll();

        return $this->render('index', [
            'comments' => $comments,
            'sort' => $sort,
        ]);
    }
}
