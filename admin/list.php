<div id="sadrzaj">
    <h1>Lista namirnica</h1>
<?php
@require 'db_config.php';
$upit = "SELECT * FROM namirnice ORDER BY Naziv ASC";

$rezultat = mysqli_query($con,$upit);
if(mysqli_num_rows($rezultat) > 0)
{
    $no = 1;
    echo '<table>';
    echo '<tr><th>No.</th><th>Ime</th><th>Slika</th><th>Operacija</th></tr>';
while($red = mysqli_fetch_assoc($rezultat))
{
    echo '<td>'.$no.'.</td><td>'.$red['Naziv'].'</td><td><img src="../Slike/'.$red['Slika'].'" alt="'.$red['Slika'].'" width="100" /></td>';
    echo '<td>
           <a href="index.php?p=4&amp;id='.$red['id_namirnice'].'">obrisi</a> |
           <a href="index.php?p=3&amp;id='.$red['id_namirnice'].'">izmeni</a>
           </td>';
    echo "</tr>";
    $no++;
}
    echo '</table>';
}
?>
</div>

