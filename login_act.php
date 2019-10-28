<?php 
session_start();
include 'admin/config.php';
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$jenisUser=$_POST['jenisUser'];
$pas=sha1($pass);
if ($jenisUser == "1") {
	$query=mysqli_query($con,"select * from users where username='$uname' and password='$pas' and status='Admin'")or die(mysqli_error());
}else{
	$query=mysqli_query($con,"select * from users where username='$uname' and password='$pas' and status='User'")or die(mysqli_error(.
		''));
}

if(mysqli_num_rows($query)==1){
	if($jenisUser == "1"){
		$_SESSION['uname']=$uname;
		header("location:admin/index.php");
	}else{
		$_SESSION['uname']=$uname;
		header("location:user/index.php");
	}
}else{
	header("location:index.php?pesan=gagal")or die(mysqli_error());
	// mysql_error();
}
// echo $pas;
 ?>
