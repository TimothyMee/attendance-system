<?php
	
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
	
	include 'include/DB.php';
	 include 'include/queries.php';

	$user_id 	= $_GET['user_id'];

	$time_limit_reg = "15";
	$base_path = 'http://localhost/myWork/fingerprintSample/code/';
	echo "$user_id;SecurityKey;".$time_limit_reg.";".$base_path."process_register.php;".$base_path."getac.php";

	/*echo "$user_id;SecurityKey;".$time_limit_reg.";"."process_register.php;"."getac.php";*/
	
}

?>