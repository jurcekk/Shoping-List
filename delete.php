<?php
include 'db_config.php';
//brisanje stavki u listi
if(isset($_GET['lista_id']) and isset($_GET['namirnica_id'])) {
    $lista_id = (int)mysqli_real_escape_string($con,$_GET['lista_id']);
    $namirnica_id = (int)mysqli_real_escape_string($con,$_GET['namirnica_id']);
    $komanda = "DELETE FROM listenamirnica WHERE namirnica_id = $namirnica_id and lista_id = $lista_id";
    mysqli_query($con,$komanda);

    header('Location: index.php?p=1');
}
?>