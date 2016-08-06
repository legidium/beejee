<?php
namespace core\base;

use Core;
use core\db\Query;

class Model extends Component
{
    private $_errors;

    /**
     * @return string
     * @throws \Exception
     */
    public static function tableName()
    {
        throw new \Exception('Table name for `' . get_called_class() . '` is not configured.');
    }

    /**
     * @return \core\db\Connection
     */
    public static function getDb()
    {
        return Core::$app->getDb();
    }

    /**
     * @return array
     * @param array|null $limits
     */
    public static function findAll($limits = null)
    {
        $db = static::getDb();
        $sql = 'SELECT * FROM ' . $db->quoteTableName(static::tableName());

        $stmt = $db->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findById($id)
    {
        $db = static::getDb();
        $sql = 'SELECT * FROM ' . $db->quoteTableName(static::tableName()) . ' AS t WHERE t.id = :id';

        $stmt = $db->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function validate($attributes = [])
    {
        return !$this->hasErrors();
    }

    public function hasErrors()
    {
        return !empty($this->_errors);
    }
}

