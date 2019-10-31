<?php 
include 'header.php';
?>

<?php
$lastUpdate= mysqli_query($con, "SELECT tanggal FROM kulak_pulsa ORDER BY tanggal ASC LIMIT 1");
?>

<div class="col-md-10">
	<h1>Selamat datang, </h1>
	<?php 
		while($data=mysqli_fetch_array($lastUpdate))
		{
	 ?>
	<h5>Update Terakhir: <?php echo $data['tanggal']?></h5>
<?php }?>
</div>
<!-- kalender -->
<div class="pull-right">
	<div id="kalender"></div>
</div>

<?php 
include 'footer.php';
?>