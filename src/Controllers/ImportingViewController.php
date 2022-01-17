<?php

namespace PacientesSys\Controllers;

use PacientesSys\App\Controller;
use PacientesSys\App\View;
use PacientesSys\Models\Patient;

class ImportingViewController extends Controller
{
    public function index()
    {
        View::render('Importing/importing', [
            'errors' => $_SESSION['errors']['importing'] ?? null,
            'success' => $_SESSION['success']['importing'] ?? null,
        ]);

        parent::index();
    }

    public function import()
    {
        $csv_file = $_FILES['file'];

        //check if the file was uploaded
        if ($csv_file['size'] === 0) {
            $_SESSION['errors']['importing'][] = 'O arquivo não foi enviado';
            header('Location: /importing');
            return;
        }

        //check if the csv file is valid
        $csv_file_tmp_name = $csv_file['tmp_name'];
        $csv_file_handle = fopen($csv_file_tmp_name, 'rb');
        $csv_file_data = fgetcsv($csv_file_handle, 1000, ',');

        if ($csv_file_data === false) {
            $_SESSION['errors']['importing'][] = 'O arquivo não é um arquivo CSV válido';
            header('Location: /importing');
            return;
        }

        // loop through the csv file and insert the data into the database
        $csv_file_handle = fopen($csv_file_tmp_name, 'rb');
        $csv_file_map = fgetcsv($csv_file_handle, 1000, ',');

        $q = array_flip($csv_file_map);

        $csv_file_map[$q['nome']] = 'name';
        $csv_file_map[$q['idade']] = 'age';
        $csv_file_map[$q['matricula']] = 'registration';
        $csv_file_map[$q['telefone']] = 'phone';

        while (($csv_file_data = fgetcsv($csv_file_handle, 1000, ',')) !== false) {
            $data = array_combine($csv_file_map, $csv_file_data);

            $p = new Patient();
            $p->fill($data);
            $p->user_id = $_SESSION['user']->id;

            try {
                $p->create();
            } catch (\Exception $e) {
                if ($e->getCode() == 23000) {
                    $errors[] = 'Já existe um paciente com a matrícula ' . $p->registration . '.';
                } else {
                    $errors[] = "Erro ao cadastrar o paciente de matrícula {$p->registration}.";
                }
            }
        }

        $_SESSION['errors']['importing'] = $errors ?? null;
        $_SESSION['success']['importing'] = empty($errors) ? 'Pacientes importados com sucesso!' : null;

        header('Location: /importar');
    }
}