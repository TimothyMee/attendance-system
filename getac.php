<?php
		
if (isset($_GET['vc']) && !empty($_GET['vc'])) {
	
	include 'include/DB.php';
 include 'include/queries.php';
	$queriesObject = new queries();

	$data = $queriesObject->getDeviceAcSn($_GET['vc']);
	
	echo $data[0]['ac'].$data[0]['sn'];
	
}

?>