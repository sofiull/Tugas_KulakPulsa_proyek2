<?php 
include 'config.php';
$user=$_POST['user'];
$lama=$_POST['lama'];
$baru=$_POST['baru'];
$ulang=$_POST['ulang'];

$cek=mysqli_query($con,"select * from user where password='$lama' and username='$user'");
if(mysqli_num_rows($cek)==1){
	if($baru==$ulang){
		$b = ($baru);
		mysqli_query($con,"update user set password='$b' where username='$user'");
		//echo "<div class='alert alert-success'>Password berhasil di ganti!</div>";
		header("location:ganti_pass.php?pesan=oke");
	}else{
		//echo "<div class='alert alert-danger'>Password masih sama dengan sebelumnya, silahkan diganti!</div>";
		header("location:ganti_pass.php?pesan=tdksama");
	}
}else{
	//echo "<div class='alert alert-danger'>Password gagal di ganti !!     Periksa Kembali Password yang anda masukkan !!</div>";
	header("location:ganti_pass.php?pesan=gagal");
}

 ?>