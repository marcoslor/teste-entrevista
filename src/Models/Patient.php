<?php

namespace PacientesSys\Models;

use PacientesSys\App\Model;
use PacientesSys\Database\Connection;

class Patient extends Model
{
    public $table = 'patients';

    public $fillable = [
        'name',
        'age',
        'phone',
        'registration',
    ];

    public $protected = [
        'id'
    ];

    protected $pks = ['id', 'user_id'];

    public string $name;
    public int $age;
    public string $phone;
    public string $registration;
    public int $user_id;


    public function allBelongingToUser()
    {
        //select all and return array of objects
        return $this->where('user_id', $_SESSION['user']->id);
    }
}