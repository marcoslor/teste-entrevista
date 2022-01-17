<?php include __DIR__.'/../Partials/Head.php' ?>
<body>
<div class="position-absolute w-100">
    <?php include __DIR__.'/../Partials/Navbar.php' ?>
</div>

<div class="container min-vh-100 d-flex">

    <div class="row justify-content-center my-auto w-100">
       <div class="col-6">
           <h1 class="">Importar pacientes</h1>

           <form action="/importar" method="POST" enctype="multipart/form-data">
               <div class="input-group mb-3">
                   <input type="file" class="form-control" id="file" name="file">
                   <button type="submit" class="btn btn-success">Importar</button>
               </div>
           </form>

           <?php if (isset($errors)): ?>
               <div class="mt-4">
                   <?php foreach ($errors as $error): ?>
                       <div class="alert alert-danger"><?= $error ?></div>
                   <?php endforeach; ?>
               </div>
           <?php endif; ?>

           <?php if (isset($success)): ?>
               <div class="mt-4">
                   <div class="alert alert-success"><?= $success ?></div>
               </div>
           <?php endif; ?>
       </div>
    </div>
</div>
</body>