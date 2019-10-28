<?php 
include 'header.php';
?>

<?php
$con=mysqli_connect("localhost","root",""); 
$a = mysqli_query($con,"select * from barang_laku");
$sql= mysqli_query($con, "SELECT * FROM kulak_pulsa ORDER BY tanggal ASC LIMIT 1");
$row= mysqli_fetch_assoc($sql);

echo exec('dir');
?>

<div class="col-md-10">
	<h1>Selamat datang</h1>
	<h3>Update Terakhr: </h3>	
	<h3><?php echo $row['date']?></h3>
</div>
<!-- kalender -->
<div class="pull-right">
	<div id="kalender"></div>
</div>

<?php 
include 'footer.php';

?>