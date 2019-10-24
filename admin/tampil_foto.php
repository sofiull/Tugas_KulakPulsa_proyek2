<?php
	include 'config.php';
	$sql = "SELECT foto FROM users WHERE id = $id";
	$sth = $db->query($sql);
	$result=mysqli_fetch_array($sth);
	echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';
?>