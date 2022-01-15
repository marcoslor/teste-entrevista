<?php

require dirname(__DIR__) . '/vendor/autoload.php';
TesteApp\Config\Config::start();
TesteApp\Utils\AuthGuard::redirectIfLoggedIn();

$errors = [];

function validate() {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
        $errors["generic"] = 'Preencha todos os campos';
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email inválido';
        }

        if (strlen($_POST['password']) < 6) {
            $errors['password'] = 'Senha deve ter no mínimo 6 caracteres';
        }

        if ($_POST['password'] !== $_POST['password_confirmation']) {
            $errors['password_confirmation'] = 'Senhas não conferem';
        }
    }

    return empty($errors);
}

// IF POST REQUEST

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    if (validate()) {
        echo "validação ok";
    } else {
        echo "validação falhou";
        if (isset($errors['email'])) {
            echo $errors['email'];
        }
        if (isset($errors['password'])) {
            echo $errors['password'];
        }
        if (isset($errors['password_confirmation'])) {
            echo $errors['password_confirmation'];
        }
        if (isset($errors['generic'])) {
            echo $errors['generic'];
        }
    }
}
// BEGIN OF HTML SENT IN ANY REQUEST
?>

<!doctype html>
<html lang="pt-BR">
<?php include '../src/Views/Head.php' ?>
<body>
<div class="container min-vh-100 d-flex">
    <div class="row w-100 my-md-auto justify-content-center">
        <div class="col-md-6">
            <div class="panel panel-default mt-4 mt-md-0">
                <div class="panel-heading mb-4">
                    <h1 class="panel-title">Cadastro</h1>
                </div>
                <div class="panel-body">
                    <form action="register.php" method="post">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                            <?php if (isset($errors['email'])) :?>
                                <div class="alert alert-danger"><?= $errors['email'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                            <?php if (isset($errors['password'])) : ?>
                                <div class="alert alert-danger"><?= $errors['password'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmação de senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmação de senha" required>
                            <?php if (isset($errors['password_confirmation'])) : ?>
                                <div class="alert alert-danger"><?= $errors['password_confirmation'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="row align-items-center mt-4 justify-content-between">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-block">Cadastrar</button>
                            </div>
                            <div class="col-md-3">
                                <a href="register.php" class="">Login</a>
                            </div>
                        </div>
                    </form>
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger"><?= $errors["generic"] ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
