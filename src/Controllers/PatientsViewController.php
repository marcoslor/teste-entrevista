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

    public function patch()
    {
        $patient = (new \TesteApp\Models\Patient($_POST));
        if($patient->update()) {
            header('Location: /pacientes');
        } else {
            echo 'Erro ao atualizar';
        }
    }

    public function delete()
    {
        $patient = (new \TesteApp\Models\Patient($_POST));
        if ($patient->delete()) {
            header('Location: /pacientes');
        } else {
            echo "Erro ao apagar";
        }
    }

    public function put()
    {
        $patient = (new \TesteApp\Models\Patient($_POST));
        if ($patient->create()) {
            header('Location: /pacientes');
        } else {
            echo "Erro ao salvar";
        }
    }
}