<?php 
include 'header.php';
?>

<?php
$lastUpdate= mysqli_query($con, "SELECT tanggal FROM kulak_pulsa ORDER BY tanggal DESC LIMIT 1");
$simpan;
?>

<div class="col-md-10">
	<h1>Selamat datang, </h1>
	<?php 
		while($data=mysqli_fetch_array($lastUpdate))
		{
			$simpan=$data['tanggal'];
	 ?>
	<h5>Update Terakhir: <?php echo $data['tanggal']?></h5>
<?php }?>
</div>
<br>
<br>
<div style="margin-top: 150px" class="col-md-12">
	<table align="center">
		<tr>
			<td>
				<?php 
					$check = true;
					$sql_hariIni=mysqli_query($con,"SELECT dp.harga FROM detailkulakpulsa dp,kulak_pulsa p where p.tanggal = Date(now()) AND dp.id_detailkulakpulsa = p.id_detailkulakpulsa ORDER BY dp.harga LIMIT 1");
					$sql_hariKemarin=mysqli_query($con,"SELECT dp.harga FROM detailkulakpulsa dp,kulak_pulsa p where p.tanggal = DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND dp.id_detailkulakpulsa = p.id_detailkulakpulsa ORDER BY dp.harga LIMIT 1");
					while ($data=mysqli_fetch_array($sql_hariIni)) {
						$data_hariIni = $data['harga'];
					}
					while ($data=mysqli_fetch_array($sql_hariKemarin)) {
						$data_hariKemarin = $data['harga'];
					}
					if($data_hariIni < $data_hariKemarin){
						$check=true;
					}else{
						$check=false;
					}
					if($check){
						echo "<font size='15'><a href='data_pulsa.php'> Ada harga pulsa yang lagi turun nih. Cek yuk</a></font>";
					}else
						echo "<font size='15'><a href='data_pulsa.php'> Udah Cek harga pulsa hari ini?</a></font>";
				?>
			</td>
		</tr>
	</table>
</div>

<?php 
include 'footer.php';
?>