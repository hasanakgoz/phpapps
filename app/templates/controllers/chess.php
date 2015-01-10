<?php
include 'app/models/appConfig.php';
class Chess extends Controller {
	
	private $_appconfig;
	
	public function __construct() {
		parent::__construct ();
		$this->_appconfig = new AppConfig();
	}
	
	/**
	 * Define Index page title and load template files
	 */
	public function index() {
		if(isset($_GET['action'])) {
			$action = $_GET['action'];
			$data = null;
			if($action == "GET") {
				$data['result'] = $this->_appconfig->getIP();
				echo $data['result'][0]->DESCRIPTION.":".$data['result'][1]->DESCRIPTION;
			}
			else if($action == "SET") {
				$this->_appconfig->setIP($_GET['ip'], $_GET['port']);
				$data['result'] = $this->_appconfig->getIP();
				echo $data['result'][0]->DESCRIPTION.":".$data['result'][1]->DESCRIPTION;
			}
		} 
		else {
			echo "action is not set";
		}
	}
}
?>