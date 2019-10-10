<?php 
include 'config.php';
$id=$_GET['id_kulakpulsa'];
mysqli_query($con, "delete from kulak_pulsa where id_kulakpulsa='$id'");
header("location:data_pulsa.php");

?>