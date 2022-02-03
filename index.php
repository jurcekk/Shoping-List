<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shoping lista</title>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle&display=swap" rel="stylesheet">
</head>
<body>
<div class="glavni">
<div class="naziv">
    <h1>Soping lista: &nbsp;<?php
        if(isset($_POST['liste'])){
    if($_POST['liste'] != "choose" and $_POST['liste'] != "nema")
    {
        echo $_POST['liste'];
    }}
    ?></h1>
    <a href='add.php'>Dodaj proizvod</a>
    <a href='novalista.php'>Dodaj Listu</a>
    <a href='informacije.php'>O nama</a>
    <a href='kontakt.php'>Kontakt</a>
        <form method='post' action="index.php">
            <p class="tekst">Sacuvane liste &nbsp;</p>
    <select name="liste" id="liste">
    <option value='choose'>choose</option>
   <?php
   include 'db_config.php';
        //ucitavanje imena listi u drop listu
        $komanda = "SELECT Naziv FROM liste ORDER BY Naziv ASC";
        $rezultat = mysqli_query($con, $komanda);

        if(mysqli_num_rows($rezultat) > 0)
        {
            while($row = mysqli_fetch_assoc($rezultat)) {
                echo "<option value='" . $row['Naziv'] . "'>" . $row['Naziv'] . "</option>";
            }}
        else{
            echo "<option value='nema'>nema sacuvanih listi</option>";
        }
    ?>
</select>&nbsp;
            <input type="submit" name="submit" value="Ispisi">
            <input type="submit" name="delete" value="Izbrisi"><br>
            <label for="naziv" class="tekst">Pretrazi listu &nbsp;</label><input type="text" name="naziv" id="naziv" maxlength="30">
            <input type="submit" name="pretraga" value="Pretraga">
    </form>

</div>
    <?php
    if(isset($_GET['p']))
    {
        //Ispis poruka u zavisnosti od funkcije
        if((int)$_GET['p'] == 1)
        {
            echo "<p class='poruka'>Uspesno obrisano!</p>";
        }
        if((int)$_GET['p'] == 2)
        {
            echo "<p class='poruka'>Uspesno izmenjeno!</p>";
        }

        if((int)$_GET['p'] == 3)
        {
            echo "<p class='poruka'>Uspesno uneta lista!</p>";
        }
    }
    ?>
    <div class="sadrzaj">
        <?php
        //Ispis liste
        if(isset($_POST['submit'])){
        if($_POST['submit'] == "Ispisi"){

        if($_POST['liste'] != "choose"){
            $lista = mysqli_real_escape_string($con,$_POST['liste']);
            $komanda2 = "SELECT listenamirnica.namirnica_id as namirnica_id, listenamirnica.lista_id as lista_id, namirnice.Naziv as Naziv, listenamirnica.kolicina as Kolicina, namirnice.Slika as Slika  FROM namirnice LEFT JOIN listenamirnica on namirnice.id_namirnice = listenamirnica.namirnica_id LEFT JOIN liste on listenamirnica.lista_id = liste.id_liste WHERE liste.Naziv = '$lista'";
            $rezultat2 = mysqli_query($con,$komanda2);

            if(mysqli_num_rows($rezultat2) > 0)
            {
                while($row2 = mysqli_fetch_assoc($rezultat2)){
                    $lista_id = $row2['lista_id'];
                    $namirnica_id = $row2['namirnica_id'];
                echo "<div class='kontener'> <h1>" .$row2['Naziv'] . "</h1><h2>Kolicina: " . $row2['Kolicina'] . "</h2><img src='Slike/".$row2['Slika']."' height='100' width='100'><a href='update.php?lista_id=$lista_id&namirnica_id=$namirnica_id'>Izmeni</a><a href='delete.php?lista_id=$lista_id&namirnica_id=$namirnica_id'>Obrisi</a></div>";
                }
            }
        }
        else{
            echo "<p style='font-size: 2rem;color: #f00;'>Niste izabrali listu </p>";
        }}}
        //Pretrazivanje proizvoda unutar liste
        if(isset($_POST['pretraga']) and $_POST['pretraga'] == "Pretraga")
        {
            $lista = mysqli_real_escape_string($con,$_POST['liste']);
            $naziv = mysqli_real_escape_string($con,$_POST['naziv']);
            $pretraga = "SELECT listenamirnica.namirnica_id as namirnica_id, listenamirnica.lista_id as lista_id, namirnice.Naziv as Naziv, listenamirnica.kolicina as Kolicina, namirnice.Slika as Slika  FROM namirnice LEFT JOIN listenamirnica on namirnice.id_namirnice = listenamirnica.namirnica_id LEFT JOIN liste on listenamirnica.lista_id = liste.id_liste WHERE liste.Naziv = '$lista' AND namirnice.Naziv LIKE '%$naziv%'";

            if($lista != "choose")
            {


            $rezultat3 = mysqli_query($con,$pretraga);

            if(mysqli_num_rows($rezultat3) > 0)
            {
                while($row3 = mysqli_fetch_assoc($rezultat3)){
                    $lista_id = $row3['lista_id'];
                    $namirnica_id = $row3['namirnica_id'];
                    echo "<div class='kontener'> <h1>" .$row3['Naziv'] . "</h1><h2>Kolicina: " . $row3['Kolicina'] . "</h2><img src='Slike/".$row3['Slika']."' height='100' width='100'><a href='update.php?lista_id=$lista_id&namirnica_id=$namirnica_id'>Izmeni</a><a href='delete.php?lista_id=$lista_id&namirnica_id=$namirnica_id'>Obrisi</a></div>";
                }
            }
            else
            {
                echo "<p class='poruka'>Trazeni proizvod nije na listi!</p>";
            }}
            else
            {
                echo "<p class='poruka'>Niste izabrali listu!</p>";
            }
        }

        ?>
        <?php
        //brisanje liste
        if(isset($_POST['delete'])){
        if($_POST['delete'] == "Izbrisi"){
            $lista = mysqli_real_escape_string($con,$_POST['liste']);
            if($lista != "choose"){

            $komanda3 = "DELETE FROM listenamirnica WHERE lista_id = (SELECT id_liste FROM liste WHERE Naziv = '$lista')";
            mysqli_query($con,$komanda3);
            $komanda4 = "DELETE FROM liste WHERE Naziv = '$lista'";
            mysqli_query($con,$komanda4);

            header('Location: index.php?p=1');}
            else
            {
                header('Location: index.php');
            }
        }
        }
        ?>
    </div>
</div>
</body>
</html>
