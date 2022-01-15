<?php

namespace TesteApp\App;

use TesteApp\Database\Connection;

abstract class Model
{
    protected $table;
    protected $fillable = [];
    protected $guarded = ['id'];

    public $id;

    public function __construct($fields = [])
    {
        foreach ($fields as $key => $value) {
            if (in_array($key, array_merge($this->fillable, $this->guarded), true)) {
                $this->$key = $value;
            }
        }
    }

    public function create()
    {
        $query = "INSERT INTO {$this->table} (";
        $query .= implode(',', $this->fillable);
        $query .= ") VALUES (";
        $query .= implode(',', array_fill(0, count($this->fillable), '?'));
        $query .= ")";

        $stmt = Connection::getInstance()->prepare($query);

        $params = [];
        foreach ($this->fillable as $field) {
            $params[] = $this->{$field};
        }

        try {
            if ($stmt->execute($params)) {
                $this->id = Connection::getInstance()->lastInsertId();
                return true;
            }
        } catch (\PDOException $e) {
            return false;
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

    public function all()
    {
        return $this->where('id', '0', '>');
    }


}