<?php

	/**
	* 
	*/
	class queries extends DB
	{

	function __construct()
        {
            $dbconn = DB::getInstance();

            $currentTime = new DateTime();

            $sql = "SELECT * FROM passcode WHERE status=0";
            $final = $dbconn->pdo->prepare($sql);
            $final->execute();

            while($result = $final->fetch()){
                $oldTime = new DateTime($result['created_at']);
                $timeDiff = $currentTime->diff($oldTime);

                $minutes = $timeDiff->days * 24 * 60;
                $minutes += $timeDiff->h * 60;
                $minutes += $timeDiff->i;

                if ($minutes > 10){
                    $sql2 = "UPDATE passcode SET status=1 WHERE id=".$result['id'];
                    $final2 = $dbconn->pdo->prepare($sql2);
                    $final2->execute();
                }
            }


        }

    function getDevice() {

		$dbconn = DB::getInstance();
		$sql 	= 'SELECT * FROM device ORDER BY device_name ASC';

		try {
			$final = $dbconn->pdo->prepare($sql);
			$final->execute();

			$arr 	= array();
			$i 	= 0;

			while ($row = $final->fetch(PDO::FETCH_ASSOC)) {

				$arr[$i] = array(
					'device_name'	=> $row['device_name'],
					'sn'		=> $row['sn'],
					'vc'		=> $row['vc'],
					'ac'		=> $row['ac'],
					'vkey'		=> $row['vkey']
				);

				$i++;

			}

			return $arr;
		} 
		catch (Exception $e) {
			
		}
	}
	
	function getDeviceAcSn($vc) {
		$dbconn = DB::getInstance();
		$sql 	= "SELECT * FROM device WHERE vc ='".$vc."'";

		try {
			$final = $dbconn->pdo->prepare($sql);
			$final->execute();

            $i 	= 0;
			while ($row = $final->fetch(PDO::FETCH_ASSOC)) {

				$arr[$i] = array(
					'device_name'	=> $row['device_name'],
					'sn'		=> $row['sn'],
					'vc'		=> $row['vc'],
					'ac'		=> $row['ac'],
					'vkey'		=> $row['vkey']
				);

				$i++;

			}

			return $arr;
		} 
		catch (Exception $e) {
			
		}

	}
	
	function getDeviceBySn($sn) {
        $dbconn = DB::getInstance();

		$sql 	= "SELECT * FROM device WHERE sn ='".$sn."'";
		try {
			$final = $dbconn->pdo->prepare($sql);
			$final->execute();

            $i 	= 0;
			while ($row = $final->fetch(PDO::FETCH_ASSOC)) {

				$arr[$i] = array(
					'device_name'	=> $row['device_name'],
					'sn'		=> $row['sn'],
					'vc'		=> $row['vc'],
					'ac'		=> $row['ac'],
					'vkey'		=> $row['vkey']
				);

				$i++;

			}

			return $arr;
		} 
		catch (Exception $e) {
			
		}


	}

	function getUser() {
		$dbconn = DB::getInstance();

		$sql 	= 'SELECT * FROM users ORDER BY user_name ASC';
		try {
			$final = $dbconn->pdo->prepare($sql);
			$final->execute();

			$arr 	= array();
			$i 	= 0;

			while ($row = $final->fetch(PDO::FETCH_ASSOC)) {

				$arr[$i] = array(
					'user_id'	=> $row['user_id'],
					'user_name'	=> $row['user_name']
				);

				$i++;

			}

		return $arr;

		}
		catch(Exception $e)
		{

		}	

	}

	function deviceCheckSn($sn) {

		$dbconn = DB::getInstance();

		$sql 	= "SELECT count(sn) as ct FROM device WHERE sn = '".$sn."'";
		try {
			$final = $dbconn->pdo->prepare($sql);
			$final->execute();
			
			$data = $final->fetch();
		 	
			if ($data['ct'] != '0' && $data['ct'] != '') {
				return "sn already exist!";
			} else {
				return 1;
			}
		}
		catch (Exception $e) {
			
		}

	}

	function insertNewDevice($data){
		$dbconn = DB::getInstance();

		$sql 	= "INSERT INTO device SET device_name='".$data['device_name']."', sn='".$data['sn']."', vc='".$data['vc']."', ac='".$data['ac']."', vkey='".$data['vkey']."' ";

		try {
			$final = $dbconn->pdo->prepare($sql);
			$result = $final->execute();
			return true;
		}
		catch (Exception $e) {
			return false;
		}
	}

	function deleteNewDevice($data){
		$dbconn = DB::getInstance();
		
		$sql = "DELETE FROM device WHERE sn = '".$data['sn']."' ";

		try {
			$final = $dbconn->pdo->prepare($sql);
			$result = $final->execute();
			return true;
		}
		catch (Exception $e) {
			return false;
		}
	}

	function checkUserName($user_name) {
		$dbconn = DB::getInstance();

		$sql	= "SELECT user_name FROM users WHERE user_name = '".$user_name."'";
		try {
			$final = $dbconn->pdo->prepare($sql);
			$final->execute();

			if ($final->fetch()) {
				return "Username exist!";
			} else {
				return "1";
			}
		}
		catch (Exception $e) {
			return false;
		}

	}

	function selectUser($data)
	{
        $dbconn = DB::getInstance();
		$sql = "SELECT * FROM users WHERE user_id='".$data."'";

		try {
			$final = $dbconn->pdo->prepare($sql);
			$final->execute();

			if ($result = $final->fetch()) {
				return $result;
			} else {
				return;
			}
		}
		catch (Exception $e) {
			return false;
		}
	}

	function insertNewUser($data)
	{
		$dbconn = DB::getInstance();

		$sql 	= "INSERT INTO users SET user_name='".$data['user_name']."', email= '".$data['email']."', telephone='".$data['telephone']."'";

		try {
			$final = $dbconn->pdo->prepare($sql);
			$result = $final->execute();
			return true;
		}
		catch (Exception $e) {
			return false;
		}
	}

	function insertFingerData($data)
    {
        $dbconn = DB::getInstance();

        $sql = "INSERT INTO finger SET user_id='".$data['user_id']."', finger_id=".$data['finger_id'].", finger_data='".$data['finger_data']."' ";

        try{
            $final = $dbconn->pdo->prepare($sql);
            $final->execute();

            echo http_redirect('http://localhost/myWork/fingerprintSample/code/timothy.php');
        }catch (Exception  $e){
            return false;
        }
    }

	function getUserFinger($user_id) {

		$dbconn = DB::getInstance();

		$sql 	= "SELECT * FROM finger WHERE user_id= '".$user_id."' ";
		try {
			$final = $dbconn->pdo->prepare($sql);
			$final->execute();

			$arr 	= array();
			$i 	= 0;

			while ($row = $final->fetch(PDO::FETCH_ASSOC)) {

				$arr[$i] = array(
				'user_id'	=>$row['user_id'],
				"finger_id"	=>$row['finger_id'],
				"finger_data"	=>$row['finger_data']
				);

				$i++;

			}

		return $arr;

		}
		catch(Exception $e)
		{

		}
	}

	function selectCountOfExistingFinger($data){
		$dbconn = DB::getInstance();

		$sql		= "SELECT count(finger_id) as ct FROM finger WHERE user_id=".$data;
		try{
			$final = $dbconn->pdo->prepare($sql);
			$final->execute();

			$returnData = $final->fetch();

			return $returnData;
		}
		catch(Exception $e){

		}
	}

	function selectFinger(){
	    $dbconn = DB::getInstance();

	    $sql = "SELECT a.* FROM users AS a JOIN finger AS b ON a.user_id=b.user_id";

	    try{
	        $final = $dbconn->pdo->prepare($sql);
	        $final->execute();
            $arr = array();
            $i = 0;
            while ($row = $final->fetch(PDO::FETCH_ASSOC)) {

                $arr[$i] = array(
                    'user_id'	=>$row['user_id'],
                    "user_name"	=>$row['user_name'],
                );

                $i++;

            }

	        return $arr;
        }catch(Exception $e){

        }
    }

	function getLog() {
        $dbconn = DB::getInstance();

		$sql 	= 'SELECT * FROM log ORDER BY log_time DESC';
		$final = $dbconn->pdo->prepare($sql);
		$final->execute();

		$arr 	= array();
		$i 	= 0;

		while ($row = $final->fetch()) {

			$arr[$i] = array(
				'log_time'		=> $row['log_time'],
				'user_name'		=> $row['user_name'],
				'data'			=> $row['data']
			);

			$i++;

		}

		return $arr;

	}
	
	function createLog($user_name, $time, $sn) {
        $dbconn = DB::getInstance();

		$sql = "INSERT INTO log SET user_name='".$user_name."', data='".date('Y-m-d H:i:s', strtotime($time))." (PC Time) | ".$sn." (SN)"."' ";

		try{
            $final = $dbconn->pdo->prepare($sql);
            $final->execute();
            $this->sendCode($user_name,$time);

            /*if ($final->execute()){
                $this->sendCode($user_name);
                die();
            }*/
            die(header("Location: http://localhost/myWork/fingerprintSample/code/messages.php"));

            /*$location = "http://localhost/myWork/fingerprintSample/code/messages.php";
            return header("location: ".$location);

            return true;*/

        }
        catch (Exception $e){
            return "Error insert log data!";
		}
		
	}

	function sendCode($user_name, $time){
        $dbconn = DB::getInstance();
        $sql1 = "SELECT * FROM users WHERE user_name= '".$user_name."' ";

        $final1 = $dbconn->pdo->prepare($sql1);
        $final1->execute();

        $result1 = $final1->fetch();

        /*Randomly generate a string*/
            $length = 7;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

        $to = $result1['telephone'];
        $message = 'This is your Confirmation Code '.$randomString;
        $messageStatus = $this->sendMessage('Veri-System',$to,$message);

        if($messageStatus){
            $sql = "INSERT INTO passcode SET id = '',user_id='".$result1['user_id']."', 
                    passcode='".$randomString."',created_at= '".$time."', status=0";
            $final = $dbconn->pdo->prepare($sql);
            if($final->execute()){

            }
        }
    }

    function confirmCode($data){
	    $dbconn = DB::getInstance();
        $status = 0;
	    $sql = "SELECT * FROM passcode WHERE passcode ='".$data['code']."' AND user_id='".$data['user_id']."' AND status='".$status."'";

	    try{
	        $final = $dbconn->pdo->prepare($sql);
	        $final->execute();
	        $result = $final->fetch();

	        if($result){
                $sql2 = "UPDATE passcode SET status= 1 WHERE id='". $result['id']."'";
                $final2 = $dbconn->pdo->prepare($sql2);
                $final2->execute();
                return true;
            }
            else{
	            return false;
            }
        }catch (Exception $e){}
    }

    public function sendMessage($senderName, $phoneNumbers, $message){
            $apikey = 'c33dd10809921a87948f5357edf993d0efec32ef';
            $url = "http://api.ebulksms.com:8080/sendsms.json";
            $username = 'timothy33.tf@gmail.com';
            $flash = 0 ;
            $message = stripslashes($message);
            $phoneArray = explode(',', $phoneNumbers);
            foreach ($phoneArray as $key => $value) {
                $mobileNumber = trim($value);
                if (substr($mobileNumber, 0,1) == '0') {
                    $mobileNumber = '234'. substr($mobileNumber, 1);
                }elseif (substr($mobileNumber, 0,1) == '+') {
                    $mobileNumber = substr($mobileNumber, 1);
                }
                $generatedId = uniqid('int_', false);
                $generatedId = substr($generatedId, 0, 30);
                $recipent['gsm'][] = array('msidn' => $mobileNumber, 'msgid' => $generatedId);
            }
            $message = array(
                'sender' => $senderName,
                'messagetext' => $message,
                'flash' => "{$flash}",
            );
            $request = array('SMS' => array(
                'auth' => array(
                    'username' => $username,
                    'apikey' => $apikey
                ),
                'message' => $message,
                'recipients' => $recipent
            )
            );
            $json_data = json_encode($request);
            if ($json_data) {
                $response = self::doPostRequest($url, $json_data, array('Content-Type: application/json'));
                $result = json_decode($response);
                $status = $result->response->status;
                return true;
            } else {
                return false;
            }
        }

    public function doPostRequest($url, $data, $headers = array()) {
            $php_errormsg = '';
            if (is_array($data)) {
                echo $data = http_build_query($data, '', '&');
            }
            $params = array('http' => array(
                'method' => 'POST',
                'content' => $data)
            );
            if ($headers !== null) {
                $params['http']['header'] = $headers;
            }
            $ctx = stream_context_create($params);
            $fp = fopen($url, 'rb', false, $ctx);
            if (!$fp) {
                return "Error: gateway is inaccessible";
            }
            //stream_set_timeout($fp, 0, 250);
            try {
                $response = stream_get_contents($fp);
                if ($response === false) {
                    throw new Exception("Problem reading data from $url, $php_errormsg");
                }
                return $response;
            } catch (Exception $e) {
                $response = $e->getMessage();
                return $response;
            }
        }

        public function deleteUser($user_id)
        {
            $dbconn = DB::getInstance();
            $sql1 = "DELETE FROM users WHERE user_id = '".$user_id."'";
            $final = $dbconn->pdo->prepare($sql1);
            $final->execute();
            $sql2 		= "DELETE FROM finger WHERE user_id = '".$user_id."' ";
            $final2 = $dbconn->pdo->prepare($sql2);
            $final2->execute();

            return true;
        }



}
?>