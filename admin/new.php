<div id="sadrzaj">
    <h1>Nova namirnica</h1>
    <?php
    echo "<form method='post' name='forma'>";
    echo "<label for='naziv'>Naziv:</label> <input type='text' name='naziv' id='naziv' placeholder='Naziv namirnice'><br>";
    echo "<label for='slika'>Slika:</label> <input type='text' name='slika' id='slika' placeholder='Naziv slike sa .formatom'><br>";
    echo"<input type='submit' name='submit' value='Unesi'><br>";
    echo "</form>";

    if(isset($_POST['naziv']) and isset($_POST['slika'])) {
        if ($_POST['naziv'] != "" and $_POST['slika'] != "") {
            $naziv = mysqli_real_escape_string($con, $_POST['naziv']);
            $slika = mysqli_real_escape_string($con, $_POST['slika']);
            $upit = "INSERT INTO namirnice(Naziv,Slika) VALUES ('$naziv','$slika')";
            $provera = "SELECT Naziv FROM namirnice WHERE Naziv = '$naziv'";
            $rezultat = mysqli_query($con,$provera);
            if(mysqli_num_rows($rezultat) >= 1){
                echo "<p>Vec postoji namirnica sa tim imenom</p>";
            }
            else{
                mysqli_query($con, $upit);
                header('Location: index.php?p=2');
            }
        } else {
            echo "<p>Niste uneli podatke</p>";
        }
    }



    ?>
</div>