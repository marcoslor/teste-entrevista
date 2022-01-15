<?php

namespace TesteApp\App;

use TesteApp\Database\Connection;

abstract class Model
{
    protected $table;
    protected $fillable = [];

    public $id;

    public function __construct($fields = [])
    {
        foreach ($fields as $key => $value) {
            if (in_array($key, $this->fillable, true)) {
                $this->$key = $value;
            }
        }
    }

    public function create(){
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

        $stmt->execute($params);

        $this->id = Connection::getInstance()->lastInsertId();
    }

    public function validate(array $data){
        foreach ($this->fillable as $field) {
            if (!array_key_exists($field, $data)){
                return false;
            }
        }
        return true;
    }

    private function prepareData(array $data){
        $preparedData = [];
        foreach ($this->fillable as $field) {
            if (array_key_exists($field, $data)){
                $preparedData[$field] = $data[$field];
            }
        }
        return $preparedData;
    }

    private function execute($sql, array $data)
    {
        return Connection::getInstance()->prepare($sql)->execute($data);
    }

    public function where($field, $value)
    {
        //select all and return array of objects
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->execute([$value]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(static function ($res){
            return new static($res);
        }, $result);
    }

    public function save()
    {
        //update if model exists, if not, create
        if ($this->exists()) {
            $this->update();
        } else {
            $this->create();
        }
    }

    public function exists()
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindValue(":id", $this->id);
        $stmt->execute();
        return !empty($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    private function update()
    {
        $sql = "UPDATE {$this->table} SET ";
        $sql .= implode(', ', array_map(static function($field){
            return "{$field} = :{$field}";
        }, array_keys($this->fillable)));
        $sql .= " WHERE id = :id";
        $data = $this->prepareData($this->fillable);
        $data['id'] = $this->id;
        return $this->execute($sql, $data);
    }
}