<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoping lista</title>
    <link type="text/css" href="css/style5.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle&display=swap" rel="stylesheet">
</head>
<body>
<div class="glavni">
    <h1>Nova Soping lista</h1>
    <a href='index.php'>Glavna strania</a>
    <a href='add.php'>Dodaj proizvod</a>
    <a href='informacije.php'>O nama</a>
    <a href='kontakt.php'>Kontakt</a>
    <form name="novalista" method="post">
        <label for="ime">Ime liste:</label>
        <input type="text" name="ime" id="ime" maxlength="50"><br>
        <input type="submit" name="submit" value="Dodaj">
    </form>
    <?php
    @include 'db_config.php';
    if(isset($_POST['submit']))
    {
        $imeliste = mysqli_real_escape_string($con,$_POST['ime']);
        if($imeliste != "") {
            $komanda = "INSERT INTO liste (Naziv) VALUES ('$imeliste')";
            mysqli_query($con, $komanda);
            header('Location: index.php?p=3');
        }
        else
        {
            echo "<p class='greska'>Niste uneli ime!</p>";
        }
    }
    ?>
</div>


</body>
</html>


