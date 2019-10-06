<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Pulsa</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$id_pulsa=mysqli_real_escape_string($con, $_GET['id']);


$det=mysqli_query($con, "select * from kulak_pulsa where id_kulakpulsa='$id_pulsa'")or die(mysqli_error());
while($d=mysqli_fetch_array($det)){
	?>					
	<table class="table">
		<tr>
			<td>Nama Operator</td>
			<td><?php echo $d['nama_operator'] ?></td>
		</tr>
		<tr>
			<td>Nama Penyedia</td>
			<td><?php echo $d['nama_penyedia'] ?></td>
		</tr>
		<tr>
			<td>Nominal</td>
			<td><?php echo $d['nominal'] ?></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>Rp.<?php echo number_format($d['harga']); ?>,-</td>
		</tr>
		<tr>
			<td>Publisher</td>
			<td><?php echo($d['publisher']) ?></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><?php echo $d['tanggal'] ?></td>
		</tr>
	</table>
	<?php 
}
?>
<?php include 'footer.php'; ?>