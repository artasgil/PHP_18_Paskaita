
<?php require_once("connections.php"); ?>
<?php if (!isset($_COOKIE["prisijungta"])) {
    header("Location: prisijungimas.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meniu, dinaminiai puslapiai, blogo sistema </title>
    <?php require_once("includes.php"); ?>
</head>
<body>
    <div class="container">
    <?php require_once("design-parts/meniu.php"); ?>
    <?php require_once("design-parts/jumbotron.php"); ?>
    <?php showJumbotron("Index", "Welcome to our website") ?>
    <?php require_once("design-parts/main.php"); ?>
</div>
    
</body>
</html>