<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Pulsa</h3>
<a class="btn" href="data_pulsa.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$id_pulsa=mysqli_real_escape_string($con, $_GET['id']);


$det=mysqli_query($con, "SELECT DISTINCT k.id_kulakpulsa, o.nama_operator,p.namapenyedia,pl.nominal, dp.harga, a.usernameAdmin, k.tanggal FROM kulak_pulsa k , operator o , penyedia p , pulsa pl , infopenyedia ip , detailkulakpulsa dp , admin a WHERE o.id_operator =k.id_operator AND k.id_penyedia = p.id_penyedia AND k.id_detailkulakpulsa = dp.id_detailkulakpulsa")or die(mysqli_error());
while($d=mysqli_fetch_array($det)){
	?>					
	<table class="table">
		<tr>
			<td>Nama Operator</td>
			<td><?php echo $d['nama_operator'] ?></td>
		</tr>
		<tr>
			<td>Nama Penyedia</td>
			<td><?php echo $d['namapenyedia'] ?></td>
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
			<td><?php echo($d['usernameAdmin']) ?></td>
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