<div id="sadrzaj">
<?php
if(isset($_GET['id'])){
    if($_GET['id'] != "choose") {
    $id = (int)mysqli_real_escape_string($con,$_GET['id']);
    $upit = "SELECT * FROM namirnice WHERE id_namirnice = $id ORDER BY Naziv ASC";
    $rezultat = mysqli_query($con,$upit);
    if(mysqli_num_rows($rezultat) > 0)
    {
        while($red = mysqli_fetch_assoc($rezultat))
        {
            $naziv = $red['Naziv'];
            $slika = $red['Slika'];
        }
        echo '<h1>Izmena</h1>
    <form method="post">
    <label>Naziv: </label><input type="text" name="name" value="' . $naziv . '"><br><br>
    <label>Slika: </label><input type="text" name="slika" value="' . $slika . '"><br><br>
    <input type="hidden" name="id" value="' . $id . '">
    <input type="submit" value="Izmeni" name="submit">
    </form>';
    }}
    else
    {
        echo "<p>Niste izabrali namirnicu!</p>";
    }
}else
{
    $dropdown = "SELECT id_namirnice, Naziv FROM namirnice ORDER BY Naziv ASC";
    $rez = mysqli_query($con, $dropdown);
    if(mysqli_num_rows($rez) > 0)
    {
        echo "<form method='get'>";
        echo "<h1>Izaberi namirnicu</h1>";
        echo "<select name='id'>";
        echo "<option value='choose'>choose</option>";
        while ($red = mysqli_fetch_assoc($rez)) {
            echo '<option value="' . $red['id_namirnice'] . '">' . $red['Naziv'] . '</option>';
        }
        echo "</select>";
        echo "<input type='hidden' name='p' value='3'>";
        echo "<input type='submit' name='submit' value='Izaberi'>";
    }
}
if(isset($_POST['submit'])){
    if($_POST['submit'] == "Izmeni")
    {

            $id = (int)mysqli_real_escape_string($con, $_POST['id']);
            $naziv = mysqli_real_escape_string($con, $_POST['name']);
            $slika = mysqli_real_escape_string($con, $_POST['slika']);
            $izmena = "UPDATE namirnice SET Naziv = '$naziv', Slika = '$slika' WHERE id_namirnice = $id";

            mysqli_query($con, $izmena);
            header('Location: index.php?p=2');
    }
}
?>
</div>
