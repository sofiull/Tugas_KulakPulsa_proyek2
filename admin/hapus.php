<?php 
include 'config.php';
<<<<<<< HEAD
$id=$_GET['id_kulakpulsa'];
mysqli_query($con, "delete from kulak_pulsa where id_kulakpulsa='$id'");
=======
$id=$_GET['id'];
mysqli_query($con,"delete from kulak_pulsa where id_kulakpulsa='$id'");
>>>>>>> ffb75b13936169f03b004a68aa9e4ba2cd09a588
header("location:data_pulsa.php");

?>