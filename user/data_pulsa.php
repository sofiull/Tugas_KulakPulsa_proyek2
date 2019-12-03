<?php include 'header.php'; ?>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.js"></script>
  	<script src="https://drvic10k.github.io/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
</head>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Harga Pulsa</h3>
<!--<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah / Import Data</button>-->
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
// error_reporting(0);
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
		<input type="text" class="form-control" placeholder="Cari nama operator atau penyedia di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
<br/>
<table class="table table-striped table-bordered sortable">
	<thead>
		<tr>
			<th class="col-md-1">No</th>
			<th class="col-md-2">Nama Operator</th>
			<th class="col-md-2">Nama Penyedia</th>
			<th class="col-md-1"><center>Nominal Pulsa</center></th>
			<th class="col-md-1"><center>Harga pulsa</center></th>
			<!--<th class="col-md-1">Admin</th>-->
			<th class="col-md-1">tanggal</th>
			<th class="col-md-6"><center>Opsi</center></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if(isset($_GET['cari'])){
			$cari=$_GET['cari'];
			// Test It:
			// select o.nama_operator from kulak_pulsa k inner join operator o ON k.id_operator= o.id_operator WHERE o.nama_operator like '$cari'
			$pls=mysqli_query($con, "SELECT DISTINCT k.id_kulakpulsa, o.nama_operator, p.namapenyedia,pl.nominal, dp.harga, u.username, k.tanggal,ip.no_telp FROM kulak_pulsa k , operator o , penyedia p , pulsa pl , infopenyedia ip , detailkulakpulsa dp , users u WHERE o.id_operator =k.id_operator AND k.id_penyedia = p.id_penyedia AND k.id_detailkulakpulsa = dp.id_detailkulakpulsa AND dp.id_pulsa = pl.id_pulsa AND u.id_user = k.id_publisher AND nama_operator LIKE '%".$cari."%' OR namapenyedia LIKE '%".$cari."%'" );
		}else{
			$pls=mysqli_query($con,"SELECT DISTINCT k.id_kulakpulsa,k.id_penyedia, o.nama_operator, p.namapenyedia,pl.nominal, dp.harga, u.username, k.tanggal, ip.no_telp FROM kulak_pulsa k , operator o , penyedia p , pulsa pl , infopenyedia ip , detailkulakpulsa dp , users u WHERE o.id_operator =k.id_operator AND k.id_penyedia = p.id_penyedia AND k.id_detailkulakpulsa = dp.id_detailkulakpulsa AND dp.id_pulsa = pl.id_pulsa AND u.id_user = k.id_publisher AND k.id_penyedia = ip.id_infopenyedia ORDER BY dp.harga ASC LIMIT $start,$per_hal" );
		}
		$no=1;
		while($b=mysqli_fetch_array($pls)){

			?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $b['nama_operator'] ?></td>
				<td onclick="window.location.href='det_penyedia.php?id=<?php echo $b["id_penyedia"]; ?>'"><font style="color: green"><?php echo $b['namapenyedia']?></font></td>
				<td>Rp.<?php echo number_format( $b['nominal']) ?>,-</td>
				<td>Rp.<?php echo number_format( $b['harga']) ?>,-</td>
				<!--<td><?php echo $b['usernameAdmin'] ?></td>-->
				<td><?php echo $b['tanggal'] ?></td>
				<td>
					<center>
					<a href="det_pulsa.php?id=<?php echo $b['id_kulakpulsa']; ?>" class="btn btn-info">Detail</a>
					<?php 
						$temp_noTelpPenyedia=$b['no_telp'];
						$temp_namaOperator=$b['nama_operator'];
						$temp_nominal=$b['nominal'];
						$temp_harga=$b['harga'];
					?>
					<!-- <a href="https://wa.me/<?php echo $b['no_telp']?>?text=PULSA <?php echo $b['nominal']?> <?php echo $b['nama_operator']?>" class="btn btn-danger">Beli</a> -->
					<button data-toggle="modal" data-target="#myModal" class="btn btn-danger">Beli</button>
					</center>
				</td>
			</tr>		
			<?php 
		}
		?>
	<tbody>
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

<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-headesr">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Masukkan Nomor</h4>
			</div>
			<div class="modal-body">
				<form action="order.php" method="post">
					<div class="form-group">
						<label>Nomor Telpon Yang Dituju</label>
						<input name="nomor_tujuan" type="text" class="form-control" placeholder="08xxxxxxxxxx">
						<input name="no_penyedia" type="hidden" value="<?php echo $temp_noTelpPenyedia;?>">
						<input name="nama_operator" type="hidden" value="<?php echo $temp_namaOperator;?>">
						<input name="nominal" type="hidden" value="<?php echo $temp_nominal; ?>"> 
						<input name="harga" type="hidden" value="<?php echo $temp_harga; ?>">
					</div>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Beli">
				</div>
			</form>
		</div>
	</div>
</div>

<?php 
include 'footer.php';

?>
