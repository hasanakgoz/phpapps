<?php

class Train extends Controller {
	
	private $_station;
	
	public function __construct() {
		parent::__construct ();
		View::rendertemplate ( 'mobile-header', $data );
		require 'app/models/trains/station.php';
		$this->_station = new Station();
	}
	
	/**
	 * Define Index page title and load template files
	 */
	public function index() {
		$data ['title'] = $this->language->get ( 'Train Enquiry' );
		//$data ['welcome_message'] = $this->language->get ( 'welcome_message' );
		$data ['stations'] = $this->_station->getStations();
		//print_r($data);
		
		View::render ( 'mobile/trains/enquire', $data );
	}
	
	/**
	 * Define Subpage page title and load template files
	 */
	public function allStations() {
		$data ['stations'] = $this->_station->getStations($keyword);
		//print_r($data ['stations']);
		header('Content-Type: application/json');
		echo json_encode($data ['stations']);
	}
	
	public function search() {
		$from = $_GET['from'];
		$to = $_GET['to'];
		$data ['trains'] = $this->_station->getTrains($from, $to);
		$response["data"] = $data ['trains'];
		$response["recordsTotal"] = sizeof($response["data"]);
		//print_r($data ['stations']);
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
?>