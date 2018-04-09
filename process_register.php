<?php

if (isset($_POST['RegTemp']) && !empty($_POST['RegTemp'])) {
		
    	include 'include/DB.php';
		 include 'include/queries.php';

		 $queriesObject = new queries();
		
		$data 		= explode(";",$_POST['RegTemp']);
		$vStamp 	= $data[0];
		$sn 		= $data[1];
		$user_id	= $data[2];
		$regTemp 	= $data[3];
		
		$device = $queriesObject->getDeviceBySn($sn);
		
		$salt = md5($device[0]['ac'].$device[0]['vkey'].$regTemp.$sn.$user_id);
		
		if (strtoupper($vStamp) == strtoupper($salt)) {

		    $result1       = $queriesObject->selectCountOfExistingFinger($user_id);
			/*$sql1 		= "SELECT MAX(finger_id) as fid FROM demo_finger WHERE user_id=".$user_id;
			$result1 	= mysql_query($sql1);
			$data 		= mysql_fetch_array($result1);
			$fid 		= $data['fid'];*/

            $fid 		= $result1['ct'];
			
			if ($fid == 0) {
			    $fingerData = [
			            'user_id' => $user_id,
                        'finger_id' => $fid+1,
                        'finger_data' => $regTemp
                ];
			    $results2   = $queriesObject->insertFingerData($fingerData);

				/*$sq2 		= "INSERT INTO demo_finger SET user_id='".$user_id."', finger_id=".($fid+1).", finger_data='".$regTemp."' ";
				$result2	= mysql_query($sq2);*/

				if ($result2) {
					$res['result'] = true;				
				} else {
					$res['server'] = "Error insert registration data!";
				}
			} else {
				$res['result'] = false;
				$res['user_finger_'.$user_id] = "Template already exist.";
			}
			
			echo "empty";
			
		} else {
			
			$msg = "Parameter invalid..";
			
			echo "messages.php?msg=$msg";
			
		}

		
}

?>