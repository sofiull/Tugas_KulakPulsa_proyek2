<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Tambah Data Pulsa</h3>
<a class="btn" href="data_pulsa.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>			
	<form action="tmb_brg_act.php" method="post">
		<table class="table">
			<tr>
				<tr>
				<td>Nama Operator</td>
				<td>
					<select name="operator" class="form-control">
						<?php
							while ($pe=mysqli_fetch_array($operator)) { ?>
								<option value="<?php echo $pe['id_operator'] ?>"><?php echo $pe['nama_operator'];?></option>;
						<?
							}
						?>
					</select>
				</td>
			</tr>
			</tr>
			<tr>
				<td>Nama Penyedia</td>
				<td>
					<select name="penyedia" class="form-control">
						<?php
							while ($pe=mysqli_fetch_array($penyedia)) { ?>
								<option value="<?php echo $pe['id_penyedia'] ?>"><?php echo $pe['namapenyedia'];?></option>;
						<?
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nominal</td>
				<td>
					<select name="nominal" class="form-control">
						<?php
							while ($np=mysqli_fetch_array($nominalPulsa)) { ?>
								<option value="<?php echo $np['id_pulsa'] ?>"><?php echo $np['namapulsa'];?> -> Rp.<?php echo number_format ($np['nominal'])?></option>;
						<?
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="text" class="form-control" name="harga"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>
	<?php 

?>
<?php include 'footer.php'; ?>