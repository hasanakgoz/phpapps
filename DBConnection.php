<?php
class DBConnection
{
	protected static $connection; 
	private static $instance;
	
	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new DBConnection();
			self::$instance->init();
		}
		return self::$instance;
	}
	
	private static function init() {
		if(!isset(self::$connection)) {
			$config = parse_ini_file('./dbconfig.ini');
			self::$connection = new mysqli($config['ip'],$config['username'],$config['password'],$config['dbname']);
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		}
			
		if(self::$connection === false) {
			echo "error in connection";
		}
	}
	
	public function query($query) {
		/* self::$connection -> connect(); */
		$result = self::$connection -> query($query);
		return $result;
	}

	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Singleton* via the `new` operator from outside of this class.
	 */
	protected function __construct()
	{
	}

	/**
	 * Private clone method to prevent cloning of the instance of the
	 * *Singleton* instance.
	 *
	 * @return void
	 */
	private function __clone()
	{
	}

	/**
	 * Private unserialize method to prevent unserializing of the *Singleton*
	 * instance.
	 *
	 * @return void
	 */
	private function __wakeup()
	{
	}
}

?>