<!doctype html>
<html lang="pt-BR">
<?php include __DIR__.'/../Partials/Head.php' ?>
<body>
<div class="container min-vh-100 d-flex">
    <div class="row justify-content-center my-auto w-100">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading mb-4">
                    <h1 class="panel-title">Login</h1>
                </div>
                <div class="panel-body">
                    <form action="/login" method="post">
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
                                <a href="/cadastro" class="">Não tem uma conta?</a>
                            </div>
                        </div>
                    </form>
                    <?php if (!empty($errors)): ?>
                        <div class="mt-4">
                            <?php foreach ($errors['default'] as $error): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
