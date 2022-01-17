<?php

namespace PacientesSys\App;

use PacientesSys\Database\Connection;

abstract class Model
{
    protected $guarded = ['id'];
    protected $pks = ['id'];
    protected $table;
    public $fillable = [];
    public $id;


    public function __construct($fields = [])
    {
        foreach ($fields as $key => $value) {
            $this->$key = $value;
        }
    }

    public function create()
    {
        $fields = array_merge($this->fillable, $this->pks);

        $query = "INSERT INTO {$this->table} ("
            .implode(',', $fields)
            .") VALUES ("
            .implode(',', array_fill(0, count($fields), '?'))
            .")";


        $stmt = Connection::getInstance()->prepare($query);

        $params = array_map(function ($field){
            return $this->{$field};
        }, $fields);

        if ($stmt->execute($params)) {
            $this->id = Connection::getInstance()->lastInsertId();
            return true;
        }

        return false;
    }

    public function where($field, $value, $operator='=')
    {
        //select all and return array of objects
        $sql = "SELECT * FROM {$this->table} WHERE {$field} {$operator} ?";

        try {
            $stmt = Connection::getInstance()->prepare($sql);
            $stmt->execute([$value]);
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        try {
            $map = array_map(static function ($res){
                return new static($res);
            }, $result);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return $map;
    }

    public function update()
    {
        $query = "UPDATE {$this->table} SET ";
        $query .= implode(',', array_map(static function ($field) {
            return "{$field} = ?";
        }, $this->fillable));
        $query .= " WHERE ";
        $query .= implode(' AND ', array_map(static function ($field) {
            return "{$field} = ?";
        }, $this->pks));

        $stmt = Connection::getInstance()->prepare($query);

        $params = [];
        foreach ($this->fillable as $field) {
            $params[] = $this->{$field};
        }
        foreach ($this->pks as $field) {
            $params[] = $this->{$field};
        }

        try {
            if ($stmt->execute($params)) {
                return true;
            }
        } catch (\PDOException $e) {
            return false;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM {$this->table} WHERE "
            .implode(' AND ', array_map(static function ($field)
            {return "{$field} = ?";}, $this->pks));

        $stmt = Connection::getInstance()->prepare($query);

        $params = array_map(function ($field) {
            return $this->{$field};
        }, $this->pks);

        try {
            if ($stmt->execute($params)) {
                return true;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        return false;
    }

    public function fill($values, $safe = true)
    {
        foreach ($values as $key => $value) {
            if ($safe) {
                if (in_array($key, $this->fillable, false)) {
                    $this->{$key} = $value;
                }
            } else {
                $this->{$key} = $value;
            }
        }
    }
}