<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shoping lista</title>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style2.css">
</head>
<body>

<div class="glavni">
    <div class="sadrzaj">
        <h1>Dodaj u soping listu</h1>
        <a href='index.php'>Glavna stranica</a>
        <a href='novalista.php'>Dodaj Listu</a>
        <a href='informacije.php'>O nama</a>
        <a href='kontakt.php'>Kontakt</a><br>
        <form method='post' action='add.php'>
            <p class="tekst">Namirnica</p>
            <select name="namirnica" id="namirnice">
                <option value="choose">Izaberi</option>
            <?php
            include 'db_config.php';
            //ucitavanje namirnica u drop listu
            $komanda = "SELECT Naziv FROM namirnice ORDER BY Naziv ASC";
            $rezultat = mysqli_query($con,$komanda);

            if(mysqli_num_rows($rezultat) > 0)
            {
                while($row = mysqli_fetch_assoc($rezultat)) {
                    echo "<option value='" . $row['Naziv'] . "'>" . $row['Naziv'] . "</option>";
                }}
            else{
                echo "<option value='nema'>Nema namirnica</option>";
            }
            ?>
            </select>
            <br>
            <p class="tekst">Lista</p>
            <select name="lista" id="liste">
                <option value="choose">Izaberi</option>
                <?php
                //ucitavanje listi u drop listu
                include 'db_config.php';
                $komanda = "SELECT Naziv FROM liste ORDER BY Naziv ASC";
                $rezultat = mysqli_query($con,$komanda);

                if(mysqli_num_rows($rezultat) > 0)
                {
                    while($row = mysqli_fetch_assoc($rezultat)) {
                        echo "<option value='" . $row['Naziv'] . "'>" . $row['Naziv'] . "</option>";
                    }}
                else{
                    echo "<option value='nema'>Nema listi</option>";
                }

                ?>
            </select>
            <br><label for="kolicina" class="tekst">Kolicina </label><input type="number" min="1" max="100" value="1" name="kolicina" id="kolicina">
            <br>
            <input type="submit" name="submit" value="Dodaj">
        </form>
        <?php
        if(isset($_POST['submit'])){
            //Unosenje namirnica u listu koju smo odabrali
            //Ukoliko proizvod vec postoji u listi, nece dodati novi proizvod nego ce samo povecati kolicinu
            if($_POST['lista'] != "choose" and $_POST['namirnica'] != "choose" and isset($_POST['kolicina']))
            {
                $lista = mysqli_real_escape_string($con,$_POST['lista']);
                $namirnica = mysqli_real_escape_string($con,$_POST['namirnica']);
                $kolicina = (int)mysqli_real_escape_string($con,$_POST['kolicina']);
                $unos = "INSERT INTO listenamirnica(namirnica_id, lista_id, kolicina) VALUES ((SELECT id_namirnice FROM namirnice WHERE Naziv = '$namirnica'),(SELECT id_liste FROM liste WHERE Naziv = '$lista'),$kolicina)";

                $provera = "SELECT namirnice.id_namirnice as id_namirnice, liste.id_liste as id_liste FROM listenamirnica LEFT JOIN namirnice ON listenamirnica.namirnica_id = namirnice.id_namirnice LEFT JOIN liste ON listenamirnica.lista_id = liste.id_liste WHERE liste.Naziv = '$lista' AND namirnice.Naziv = '$namirnica'";
                $izmena = "UPDATE listenamirnica SET kolicina = kolicina + $kolicina WHERE namirnica_id = (SELECT id_namirnice FROM namirnice WHERE Naziv = '$namirnica') and lista_id = (SELECT id_liste FROM liste WHERE Naziv = '$lista')";
                $rez = mysqli_query($con,$provera);
                if(mysqli_num_rows($rez) > 0){
                    mysqli_query($con,$izmena);
                }
                else
                {
                mysqli_query($con,$unos);
                }

                header("Location: index.php?p=2");
            }
            else
            {
            echo "<br><p class='tekst'>Niste uneli podatke</p>";
            }
        }
        ?>
</div>
</body>
</html>
