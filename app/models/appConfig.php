<?php
class AppConfig extends Model {
	function __construct() {
		parent::__construct();
	}

	public function getIP() {
		$query = "select * from a7054067_apps.APP_CONFIG where CONFIG_TYPE='CHESS' AND CODE='SERVER_IP' or CODE='SERVER_PORT'";
		return $this->_db->select($query);
	}

	public function setIP($ip, $port) {
		$postdata = array(
				'DESCRIPTION' => $ip,
		);		
		$where = array("CONFIG_TYPE" => "CHESS", "CODE" => "SERVER_IP");
		$this->_db->update(PREFIX."a7054067_apps.APP_CONFIG", $postdata, $where);
		
		$postdata = array(
				'DESCRIPTION' => $port,
		);
		$where = array("CONFIG_TYPE" => "CHESS", "CODE" => "SERVER_PORT");
		$this->_db->update(PREFIX."a7054067_apps.APP_CONFIG", $postdata, $where);
	}
}

?>