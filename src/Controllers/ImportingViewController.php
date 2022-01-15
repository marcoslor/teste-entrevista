<?php

namespace TesteApp\Controllers;

use TesteApp\App\Controller;
use TesteApp\App\View;
use TesteApp\Models\Patient;

class ImportingViewController extends Controller
{
    public function index()
    {
        View::render('Importing/importing');
    }

    public function import()
    {
        $csv_file = $_FILES['file'];

        //check if the file was uploaded
        if ($csv_file['size'] === 0) {
            View::render('Importing/importing', ['errors' => ['Não foi enviado nenhum arquivo.']]);
            return false;
        }

        //check if the csv file is valid
        $csv_file_tmp_name = $csv_file['tmp_name'];
        $csv_file_handle = fopen($csv_file_tmp_name, 'rb');
        $csv_file_data = fgetcsv($csv_file_handle, 1000, ',');

        if ($csv_file_data === false) {
            View::render('Importing/importing', ['errors' => ['O arquivo enviado não é um arquivo CSV.']]);
        }

        // loop through the csv file and insert the data into the database
        $csv_file_handle = fopen($csv_file_tmp_name, 'rb');
        $csv_file_map = fgetcsv($csv_file_handle, 1000, ',');

        $q = array_flip($csv_file_map);
        $csv_file_map[$q['nome']] = 'name';
        $csv_file_map[$q['idade']] = 'age';
        $csv_file_map[$q['matricula']] = 'registration';
        $csv_file_map[$q['telefone']] = 'phone';

        $errors = [];

        while (($csv_file_data = fgetcsv($csv_file_handle, 1000, ',')) !== false) {
            $data = array_combine($csv_file_map, $csv_file_data);
            $p = new Patient($data);
            if (!$p->create()) {
                $errors[] = "Erro ao importar o paciente {$p->name}.";
            }
        }

        if (empty($errors)) {
            View::render('Importing/importing', ['success' => 'Pacientes importados com sucesso.']);
        } else {
            View::render('Importing/importing', ['errors' => $errors]);
        }
    }
}