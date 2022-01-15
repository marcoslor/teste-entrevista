<?php

namespace TesteApp\Controllers;

use TesteApp\App\View;

class PatientsViewController
{
    public function index()
    {
        $patients = (new \TesteApp\Models\Patient())->all();
        View::render('Patients/index', ['patients' => $patients]);
    }
}