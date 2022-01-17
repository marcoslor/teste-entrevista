<?php

namespace PacientesSys\App;

use Exception;
use PacientesSys\Database\Connection;
use PDO;
use PDOException;

/**
 * Classe responsável por manipular os dados no banco de dados
 */
abstract class Model
{
    /**
     * Array contendo campos da tabela que podem ser manipulados pelo usuário
     * @var array
     */
    public $fillable = [];
    /**
     * Campo ID do modelo
     * @var integer
     */
    public $id;
    /**
     * Array contendo as colunas da chave primária da tabela
     * @var string[]
     */
    protected $pks = ['id'];
    /**
     * Nome da tabela do modelo
     * @var string
     */
    protected $table;

    /**
     * @param $fields
     */
    public function __construct($fields = [])
    {
        foreach ($fields as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @return bool
     */
    public function create()
    {
        $fields = array_merge($this->fillable, $this->pks);

        $query = "INSERT INTO {$this->table} ("
            . implode(',', $fields)
            . ") VALUES ("
            . implode(',', array_fill(0, count($fields), '?'))
            . ")";


        $stmt = Connection::getInstance()->prepare($query);

        $params = array_map(function ($field) {
            return $this->{$field};
        }, $fields);

        if ($stmt->execute($params)) {
            $this->id = Connection::getInstance()->lastInsertId();
            return true;
        }

        return false;
    }

    /**
     * @param $field
     * @param $value
     * @param $operator
     * @return Model[]
     */
    public function where($field, $value, $operator = '=')
    {
        //select all and return array of objects
        $sql = "SELECT * FROM {$this->table} WHERE {$field} {$operator} ?";

        try {
            $stmt = Connection::getInstance()->prepare($sql);
            $stmt->execute([$value]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        try {
            $map = array_map(static function ($res) {
                return new static($res);
            }, $result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $map;
    }

    /**
     * @return bool
     */
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
        } catch (PDOException $e) {
            return false;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $query = "DELETE FROM {$this->table} WHERE "
            . implode(' AND ', array_map(static function ($field) {
                return "{$field} = ?";
            }, $this->pks));

        $stmt = Connection::getInstance()->prepare($query);

        $params = array_map(function ($field) {
            return $this->{$field};
        }, $this->pks);

        try {
            if ($stmt->execute($params)) {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        return false;
    }

    /**
     * @param $values
     * @param $safe
     * @return void
     */
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