<?php include __DIR__.'/../Partials/Head.php' ?>
<body>
<div class="container">
    <h1>Importar Arquivo</h1>

    <form action="/importar" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Arquivo</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Importar</button>

        <?php if (!empty($errors)): ?>
            <div class="mt-4">
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="mt-4">
                <div class="alert alert-success"><?= $success ?></div>
            </div>
        <?php endif; ?>
    </form>
</div>
</body>