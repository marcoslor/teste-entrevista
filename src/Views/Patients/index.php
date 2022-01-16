<!doctype html>
<html lang="pt-BR">
<?php include __DIR__.'/../Partials/Head.php' ?>
<style>
    #editPatientModal {
        width: 100%;
    }
    #editPatientModal.custom-modal-container {
        padding: 15px;
        position: fixed;
        inset: 0;
        z-index: 99;
        background-color: rgba(0, 0, 0, 0.15);
        display: none;
    }
    #editPatientModal.custom-modal-container.show {
        display: block;
    }
    #editPatientModal .custom-modal {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        padding: 20px;
        position: relative;
        width: 50%;
        min-width: 12rem;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    #customClose {
        border: none;
        background-color: transparent;
    }
    #editPatientModal button {
        margin-left: auto;
    }
    .edit-button {
        margin-right: .4rem;
    }
</style>

<body>

<?php include __DIR__.'/../Partials/Navbar.php' ?>

<div class="custom-modal-container" id="editPatientModal">
    <div class="custom-modal">
        <div class="d-flex mb-2 justify-content-between align-items-center">
            <h1 class="">Editar paciente</h1>
            <button id="customClose">❌</button>
        </div>
        <form action="/pacientes/patch" method="post">
            <input name="id" id="id" type="hidden">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nome" required>
            </div>
            <div class="form-grop">
                <label for="age">Idade</label>
                <input type="number" name="age" class="form-control" id="age" placeholder="Idade" min="0" max="150" required>
            </div>
            <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Telefone" required>
            </div>
            <div class="form-group">
                <label for="registration">Matrícula</label>
                <input type="text" name="registration" class="form-control" id="registration" placeholder="Matrícula" required>
            </div>
            <div class="w-100 d-inline-flex">
                <button type="submit" class="mt-4 btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="container pt-5">
    <h1 class="">Lista de Pacientes</h1>

    <table class="table table-striped table-hover">
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
                <tr class="patient" data-patient-id = <?= $patient->id?>>
                    <td class="align-middle"><?= $patient->name ?></td>
                    <td class="align-middle"><?= $patient->age ?></td>
                    <td class="align-middle"><?= $patient->phone ?></td>
                    <td class="align-middle"><?= $patient->registration ?></td>
                    <td class="align-middle">
                        <div class="d-inline-flex">
                            <button type="button" class="text-nowrap btn btn-outline-primary edit-button">
                            <span class="pencil-svg">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </span>
                                Editar
                            </button>
                            <form action="/pacientes/delete" method="post" class="d-inline-block">
                                <input name="id" type="hidden" value="<?= $patient->id ?>">
                                <button type="submit" class="text-nowrap btn btn-outline-danger">
                                <span class="trash-svg">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </span>
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach;
        } ?>
        </tbody>
        <tfoot>
        <tr id="to-add" class="">
            <td><input class="form-control" type="text" name="name" placeholder="Nome" form="new_patient" required></td>
            <td><input class="form-control" type="number" name="age" placeholder="Idade" form="new_patient" required></td>
            <td><input class="form-control" type="text" name="phone" placeholder="Telefone" form="new_patient" required></td>
            <td><input class="form-control" type="text" name="registration" placeholder="Matrícula" form="new_patient" required></td>
            <td><button class="btn btn-success w-100" type="submit" form="new_patient">Novo paciente</button></td>
        </tr>
        </tfoot>
    </table>
</div>

<form id="new_patient" name="new_patient" action="/pacientes/put" method="post">
</form>

<script>
  const modal = document.querySelector("#editPatientModal");
  const closeButton = document.querySelector("#customClose");

  closeButton.addEventListener("click", () => {
    modal.classList.remove("show");
  });

  document.querySelectorAll(".edit-button").forEach(editButton => {
    let patient = editButton.parentElement.parentElement;
    let patient_id = patient.dataset.patientId;

    editButton.addEventListener("click", () => {
      modal.classList.add("show");

      modal.querySelector("#id").value = patient_id;
      modal.querySelector("#name").value = patient.querySelector("td:nth-child(1)").textContent;
      modal.querySelector("#age").value = patient.querySelector("td:nth-child(2)").textContent;
      modal.querySelector("#phone").value = patient.querySelector("td:nth-child(3)").textContent;
      modal.querySelector("#registration").value = patient.querySelector("td:nth-child(4)").textContent;
    });
  });
</script>
</body>
</html>

