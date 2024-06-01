<?php
	require_once("../../config/config.database.php");
	$token = mysqli_fetch_array(mysqli_query($koneksi, "select token from token"));
	echo $token['token'];
?>