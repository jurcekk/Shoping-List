<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <title>Admin</title>
</head>
<body>
<?php
require 'nav.php';
require 'db_config.php';
$op = "";
if (isset($_GET['p']))
    $op = mysqli_real_escape_string($con, $_GET['p']);

switch ($op)
{
    case "1":
        include("new.php");
        break;
    case "2":
        include("list.php");
        break;
    case "3":
        include("update.php");
        break;
    case "4":
        include("delete.php");
        break;
}

?>
</body>
</html>
