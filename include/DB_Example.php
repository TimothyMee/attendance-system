<?php
	class DB{

		protected $pdo;
		private static $_instance = null;

		public function __construct(){
			$servername = "localhost";
			$username = "DB_USERNAME";
			$password = "DB_PASSWORD";
			$dbname = "DB_NAME";

			try {
				    $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				    // set the PDO error mode to exception
				    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    /*echo "Connected successfully";*/
			    }
			catch(PDOException $e)
			    {
			    	echo "Connection failed: " . $e->getMessage();
			    }
		}

		public static function getInstance(){
			if(!isset(self::$_instance)){
				self::$_instance = new DB();
			}
			return self::$_instance;
		}

	}
?>