<?php 
include 'config.php';
$id=$_POST['id'];
$operator=$_POST['operator'];
$penyedia=$_POST['penyedia'];
$nominal=$_POST['nominal'];
$harga=$_POST['harga'];

$updateKulak_Pulsa=mysqli_query($con,"UPDATE kulak_pulsa SET id_operator='$operator', id_penyedia='$penyedia' where id_kulakpulsa='$id'") or die(mysqli_error());
$updateDetail_Kulak_Pulsa=mysqli_query($con,"UPDATE detailkulakpulsa SET id_pulsa='$nominal', harga='$harga' where id_detailkulakpulsa='$id'") or die(mysqli_error());
header("location:data_pulsa.php");

?>