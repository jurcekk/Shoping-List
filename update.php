<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shoping lista</title>
    <meta charset="UTF-8">
    <link href="css/style3.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle&display=swap" rel="stylesheet">
</head>
<body>
<div class="glavni">
    <div class="sadrzaj">
        <form method="post">
            <h1>Izmena</h1>
            <a href="index.php">Vrati se na pocetnu</a><br>
            <p class="tekst">Namirnica:</p>
            <?php
            include 'db_config.php';
            $id1 = mysqli_real_escape_string($con,$_GET['namirnica_id']);
            $naziv1 = "SELECT Naziv FROM namirnice WHERE id_namirnice = $id1";
            $rezultatime1 = mysqli_query($con,$naziv1);
            if(mysqli_num_rows($rezultatime1) > 0){
                while ($row = mysqli_fetch_assoc($rezultatime1))
                {
                    echo "<p class='tekst'>" . $row['Naziv'] . "</p>";
                }
            }?>
            <br>
            <p class="tekst">Lista:</p>
            <?php
            $id2 = mysqli_real_escape_string($con,$_GET['lista_id']);
            $naziv2 = "SELECT Naziv FROM liste WHERE id_liste = $id2";
            $rezultatime2 = mysqli_query($con,$naziv2);
            if(mysqli_num_rows($rezultatime2) > 0){
                while ($row2 = mysqli_fetch_assoc($rezultatime2))
                {
                    echo "<p class='tekst'>" . $row2['Naziv'] . "</p>";
                }
            }?>
            <br><p class="tekst">Kolicina </p><input type="number" min="1" name="kolicina">
            <br>
            <input type="submit" name="submit" value="Izmeni">
        </form>
        <?php
        if(isset($_POST['submit'])) {
            if (isset($_POST['kolicina'])) {
                $kolicina = mysqli_real_escape_string($con,$_POST['kolicina']);
                $update = "UPDATE listenamirnica SET kolicina = $kolicina WHERE namirnica_id = $id1 and lista_id = $id2";
                mysqli_query($con, $update);
                header('Location: index.php?p=2');
            }
        }?>
    </div>
</body>
</html>
