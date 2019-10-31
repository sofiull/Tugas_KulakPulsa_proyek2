<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Harga Pulsa</h3>
<button style="margin-bottom:20px" class="btn btn-info col-md-2" onclick="window.location.href='importdata.php'"><span class="glyphicon glyphicon-plus"></span>Tambah / Import Data</button>
<br/>
<br/>

<!-- <?php 
$periksa=mysqli_query($con,"select * from barang where jumlah <=3");
while($q=mysqli_fetch_array($periksa)){	
	if($q['jumlah']<=3){	
		?>	
		<script>
			$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
		<?php
	}
}
?> -->

<?php 
$per_hal=10;
$jumlah_record=mysqli_query($con,"SELECT COUNT(*) from kulak_pulsa");
$jum=mysqli_fetch_row($jumlah_record);
$halaman=ceil($jum[0] / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	<table class="col-md-2">
		<tr>
			<td>Jumlah Record</td>		
			<td><?php echo $jum[0]; ?></td>
		</tr>
		<tr>
			<td>Jumlah Halaman</td>	
			<td><?php echo $halaman; ?></td>
		</tr>
	</table>
	<a style="margin-bottom:10px" href="print.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
</div>
<form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-2">Nama Operator</th>
		<th class="col-md-2">Nama Penyedia</th>
		<th class="col-md-1"><center>Nominal Pulsa</center></th>
		<th class="col-md-1"><center>Harga pulsa</center></th>
		<th class="col-md-1">Admin</th>
		<th class="col-md-1">tanggal</th>
		<th class="col-md-6"><center>Opsi</center></th>
	</tr>
	<?php 
	if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		// Test It:
		// select o.nama_operator from kulak_pulsa k inner join operator o ON k.id_operator= o.id_operator WHERE o.nama_operator like '$cari'
		$pls=mysqli_query($con, "SELECT DISTINCT k.id_kulakpulsa, o.nama_operator, p.namapenyedia,pl.nominal, dp.harga, u.username, k.tanggal FROM kulak_pulsa k , operator o , penyedia p , pulsa pl , infopenyedia ip , detailkulakpulsa dp , users u WHERE o.id_operator =k.id_operator AND k.id_penyedia = p.id_penyedia AND k.id_detailkulakpulsa = dp.id_detailkulakpulsa AND dp.id_detailkulakpulsa = pl.id_pulsa AND u.id_user = k.id_publisher AND nama_operator LIKE '%".$cari."%' OR namapenyedia LIKE '%".$cari."%'" );
	}else{
		$pls=mysqli_query($con,"SELECT DISTINCT k.id_kulakpulsa, o.nama_operator, p.namapenyedia,pl.nominal, dp.harga, u.username, k.tanggal FROM kulak_pulsa k , operator o , penyedia p , pulsa pl , infopenyedia ip , detailkulakpulsa dp , users u WHERE o.id_operator =k.id_operator AND k.id_penyedia = p.id_penyedia AND k.id_detailkulakpulsa = dp.id_detailkulakpulsa AND dp.id_detailkulakpulsa = pl.id_pulsa AND u.id_user = k.id_publisher ORDER BY dp.harga ASC LIMIT $start,$per_hal" );	
	}
	$no=1;
	while($b=mysqli_fetch_array($pls)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['nama_operator'] ?></td>
			<td><?php echo $b['namapenyedia']?></td>
			<td>Rp.<?php echo number_format( $b['nominal']) ?>,-</td>
			<td>Rp.<?php echo number_format( $b['harga']) ?>,-</td>
			<td><?php echo $b['username'] ?></td>
			<td><?php echo $b['tanggal'] ?></td>
			<td><center>
				<a href="det_pulsa.php?id=<?php echo $b['id_kulakpulsa']; ?>" class="btn btn-info">Detail</a>
				<a href="edit.php?id=<?php echo $b['id_kulakpulsa'] ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='hapus.php?id=<?php echo $b['id_kulakpulsa']; ?>' }" class="btn btn-danger">Hapus</a>
				</center>
			</td>
		</tr>		
		<?php 
	}
	?>
	<!-- <tr>
		<td colspan="4">Total Modal</td>
		<td>			
		<?php 
		
			$x=mysqli_query($con,"select sum(modal) as total from barang");	
			$xx=mysqli_fetch_array($x);			
			echo "<b> Rp.". number_format($xx['total']).",-</b>";		
		?>
		</td>
	</tr> -->
</table>
<ul class="pagination">			
			<?php 
			for($x=1;$x<=$halaman;$x++){
				?>
				<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>						
		</ul>




<?php 
include 'footer.php';

?>
