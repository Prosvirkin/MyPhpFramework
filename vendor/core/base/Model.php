<?php

namespace vendor\core\base;

use vendor\core\db;

abstract class Model
{

    protected $pdo;
    protected $table;
    protected $pk = 'id';

    public function __construct()
    {
        $this->pdo = db::instance();
    }

    // Просто запрос
    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    // Выборка всех данных из данной таблицы
    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }


    public function findOne($id, $field = '')
    {
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }

    public function findLike($str, $field, $table = "")
    {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }

    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }

}