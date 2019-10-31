<?php
include '../admin/config.php';
session_start();
$database=mysqli_query($con, "SELECT DISTINCT k.id_kulakpulsa, o.nama_operator, p.namapenyedia,pl.nominal, dp.harga, u.username, k.tanggal FROM kulak_pulsa k , operator o , penyedia p , pulsa pl , infopenyedia ip , detailkulakpulsa dp , users u WHERE o.id_operator =k.id_operator AND k.id_penyedia = p.id_penyedia AND k.id_detailkulakpulsa = dp.id_detailkulakpulsa AND dp.id_detailkulakpulsa = pl.id_pulsa AND u.id_user = k.id_publisher");
$data_penyedia=mysqli_query($con, "SELECT DISTINCT namapenyedia FROM penyedia");
$today = date("d/m/Y");
$cetakan="Cetakan Tanggal: ".$today;
// echo "Cetakan Tanggal:".$today."\n";
shell_exec("echo ".$cetakan." >> /dev/usb/lp0");
shell_exec("echo $'".$_SESSION['uname']." \n' >> /dev/usb/lp0");
while ($datapenyedia=mysqli_fetch_array($data_penyedia)){
	shell_exec("echo $'>".$datapenyedia["namapenyedia"]." \n' >> /dev/usb/lp0");
	shell_exec("echo $'| Operator | Nominal | Harga |' >> /dev/usb/lp0");
	while($row=mysqli_fetch_array($database)){
		shell_exec("echo $'| ".$row["nama_operator"]." | ".$row["nominal"]." | ".$row["harga"]." |' >> /dev/usb/lp0");
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