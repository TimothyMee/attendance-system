<?php
	/*ini_set("display_errors", 0);
	error_reporting(0);*/

	/*$base_path		= "http://localhost/demo_flexcodesdk/";
	$db_name		= "demo_flexcodesdk";
	$db_user		= "root";
	$db_pass		= "";
	$db_host		= "localhost";
	$time_limit_reg = "15";
	$time_limit_ver = "10";

	$conn = mysql_connect($db_host, $db_user, $db_pass);
	if (!$conn) die("Connection for user $db_user refused!");
	mysql_select_db($db_name, $conn) or die("Can not connect to database!");*/


	class global{

		protected $pdo;
		public function __construct(){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "demo_flexcodesdk";

			try {
				    $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				    // set the PDO error mode to exception
				    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    echo "Connected successfully"; 
			    }
			catch(PDOException $e)
			    {
			    	echo "Connection failed: " . $e->getMessage();
			    }
		}

		public static function getInstance(){
			if(!isset(self::$_instance)){
				self::$_instance = new global();
			}
			return self::$_instance;
		}

	}
	/*$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "demo_flexcodesdk";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    echo "Connected successfully"; 
	    }
	catch(PDOException $e)
	    {
	    echo "Connection failed: " . $e->getMessage();
	    }*/
?>