<?php
define("HOST","localhost");
define("USER","david");
define("PASSWORD","root");
define("DATABASE","it");



$con = mysqli_connect(HOST,USER,PASSWORD,DATABASE);
mysqli_query($con, "SET NAMES utf8") or die (mysqli_error($con));
mysqli_query($con, "SET CHARACTER SET utf8") or die (mysqli_error($con));
mysqli_query($con, "SET COLLATION_CONNECTION='utf8_general_ci'") or die (mysqli_error($con));
?>