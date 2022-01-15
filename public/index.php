<?php
require dirname(__DIR__) . '/vendor/autoload.php';

TesteApp\Config\Config::start();
TesteApp\Utils\AuthGuard::redirectIfNotLoggedIn();
?>

<!doctype html>
<html lang="pt-BR">
<?php include '../src/Views/Head.php' ?>
<body>
<h1>Logout Form</h1>
<form action="logout.php" method="post">
    <input type="submit" value="Logout">
</form>
</body>
</html>

<?php