<?php
// Path: public/login.php
require dirname(__DIR__) . '/vendor/autoload.php';

use TesteApp\Database\Connection;

TesteApp\Config\Config::start();
TesteApp\Utils\AuthGuard::redirectIfLoggedIn();

$errors = [];

function prepBuscaUsuario ($email, $password) {
    $c = Connection::prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $c->bindParam(':email', $email);
    $c->bindParam(':password', $password);

    return $c;
}

// IF POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $c = prepBuscaUsuario($email, $password);
    $c->execute();

    $user = $c->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user'] = $user;
        $_SESSION['isLogged'] = true;
        $_SESSION['csrf'] = md5(uniqid(mt_rand(), true));
        
        header('Location: /');
    } else {
        $errors[] = 'Usuário ou senha inválidos';
    }
}
?>

<!doctype html>
<html lang="pt-BR">
<?php include '../src/Views/Head.php' ?>
<body>
<div class="container min-vh-100 d-flex">
    <div class="row justify-content-center my-auto w-100">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading mb-4">
                    <h1 class="panel-title">Login</h1>
                </div>
                <div class="panel-body">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-block">Entrar</button>
                            </div>
                            <div class="col-md-6">
                                <a href="register.php" class="">Não tem uma conta?</a>
                            </div>
                        </div>
                    </form>
                    <?php if (!empty($errors)): ?>
                        <ul class="mt-4">
                            <?php foreach ($errors as $error): ?>
                                <li class="alert alert-danger"><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
