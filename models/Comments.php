<?php

namespace core\models;

use core\base\Model;

class Comments extends Model
{
    public static function tableName()
    {
        return 'comments';
    }

    public function findByAuthor($author)
    {

    }
}
