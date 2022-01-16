<?php

namespace TesteApp\Models;

use TesteApp\App\Model;

class Patient extends Model
{
    protected $table = 'patients';

    public $fillable = [
        'name',
        'age',
        'phone',
        'registration',
        'user_id'
    ];

    public string $name;
    public int $age;
    public string $phone;
    public string $registration;
    public int $user_id;

    public function __construct($fields = [])
    {
        parent::__construct($fields);
        // se não for informado o id associado ao usuário, considerar o id do usuário logado na seção
        $this->user_id = $_SESSION['user']->id;
    }

}