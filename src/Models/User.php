<?php

namespace TesteApp\Models;

class User extends \TesteApp\App\Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];

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

    function teste()
    {
        return 'teste';
    }
}