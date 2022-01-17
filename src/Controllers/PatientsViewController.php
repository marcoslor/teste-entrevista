<?php

namespace PacientesSys\Controllers;

use PacientesSys\App\Controller;
use PacientesSys\App\View;
use PacientesSys\Models\Patient;

class PatientsViewController extends Controller
{
    public function index()
    {
        $patients = (new Patient())->allBelongingToUser();
        View::render('Patients/index', ['patients' => $patients, 'errors' => $_SESSION['errors']['patients']??null]);

        parent::index();
    }

    public function patch()
    {
        $patientToPatch = (new Patient())->where('id', $_POST['id'])[0];

        $patientToPatch->fill($_POST);

        if ($patientToPatch->user_id == $_SESSION['user']->id) {
            if(!$patientToPatch->update()) {
                $_SESSION['errors']['patients'] = ['Erro ao atualizar paciente'];
            }
            header('Location: /patients');
        }
    }

    public function delete()
    {
        $patientToDelete = (new Patient())->where('id', $_POST['id'])[0];

        if ($patientToDelete->user_id == $_SESSION['user']->id) {
            if (!$patientToDelete->delete()) {
                $_SESSION['errors']['patients'] = ['Erro ao excluir paciente'];
            }
            header('Location: /pacientes');
        } else {
            http_response_code(403);
        }
    }

    public function put()
    {
        $patient = (new Patient());
        $patient->fill($_POST);
        $patient->user_id = $_SESSION['user']->id;

        try {
            $patient->create();
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['errors']['patients'] = ['Já existe um paciente com essa matrícula'];
            } else {
                $_SESSION['errors']['patients'] = ['Erro ao criar'];
            }
        }

        header('Location: /pacientes');
    }
}