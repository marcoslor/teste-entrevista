<?php

namespace PacientesSys\Models;

class User extends \PacientesSys\App\Model
{
    protected $table = 'users';
    public $fillable = ['name', 'email', 'password'];

    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $name;

}