<!doctype html>
<html lang="pt-BR">
<?php include __DIR__.'/../Partials/Head.php' ?>
<body>
<div class="container">
    <h1>Lista de Pacientes</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Idade</th>
            <th>Telefone</th>
            <th>Matrícula</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>

        <?php if (isset($patients)) {
            foreach ($patients as $patient): ?>
                <tr data-patient-id = <?= $patient->id?>>
                    <td><?= $patient->name ?></td>
                    <td><?= $patient->age ?></td>
                    <td><?= $patient->phone ?></td>
                    <td><?= $patient->registration ?></td>
                    <td>
                        <button class="btn btn-primary" disabled>Editar</button>
                        <button class="btn btn-danger" disabled>Excluir</button>
                    </td>
                </tr>
            <?php endforeach;
        } ?>
        </tbody>
</div>
</body>
</html>

