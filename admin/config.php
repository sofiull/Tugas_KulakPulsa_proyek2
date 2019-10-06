<?php 
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con, "kulak_pulsa");
$operator=mysqli_query($con,"SELECT * FROM operator")or die(mysqli_error());// mysqli_error() expects exactly 1 parameter, 0 given
$penyedia=mysqli_query($con,"SELECT * FROM penyedia")or die(mysqli_error());
$pulsa=mysqli_query($con,"SELECT * FROM pulsa")or die(mysqli_error());
$nominalPulsa=mysqli_query($con,"SELECT * FROM pulsa")or die(mysqli_error());

?>
