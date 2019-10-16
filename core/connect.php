<?php 

	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'crud_pro';

	$conn = mysqli_connect($host,$user,$pass,$db);
	if(!$conn){
		die('ada error' . mysqli_connect_error());
	}

?>