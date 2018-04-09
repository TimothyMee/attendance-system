<?php

if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
	
	include 'include/DB.php';
	 include 'include/queries.php';
	
	$queriesObject = new queries();

	$user_id 	= $_GET['user_id'];
	$finger		= $queriesObject->getUserFinger($user_id);
	$time_limit_ver = "10";
	$base_path = 'http://localhost/myWork/fingerprintSample/code/';


    echo "$user_id;".$finger[0]['finger_data'].";SecurityKey;".$time_limit_ver.";".$base_path."process_verification.php;".$base_path."getac.php".";extraParams";

    /*	echo "$user_id;".$finger[0]['finger_data'].";SecurityKey;".$time_limit_ver.";"."process_verification.php;"."getac.php".";extraParams";*/
}

?>