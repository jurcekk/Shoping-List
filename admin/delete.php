<div id="sadrzaj">
    <h1>Brisanje namirnica</h1>
<?php
if(isset($_GET['id'])) {
    $id_namirnice = mysqli_real_escape_string($con,$_GET['id']);
    $upit1 = "DELETE FROM listenamirnica WHERE namirnica_id = $id_namirnice";
    mysqli_query($con,$upit1);
    $upit2 = "DELETE FROM namirnice WHERE id_namirnice = $id_namirnice";
    mysqli_query($con,$upit2);
    header('Location: index.php?p=2');
}

    echo "<form method='post' name='forma'>";
    echo "<select name='namirnica' id='namirnice'>";

    echo "<option value='choose'>choose</option>";

    $komanda = "SELECT * FROM namirnice ORDER BY Naziv ASC";
    $rezultat = mysqli_query($con,$komanda);

    if(mysqli_num_rows($rezultat) > 0)
    {
        while($row = mysqli_fetch_assoc($rezultat)) {
            echo "<option value='" . $row['Naziv'] . "'>" . $row['Naziv'] . "</option>";
        }}
    else{
        echo "<option value='nema'>Nema namirnica</option>";
    }
    echo "</select>";
    echo "<input type='submit' name='submit' value='Obrisi'>";
    echo "</form>";

    if(isset($_POST['submit'])){
            $naziv = mysqli_real_escape_string($con,$_POST['namirnica']);
            if($naziv != "choose"){
            $upit3 = "DELETE FROM listenamirnica WHERE namirnica_id = (SELECT id_namirnice FROM namirnice WHERE Naziv = '$naziv')";
            mysqli_query($con,$upit3);
            $upit4 = "DELETE FROM namirnice WHERE id_namirnice = (SELECT id_namirnice FROM namirnice WHERE Naziv = '$naziv')";
            mysqli_query($con,$upit4);
            echo "<p>Uspesno obrisano</p>";}
            else
            {
                echo "<p>Niste izabrali namirnicu!</p>";
            }
    }
?></div>