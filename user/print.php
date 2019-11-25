<?php
include '../admin/config.php';
session_start();
$database=mysqli_query($con, "SELECT DISTINCT k.id_kulakpulsa, o.nama_operator, p.namapenyedia,pl.nominal, dp.harga, u.username, k.tanggal FROM kulak_pulsa k , operator o , penyedia p , pulsa pl , infopenyedia ip , detailkulakpulsa dp , users u WHERE o.id_operator =k.id_operator AND k.id_penyedia = p.id_penyedia AND k.id_detailkulakpulsa = dp.id_detailkulakpulsa AND dp.id_detailkulakpulsa = pl.id_pulsa AND u.id_user = k.id_publisher");
$data_penyedia=mysqli_query($con, "SELECT DISTINCT namapenyedia FROM penyedia");
$today = date("d/m/Y");
$operatorLen = 10;
$nominalLen = 8;
$hargaLen = 6;
$cetakan="Cetakan Tanggal: ".$today;
// echo "Cetakan Tanggal:".$today."\n";
shell_exec("echo ".$cetakan." >> /dev/usb/lp0");
shell_exec("echo $'".$_SESSION['uname']." \n' >> /dev/usb/lp0");
while ($datapenyedia=mysqli_fetch_array($data_penyedia)){
	shell_exec("echo $'>".$datapenyedia["namapenyedia"]." \n' >> /dev/usb/lp0");
	shell_exec("echo $'| Operator | Nominal | Harga|' >> /dev/usb/lp0");
	shell_exec("echo $' ---------------------------- ' >> /dev/usb/lp0");

	// mengeluarkan data dalam tabel
	while($row=mysqli_fetch_array($database)){
		// Jumlah string dari database
		$operator=strlen($row["nama_operator"]);
		$nominal=strlen($row["nominal"]);
		$harga=strlen($row["harga"]);

		// Mengambil data pada database
		$namaOperator=$row["nama_operator"];
		$totalNominal=$row["nominal"];
		$totalHarga=$row["harga"];

		// echo "<table width='300px' border='1'>
		// 		<thead>
		// 		<tr>
		// 			<td width='200px'><center>aw</center></td>
		// 			<td width='100px'>aw</td>
		// 			<td width='100px'>aw</td>
		// 		</tr>
		// 	 	<tr>
		// 	 		<td><center>".$namaOperator."</center></td>".
		// 	 		"<td>".$totalNominal."</td>".
		// 	 		"<td>".$totalHarga."</td>
		// 	 	</tr>".
		// 	  "</table>";

	// Simpannn !!!
		// variable untuk while
		$i=0;
		// tambah karakter spasi di kiri
		while ($i < ($operatorLen - $operator)/2){
			$namaOperator="&nbsp".$namaOperator."&nbsp";
			$i++;
			// shell_exec("echo $'| ".$namaOperator." | ".$totalNominal." | ".$totalHarga."|' >> /dev/usb/lp0");
		}
		$i=0;
		while ($i < ($nominalLen - $nominal)%2){
			$totalNominal=" &nbsp".$totalNominal;
			$i++;
		}
		$i=0;	
		while ($i < ($hargaLen - $harga)%2){
			$totalHarga="&nbsp".$totalHarga;
			$i++;
			// shell_exec("echo $'| ".$namaOperator." | ".$totalNominal." | ".$totalHarga."|' >> /dev/usb/lp0");
		}

		// tambah karakter spasi di kanan
		$i=0;
		while ($i < ($operatorLen - $operator)%2){
			$namaOperator=$namaOperator."&nbsp";
			$i++;
			// shell_exec("echo $'| ".$namaOperator." | ".$totalNominal." | ".$totalHarga."|' >> /dev/usb/lp0");
		}
		$i=0;
		while ($i < ($nominalLen - $nominal)%2){
			$totalNominal=$totalNominal."&nbsp";
			$i++;
			// shell_exec("echo $'| ".$namaOperator." | ".$totalNominal." | ".$totalHarga."|' >> /dev/usb/lp0");
		}
		$i=0;
		while ($i < ($hargaLen - $harga)%2){
			$totalHarga=$totalHarga."&nbsp";

			$i++;
			// shell_exec("echo $'| ".$namaOperator." | ".$totalNominal." | ".$totalHarga."|' >> /dev/usb/lp0");
		}
		//for ($i=0; $i < $operarotLen-$operator; $i++) {
		//	$namaOperator="&nbsp".$namaOperator;
		//	shell_exec("echo $'| ".$namaOperator." | ". $row["nominal"]." | ". $row["harga"]."|' >> /dev/usb/lp0");
		//}
		echo $namaOperator."|".$totalNominal."|".$totalHarga."|"."<br>";
	}
	
	shell_exec("echo '\n' >> /dev/usb/lp0");
}
// $teks="aw";
// shell_exec("echo $'@teks' >> /dev/usb/lp0");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<h3>Printing...</h3>
</body>
</html>