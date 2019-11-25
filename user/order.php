<?php
include 'config.php';
$no_tujuan=$_POST['nomor_tujuan'];
$no_penyedia=$_POST['no_penyedia'];
$nama_operator= $_POST['nama_operator'];
$nominal=$_POST['nominal'];
$harga=$_POST['harga'];

// wa.me/6281234604490?text=PULSA%205000%20indosat%2008122222222
$query="insert into orderList (link,status) values('wa.me/".$no_penyedia."?text=PULSA%20".$nominal."%20".$nama_operator."%20".$no_tujuan."','belum')";
$result=mysqli_query($con,$query);
if (! empty($result)) {
    header("location:data_pulsa.php");
} else {
    echo "Gagal";
}

?>