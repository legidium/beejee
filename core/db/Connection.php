<?php

namespace core\db;

use core\base\Component;

class Connection extends Component
{
    /** @var \PDO */
    public $pdo;
    public $dsn;
    public $username;
    public $password;
    public $attributes;

    public function connect()
    {
        try {
            $this->pdo = new \PDO($this->dsn, $this->username, $this->password, $this->attributes);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES 'UTF8'");

        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function disconnect()
    {
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public function quoteTableName($name)
    {
        return strpos($name, "`") !== false ? $name : "`" . $name . "`";
    }

    protected function configure($config = [])
    {
        if (isset($config['dsn'])) { $this->dsn = $config['dsn']; }
        if (isset($config['username'])) { $this->username = $config['username']; }
        if (isset($config['password'])) { $this->password = $config['password']; }
        if (isset($config['attributes'])) { $this->attributes = $config['attributes']; }
    }
}
