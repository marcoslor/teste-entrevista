<nav class="d-flex justify-content-between navbar-light bg-light p-3">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="/pacientes">Ver pacientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/importar">Importar lista</a>
        </li>
    </ul>
    <div class="d-flex align-items-center">
        <span class="me-3">
            <span class="user-icon-svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </span>
            <?= $_SESSION['user']->name ?>
        </span>
        <button type="submit" class="btn btn-danger btn-block" form="logout-form">Sair</button>
    </div>
</nav>
<form action="/logout" method="post" id="logout-form" name="logout-form">
</form>