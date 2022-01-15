<!doctype html>
<html lang="pt-BR">
<?php include __DIR__.'/Partials/Head.php' ?>
<body>

<h1>Authenticated user info</h1>
User json: <?= json_encode($_SESSION['user']) ?> <br>
User id: <?= $_SESSION['user']->id ?> <br>
User name: <?= $_SESSION['user']->name ?> <br>
User email: <?= $_SESSION['user']->email ?> <br>
User password: <?= $_SESSION['user']->password ?> <br>

<h1>Initial page</h1>
<form action="/logout" method="post">
    <button type="submit" class="btn btn-danger btn-block">Sair</button>
</form>

</body>
</html>