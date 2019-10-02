<?php 
session_start();
include 'admin/config.php';
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$jenisUser=$_POST['jenisUser'];
$pas=md5($pass);
if ($jenisUser == "admin") {
	$query=mysqli_query($con,"select * from admin where usernameAdmin='$uname' and passwordAdmin='$pass'")or die(mysqli_error());
}else{
	$query=mysqli_query($con,"select * from user where username='$uname' and password='$pass'")or die(mysqli_error());
}

if(mysqli_num_rows($query)==1){
	if($jenisUser == "admin"){
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
